<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
        session_start();
    }

    public function index()
    {
        if(!empty($code = $this->input->get('code'))) {
            $this->load->model('mdl_shops');
            if($data = $this->mdl_shops->get_tmp_email($code)) {
                $data['token'] = bin2hex(openssl_random_pseudo_bytes(24));
                $_SESSION['token'] = $data['token'];
                $this->load->view('login/view_register', $data);
            } else {
                exit(header('HTTP/1.1 403 Forbidden'));
            }
        } else {
            header('HTTP/1.1 403 Forbidden');
            exit;
        }
    }

    public function register()
    {
        $this->judge_request_param();
        if($this->form_validation->run('register')) {
            $key_array = ['shop_name', 'shop_kana', 'shop_tel', 'shop_email', 'shop_zip_code', 'shop_address', 'shop_password'];
            foreach($key_array as $key) {
                $data[$key] = $key === 'shop_password'? password_hash($this->input->post($key), PASSWORD_DEFAULT): $this->input->post($key);
            }
            $this->load->model("mdl_shops");
            $res_array = $this->mdl_shops->insert_shops($data)? ['success' => '登録が完了しました！']: ['error' => 'メールアドレスが既に登録されている可能性があります'];
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
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
            exit('不正な接続です');
        }
    }
}