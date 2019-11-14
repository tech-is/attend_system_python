<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * class cl_main
 * メールを扱う関数を主に置いています
 * メールホストを設定したい場合にはapplication/confing/email.phpを書き換えてください
 */

class Cl_magazine extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->model('mdl_magazine');
        session_start();
    }

    public function index()
    {
        $_SESSION['shop_id'] = 1;
        $data = [
            // 'magazine_json' => $array = $this->add_array($this->mdl_magazine->get_magazine($_SESSION['shop_id']))? $this->json_encode_array($array): null
            // 'count' => $this->mdl_magazine->get_magazine_count($_SESSION['shop_id']),
            // 'total' => !empty($array = $this->get_total_list($_SESSION['shop_id']))? $this->json_encode_array($array): null,
            'magazine' => $array = @$this->mdl_magazine->get_magazine($_SESSION['shop_id'])?: null,
            'count' => $count = @$this->mdl_magazine->get_magazine_count($_SESSION['shop_id']) ?: 1,
            'magazine_json' => $this->json_encode_array($this->add_array($array))
        ];
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/magazine/view_magazine', $data);
    }

    /**
     * Undocumented function
     *
     * @param [int] $shop_id
     * @return [array] $data|null
     */
    private function get_reserve($shop_id)
    {
        $columns = [
            'pet_name' => 'title',
            'reserve_start' => 'start',
            'reserve_end' => 'end'
        ];
        if(!empty($reserves = $this->mdl_reserve->get_reserve_list($shop_id))) {
            foreach($reserves as $row => $reserve) {
                foreach($reserve as $column => $value) {
                    if(array_key_exists($column, $columns)) {
                        $data[$row][$columns[$column]] = $value;
                    } else {
                        $data[$row][$column] = $value;
                    }
                }
            }
        } else {
            $data = null;
        }
        return $data;
    }

    private function add_array($array)
    {
        $i = 0;
        while($i < 10) {
            @$array[$i]?: $array[$i] = ['mail_sender_name' => '未登録', 'mail_subject' => '未登録', 'mail_detail' => '未登録'];
            $i++;
        }
        return $array;
    }

    private function json_encode_array($array)
    {
        return !empty($array) && gettype($array) === "array" ? json_encode($array): null;
    }

    /**
     * Undocumented function
     *
     * @param [str] $_SERVER['HTTP_X_CSRF_TOKEN'] && $_SESSION['token']
     */
    private function judge_request_via_ajax()
    {
        if(empty($_SERVER['HTTP_X_CSRF_TOKEN']) || $_SERVER['HTTP_X_CSRF_TOKEN'] !== $_SESSION['token']) {
            header('HTTP/1.1 403 Forbidden');
            exit();
        }
    }

    /**
     * Undocumented function
     *
     * @param [array] $_POST
     * @return [str] success|dberr|valierr
     */
    public function register_magazine()
    {
        $this->judge_request_via_ajax();
        if($this->magazine_data_validation()) {
            $data = $this->set_column_data(true);
            echo $this->mdl_magazine->insert_magazine($data)? 'success': 'dberr';
        } else {
            echo 'valierr';
        }
        exit;
    }

    /**
     * Undocumented function
     *
     * @param [array] $_POST
     * @return [str] success|dberr|valierr
     */
    public function update_magazine()
    {
        $this->judge_request_via_ajax();
        if($this->magazine_data_validation()) {
            $data = $this->set_column_data(true);
            $data['where']['mail_magazine_id'] = @$this->input->post('mail_magazine_id')?: exit;
            echo $this->mdl_magazine->update_magazine($data)? 'success': 'dberr';
        } else {
            echo 'valierr';
        }
        exit;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function delete_magazine()
    {
        $this->judge_request_via_ajax();
        $id = [
            'mail_magazine_id'=> @$this->input->post('mail_magazine_id')?: exit('valierr'),
            'mail_shop_id' => $_SESSION['shop_id']
        ];
        echo $this->mdl_magazine->delete_magazine($id)? 'success': 'dberr';
        exit;
    }

    /**
     * Undocumented function
     *
     * @return true|false
     */
    private function magazine_data_validation()
    {
        $config = [
            [
                'field' => 'mail_sender_name',
                'label' => '表示名',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'mail_subject',
                'label' => '件名',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'mail_detail',
                'label' => '本文',
                'rules' => 'required|trim'
            ]
        ];
        $this->load->library('form_validation', $config);
        return $this->form_validation->run();
    }

    /**
     * Undocumented function
     *
     * @param [boolean] $which
     * @return [array] $data
     */
    private function set_column_data($which)
    {
        $columns = ['mail_sender_name', 'mail_subject', 'mail_detail'];
        foreach($columns as $column) {
            @$this->input->post($column)? $data['set'][$column] = $this->input->post($column): false;
        }
        // $data['set']['mail_detail'] = @$data['set']['mail_detail']? str_replace("\n", '<br>', $data['set']['mail_detail']): null;
        $which? $data['where']['mail_shop_id'] = $_SESSION['shop_id']: false;
        return $data;
    }

}
