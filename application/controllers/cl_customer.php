<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_customer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
        $this->load->library('session');
        session_start();
        $_SESSION["shops_id"] = 1;
    }

    public function index()
    {
        //mdl_customerの呼び出し
        $this->load->model('mdl_customer');

        //顧客登録一覧
        // $this->load->view('cms/pages/parts/header');
        // $this->load->view('cms/pages/parts/sidebar');
        // $this->load->view('cms/Customer_view');
    }
    //呼び出し
    public function select_customer() 
    {
        $this->load->model('mdl_customer');
        $this->mdl_customer->m_select_customer();

    }
    public function custmoer_form()
    {
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/Customer_view');
    }

    public function custmoer_list()
    {
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/vi_total_list.php');
    }
    private function check_customer_data()
    {
        $config = [
            [
                'field' => 'customer_name',
                'label' => '名前',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => '名前を入力してください'
                )
            ],
            // array(
            //     'field' => 'customer_kana',
            //     'label' => 'カナ',
            //     'rules' => 'required|trim',
            //     'errors' => array(
            //     'required' => 'カナを入力してください'
            //                                         )
            //     ),
            // array(
            //     'field' => 'customer_mail',
            //     'label' => 'メール',
            //     'rules' => 'required',
            //     'errors' => array(
            //     'required' => 'メールを入力して下さい'
            //                                             )
            //     ),
            // array(
            //     'field' => 'customer_tel',
            //     'label' => '電話',
            //     'rules' => 'required|trim',
            //     'errors' => array(
            //     'required' => '番号を入力してください'
            //                                             )
            //     ),
            // array(
            //     'field' => 'customer_zip_adress',
            //     'label' => '郵便番号',
            //     'rules' => 'required|trim',
            //     'errors' => array(
            //     'required' => '郵便番号を入力してください'
            //                                             )
            //     ),
            // array(
            //     'field' => 'customer_address',
            //     'label' => '住所',
            //     'rules' => 'required|trim',
            //     'errors' => array(
            //     'required' => '住所を入力してください'
            //                                             )
            //     ),
            // array(
            //     'field' => 'customer_magazine',
            //     'label' => 'マガジン発行',
            //     ),
            // array(
            //     'field' => 'customer_add_info',
            //     'label' => '追加情報',
            //     'rules' => 'required|trim',
            //     ),
            // array(
            //     'field' => 'customer_group',
            //     'label' => 'ランク',
            //     'rules' => 'required|trim',
            //     )
        ];
        $this->load->library('form_validation');
        $this->form_validation->set_rules($config);
        return $this->form_validation->run();
    }
    // customerデータに入れていないキーの処理
    public function c_check()
    {
        // $c_test['customer_magazine'] ="";
        if ($this->check_customer_data() == true) {
            $c_test = $this->input->post(NULL,true);
            //メールマガジンをintへ
            if(empty($this->input->post("customer_magazine"))) {
                $c_test['customer_magazine'] = 1;
            } else {
                $c_test['customer_magazine'] = 0;
            }
            //グループをintへ
            if($c_test['customer_group'] == 'gold') {
                $c_test['customer_group'] = 0;
            } elseif ($c_test['customer_group'] == 'silver') {
                $c_test['customer_group'] = 1;
            } elseif($c_test['customer_group'] == 'bronze'){
                $c_test['customer_group'] = 2;
            } else{
                $c_test['customer_group'] = 3;
            }
            $c_test["customer_shop_id"] = $_SESSION["shops_id"];
            return $c_test;
        } else {
            return false;
        }
    }

    //新規登録
    public function insert_customer()
    {
        if($this->c_check() == true) {
            $newresult = $this->c_check();
            $this->load->model("mdl_customer");
            if($this->mdl_customer->m_insert_customer($newresult) == true) {
                echo "success!";
                exit;
            } else {
                echo "fail..";
                exit;
            }
        } else {
            echo "入力値に不正";
            exit;
        }
    }

    //vi_total_listの更新の起点はここ
    public function update_customer_list()
    {
        if($this->c_check() == true) {
            $result = $this->c_check();
            if($this->update_customer($result) == true) {
                echo "success!";
                exit;
            } else {
                echo "false…";
                exit;
            }
        } else {
            echo "入力値に不正";
        }
    }

    private function update_customer()
    {
        $id = [
            "customer_id" => $this->input->post("customer_id"),
            "customer_shop_id" => $_SESSION['shops_id'],
        ];
        $data = [
            "customer_name" => $this->input->post("customer_name"),
            "customer_kana" => $this->input->post("customer_kana"),
            "customer_mail" => $this->input->post("customer_mail"),
            "customer_tel" => $this->input->post("customer_tel"),
            "customer_zip_adress" => $this->input->post("customer_zip_adress"),
            "customer_address" => $this->input->post("customer_address"),
            "customer_magazine" => $this->input->post("customer_magazine"),
            "customer_add_info" => $this->input->post("customer_add_info"),
            "customer_group" => $this->input->post("customer_group"),
        ];
        $this->load->model("mdl_customer");
        return $this->mdl_customer->update_customer_data($id, $data);
    }

    public function delete_customer()
    {
        $id = [
            "customer_id" => $this->input->post("customer_id"),
            "customer_shop_id" => $_SESSION["shop_id"],
        ];
        $this->load->model("mdl_customer");
        if($this->mdl_customer->delete_customer_data($id) == true) {
            echo "succsess!";
        } else {
            echo "false";
        }
    }

}
