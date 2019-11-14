<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * タイトル：顧客詳細・IDで管理
 * 説明    ：顧客・IDで詳細管理
 *
 * 著作権  ：Copyright(c) 2019 TECH I.S
 * 会社名  ：TECH I.S
 *
 * 変更履歴：2019.8 開発
 */

class Cl_karute extends CI_Controller
{
    //コンストラクタ
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
        $this->load->model('Mdl_total_list');
        $this->load->model('Mdl_karute');
        session_start();
        $_SESSION["shop_id"] = 1;
    }

    //TOPページ
    public function index()
    {
        if(!empty($customer_id = $this->input->post("customer_id"))){
            // echo $_SESSION["shop_id"];
            // exit;
            $data["karute"] = $this->Mdl_karute->m_karute_get($_SESSION["shop_id"], $customer_id);
            $this->karute_result($data);
            // print_r ($data["karte"]);
        } else {
            $data["list"] = $this->get_total_list();
            $data["groups"] = $this->get_kind_group();
            $this->load->view('cms/pages/parts/header');
            $this->load->view('cms/pages/parts/sidebar');
            $this->load->view('cms/vi_karute', $data);
        }
    }
    //検索結果をページ遷移
    private function karute_result($data)
    {
        $this->load->view('cms/pages/parts/header');
        // $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/vi_karute_result', $data);
    }


    //一覧取得
    private function get_total_list()
    {
        $shop_id = $_SESSION["shop_id"];
        return $this->Mdl_total_list->m_get_total_list($shop_id);
    }

    //グループ検索
    private function get_kind_group()
    {
        $id = $_SESSION["shop_id"];
        return $this->Mdl_total_list->m_get_kind_group($id);
    }


    //更新時、全件取得
    public function get_total_all_data()
    {
        $pet_id = $this->input->post("id");
        $this->load->model("Mdl_total_list");
        return  $this->Mdl_total_list->m_get_total_all($pet_id);

    }

    //ペットと顧客の登録
    public function insert_total_data()
    {
        // $data['debug'] = var_export($_POST, true);
        //顧客の登録
        if($this->total_validation() === true) {
            $data = $this->escape_xss();
            if(isset($_FILES["pet_img"])) {
                if($_FILES["pet_img"]["error"] === 0) { //エラーがなく正常
                    $result_upload = $this->img_upload();
                    if($result_upload === false) {
                        echo "upload_err";
                        exit;
                    } else {
                        $data["pet_data"]["pet_img"] = $result_upload;
                    }
                } elseif($_FILES["pet_img"]["error"] !== 4) { //エラーにてアップロードされてない以外の処理
                    echo "upload_err";
                    exit;
                }
            }
            $this->load->model("Mdl_total_list");
            if($this->Mdl_total_list->m_insert_total_list($data["customer_data"], $data["pet_data"]) === true) {
                echo "success";
                exit;
            } else {
                echo "dberror";
                exit;
            }
        } else {
            // echo "vali_err";
            echo validation_errors();
            exit;
        }
    }

    private function request_ajax_check()
    {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $ref_url = @$_SERVER["HTTP_REFERER"]? parse_url($_SERVER["HTTP_REFERER"]): exit;
            return $ref_url["host"].$ref_url["path"] === "animarl.com/cl_total_list/"? true: false;
        }
    }

    //更新処理
    public function update_total_data()
    {
        if($this->total_validation() == true) {
            $data = $this->escape_xss();
            if(isset($_FILES["pet_img"])) {
                if($_FILES["pet_img"]["error"] === 0) { //エラーがなく正常
                    $result_upload = $this->img_upload();
                    if($result_upload === false) {
                        echo "upload_err";
                        exit;
                    } else {
                        $data["pet_data"]["pet_img"] = $result_upload;
                    }
                } elseif($_FILES["pet_img"]["error"] !== 4) { //エラーにてアップロードされてない以外の処理
                    echo "upload_err";
                    exit;
                }
            }
            $this->load->model("Mdl_total_list");
            if($this->Mdl_total_list->m_update_total_list($data["id"], $data["customer_data"], $data["pet_data"]) == true) {
                    echo "success";
                    exit;
            } else {
                    echo "dberror";
                    exit;
            }
        } else {
            echo "vali_err";
            exit;
        }
    }

    //XSS前処理
    private function escape_xss()
    {
        $post = $this->input->post(null, true); //ajaxでｃーテーブルとテーブルを一緒に登録
        if(isset($post["pet_id"]) && isset($post["customer_id"])) {
            $id = ["customer_id" => $post["customer_id"], "pet_id" => $post["pet_id"]];
            unset($post["customer_id"], $post["pet_id"]);
        }

        foreach($post as $key => $val) { //カスタマーとペットに分ける処理
            if(strpos($key,'customer_') !== false) {
                $customer_data[$key] = $val;
                $customer_data["customer_shop_id"] = $_SESSION["shop_id"];
            } else {
                $pet_data[$key] = $val;
            }
        }

        if(isset($id)) {
            return ["id" => $id, "customer_data" => $customer_data, "pet_data" => $pet_data];
        } else {
            return ["customer_data" => $customer_data, "pet_data" => $pet_data];
        }
    }

    //入力チェック
    private function total_validation()
    {
        $config = [
            [
                'field' => 'customer_name',
                'label' => '名前',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '名前を入力してください'
                ]
            ],
            [
                'field' => 'customer_kana',
                'label' => 'カナ',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'カナを入力してください'
                ]
            ],
            [
                'field' => 'customer_mail',
                'label' => 'メール',
                'rules' => 'required',
                'errors' => [
                    'required' => 'メールを入力して下さい'
                ]
            ],
            [
                'field' => 'customer_tel',
                'label' => '電話',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '番号を入力してください'
                ]
            ],
            [
                'field' => 'customer_zip_adress',
                'label' => '郵便番号',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '郵便番号を入力してください'
                ]
            ],
            [
                'field' => 'customer_address',
                'label' => '住所',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '住所を入力してください'
                ]
            ],
            [
                'field' => 'customer_add_info',
                'label' => '追加情報',
                'rules' => 'trim',
            ],
            [
                'field' => 'pet_name',
                'label' => '名前',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '名前を入力してください'
                ]
            ],
            [
                'field' => 'pet_classification',
                'label' => '分類',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '入力してください'
                ]
            ],
            [
                'field' => 'pet_type',
                'label' => '種類',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '種類入力してください'
                ]
            ],
            [
                'field' => 'pet_animal_gender',
                'label' => '性別',
                'rules' => 'required',
                'errors' => [
                    'required' => '性別を選択してください'
                ]
            ],
            [
                'field' => 'pet_birthday',
                'label' => '生年月日',
                'rules' => 'trim',
            ],
            [
                'field' => 'pet_contraception',
                'label' => '避妊',
                'rules' => 'trim'
            ],
            [
                'field' => 'pet_body_height',
                'label' => '体高',
                'rules' => 'trim',
                'errors' => [
                    'required' => '入力してください'
                ]
            ],
            [
                'field' => 'pet_body_weight',
                'label' => '体重',
                'rules' => 'trim',
                'errors' => [
                    'required' => '入力してください'
                ]
            ],
            [
                'field' => 'pet_information',
                'label' => '備考',
                'rules' => 'trim',
            ]
        ];
        $this->load->library('form_validation', $config);
        // $this->form_validation->set_rules($config);
        return $this->form_validation->run();
    }

    //ペットファイルの画像アップ
    private function img_upload()
    {
        $filename = time();
        // $config['upload_path'] = './upload/tmp';//リサイズ前
        // $config['allowed_types'] = 'gif|jpg|png';
        // $config['file_name'] = $filename;
        // $config['max_size']	= '3072';
        // $config['max_width']  = '';
        // $config['max_height']  = '';
        $config = [
            'upload_path' => './upload/tmp',
            'allowed_types' => 'gif|jpg|png',
            'file_name' => $filename,
            'max_size'	=> '3072',
            'max_width'  => '',
            'max_height'  => ''
        ];
        $this->load->library('upload', $config);
        $result = $this->upload->do_upload('pet_img');
        if ($result) {
            $resize_path = './upload/img/thumbs';//リサイズ後
            $image_data = $this->upload->data();
            $config['source_image'] = $image_data["full_path"];
            $config['maintain_ration'] = true;
            $config['new_image'] = $resize_path; //サムネイル保存フォルダ
            $config['width'] = 640;
            $config['height'] = 360;
            $this->load->library("image_lib", $config);
            if($this->image_lib->resize() === true) {
                // $fullpath = realpath($resize_path);
                return base_url().'upload/img/thumbs/'.$image_data['file_name']; //本番環境では "\" を　"/" に変更
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}