<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form', 'ajax']);
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Tokyo');
        session_start();
    }

    public function index()
    {
        $data['token'] = bin2hex(openssl_random_pseudo_bytes(24));
        $_SESSION['token'] = $data['token'];
        if(isset($_SESSION['shop_id'])) {
            header('location: //animarl.com/cl_main');
        } else {
            $this->load->view('login/view_sign-in', $data);
        }
    }

    public function login()
    {
        $this->judge_request_param();
        if($this->form_validation->run('login')) {
            $this->load->model('mdl_login');
            $data = $this->mdl_login->get_userdata(['shop_email' => $this->input->post('login-email')]);
            if($data) {
                if(password_verify($this->input->post('login-password'), $data['shop_password'])) {
                    $res_array = json_msg('login', true);
                    $_SESSION['shop_id'] = $data['shop_id'];
                } else {
                    $res_array = json_msg('login', false);
                    // $res_array = ['error' => 'ログインに失敗しました...'];
                }
            } else {
                $res_array = json_msg('login', false);
            }
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        header('Content-Type: application/json');
        exit(json_encode($res_array));
    }

    public function logout()
    {
        session_destroy();
        exit(header('location: //animarl.com/login'));
    }

    public function prov_register()
    {
        $this->judge_request_param();
        if($this->form_validation->run('prov-register')) {
            $data = [
                'tmp_shop_email' => $this->input->post('prov-email'),
                'tmp_shop_code' => hash('md5', getmypid().microtime()),
                'tmp_expires' => date('Y-m-d H:i:s', time()+3600)
            ];
            $this->load->model('mdl_login');
            if($this->mdl_login->check_tmp_user($data['tmp_shop_email']) === 0) {
                if($this->mdl_login->insert_tmp_data($data)) {
                    $res_array = $this->send_email($data)? json_msg('prov', true): json_msg('prov', false);
                } else {
                    $res_array = json_msg('prov', false);
                }
            } else {
                $res_array = json_msg('prov', false);
            }
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        header('Content-Type: application/json');
        exit(json_encode($res_array));
    }

    public function send_token_for_reset()
    {
        $this->judge_request_param();
        if($this->form_validation->run('forgot-password')) {
            $this->load->model('mdl_login');
            if($this->mdl_login->check_tmp_user(['shop_email' => $email = $this->input->post('forgot-email')]) === 1) {
                $data = [
                    'tmp_shop_email' => $email,
                    'tmp_shop_code' => hash('md5', getmypid().microtime()),
                    'tmp_expires' => date('Y-m-d H:i:s', time()+3600)
                ];
                if($this->mdl_login->insert_tmp_data($data)) {
                    $msg = <<< EOM
                    いつもAnimarlをご利用いただきありがとうございます。
                    パスワードリセット用のURLを添付いたしましたので以下のリンクから変更をお願い致します。
                    http://animarl.com/login/password_reset_form?code={$data['tmp_shop_code']}
                    このメールに覚えのない場合には、お手数ですがメールを破棄してくださいますようお願い致します。
                    EOM;
                    $this->load->library('email');
                    $this->email->from('animarl_system@niji-desk.work', 'Animarl_system');
                    $this->email->to($email);
                    $this->email->subject('Animarlログインパスワードリセット');
                    $this->email->message($msg);
                    if(!$this->email->send()) {
                        exit(print_r($this->email->print_debugger()));
                    } else {
                        $res_array = json_msg('send_token', true);
                    }
                } else {
                    $res_array = json_msg('send_token', false);
                }
            } else {
                $res_array = ['valierr' => ['forgot-email' => 'メールアドレスが登録されていません']];
            }
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        header('Content-Type: application/json');
        exit(json_encode($res_array));
    }

    public function password_reset_form()
    {
        if(!empty($code = $this->input->get('code'))) {
            $this->load->model('mdl_shops');
            if($data = $this->mdl_shops->get_tmp_email($code)) {
                $data['code'] = $code;
                $data['token'] = bin2hex(openssl_random_pseudo_bytes(24));
                $_SESSION['token'] = $data['token'];
                $this->load->view('login/view_reset_password', $data);
            } else {
                header('HTTP/1.1 403 Forbidden');
                exit;
            }
        } else {
            header('HTTP/1.1 403 Forbidden');
            exit;
        }
    }

    public function password_reset()
    {
        $this->judge_request_param();
        if($this->form_validation->run('reset-password')) {
            $this->load->model('mdl_login');
            if($email = $this->mdl_login->get_tmp_email($this->input->post('reset-token'))) {
                $data = [
                    'where' => $email['tmp_shop_email'],
                    'set' => ['shop_password' => password_hash($this->input->post('reset-password'),PASSWORD_DEFAULT)]
                ];
                $res_array = $this->mdl_login->update_password($data)? json_msg('password_reset', true): json_msg('password_reset', false, 10);
            } else {
                $res_array = json_msg('password_reset', false, 1);
            }
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        header('Content-Type: application/json');
        exit(json_encode($res_array));
    }

    /**
     * リクエストの正当性をチェック
     *
     * @param [str] $_SERVER['HTTP_X_CSRF_TOKEN'] && $_SESSION['token']
     */
    private function judge_request_param()
    {
        if(empty($_SERVER['HTTP_X_CSRF_TOKEN']) || $_SERVER['HTTP_X_CSRF_TOKEN'] !== $_SESSION['token']) {
            header('HTTP/1.1 403 Forbidden');
            exit();
        }
    }

    private function send_email($data)
    {
        $msg = <<< EOM
            このメールは配信専用のアドレスで配信されています。
            このメールに返信されても、返信内容の確認及びご返答ができませんので、あらかじめご了承ください。
            この度はAnimarl仮登録頂きありがとうございます。
            本登録を開始するには、次のリンクをクリックしてください。
            http://animarl.com/register?code={$data['tmp_shop_code']}
            このメールに覚えのない場合には、お手数ですがメールを破棄してくださいますようお願い致します。
        EOM;
        $this->load->library('email');
        $this->email->from('animarl_system@niji-desk.work', 'Animarl_system');
        $this->email->to($data['tmp_shop_email']);
        $this->email->subject('test');
        $this->email->message($msg);
        if (!$this->email->send()) {
            print_r($this->email->print_debugger());
            exit;
        } else {
            return true;
        }
    }

}