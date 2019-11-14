<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_pet_info extends CI_Controller {

    /**
     *
     * Undocumented function
     *
     * @return
     */
    public function index()
    {
        $this->load->helper(["url", "form"]);
        //ペットカルテ
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pet_info_view');
    }

    //入力後のミス確認からモデルへ
    public function pet_info_validation()
    {
        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');
        $this->load->model('mdl_pet_info');
        $p_data['pet_contraception'] ="";
        $p_data['pet_type'] ="";
        $config = [
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
                    'required' => '入力してください'
                ]
                ],
            [
                'field' => 'pet_animal_gender',
                'label' => '性別',
                'rules' => '',
                'errors' => [
                    'required' => '選択してください'
                ]
                ],
            [
                'field' => 'pet_birthday',
                'label' => '生年月日',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '入力してください'
                ]
            ],
            [
                'field' => 'pet_contraception',
                'label' => '避妊',
                'rules' => ''
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
        // $p_data = $this->input->post();
        // var_dump($p_data);
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == true){
            $p_data = $this->input->post();
                    //避妊をintへ
            if(isset($p_data['pet_contraception'])){
                if($p_data['pet_contraception'] == 'on') {
                    $p_data['pet_contraception'] = 1;
                } else {
                    $p_data['pet_contraception'] = 2;
                }
                //モデルへ
                if($this->mdl_pet_info->insert_pet_model($p_data) == true) {
                    redirect('http://localhost/sub/cl_total_list/?flg=2');
                } else {
                    // echo "hoooooooooooooooooooooge";
                    $data['comment'] = "※登録に失敗しました。再度ご入力をお願いします。";
                    $this->load->view('cms/pages/parts/header');
                    $this->load->view('cms/pages/parts/sidebar');
                    $this->load->view('cms/pet_info_view',$data);
                }
            }
        } else {
            //バリデーション
            // echo "huuuuuuuuuuu";
            $this->load->view('cms/pages/parts/header');
            $this->load->view('cms/pages/parts/sidebar');
            $this->load->view('cms/pet_info_view');
        }

                //リダイレクトでGETを飛ばす。vi_total_listの新規登録の横あたりにif echo
                // を出す
                // $this->mdl_pet_info->insert_pet_model($p_data);
                // $this->load->library('session');

    }

}
