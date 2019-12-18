<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 使うかどうか未定のログイン用クラス
 */
class login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form', 'ajax']);
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Tokyo');
    }

    public function index()
    {
        $data['token'] = bin2hex(openssl_random_pseudo_bytes(24));
        $_SESSION['token'] = $data['token'];
        if (isset($_SESSION['shop_id'])) {
            $url = base_url();
            header("location: {$url}students");
        } else {
            $this->load->view('login/view_sign-in', $data);
        }
    }

    public function login()
    {
        $this->judge_request_param();
        if ($this->form_validation->run('login')) {
            $this->load->model('mdl_login');
            $data = $this->mdl_login->get_userdata(['shop_email' => $this->input->post('login-email')]);
            if ($data) {
                if (password_verify($this->input->post('login-password'), $data['shop_password'])) {
                    $res_array = callback_json_msg('login', true);
                    $_SESSION['shop_id'] = $data['shop_id'];
                } else {
                    $res_array = callback_json_msg('login', false);
                }
            } else {
                $res_array = callback_json_msg('login', false);
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
        exit(header('location: //{base_url()}/login'));
    }

}
