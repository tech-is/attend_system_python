<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cl_kind_group extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->helper(["url", "form"]);
    }

    public function index()
    {
        $this->load->helper(["url", "form"]);
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/Vi_kind_group');
    }

    public function register_staff()
    {
        if(isset($_SESSION['shop_id'])) {
            if ($this->check_staff_data() == true) {
                if ($this->insert_staff() == true) {
                    echo "success";
                    exit;
                } else {
                    echo "false";
                    exit;
                }
            } else {
                echo "vali_err";
                exit;
            }
        } else {
            echo "NoSession";
            exit;
        }
    }

    public function update_staff_list()
    {
        if ($this->check_staff_data() == true) {
            $result = $this->update_staff();
            if ($result == true) {
                echo "success";
                exit;
            } else {
                echo "false";
                exit;
            }
        } else {
            echo "vali_err";
            exit;
        }
    }

    /**
     * check_user
     *
     * @param $_POST["email"] = ポストされたメールアドレス
     * @return メインページにリダイレクト
     */
    public function group_check()
    {
        $config = [
            [
            'field' => 'kind_group_name',
            'label' => '名前',
            'rules' => 'required|trim'
            ]
    ];
        $this->load->library("form_validation", $config);
        return $this->form_validation->run();
    }

    private function insert_staff()
    {
        $data = [
        "kind_group_id" => $_SESSION['shop_id'],
        "kind_group_name" => $this->input->post("staff_name")
    ];
        $this->load->model("Mdl_kind_group");
        return $this->Mdl_kind_group->insert_model_data($data);
    }

    private function update_staff()
    {
        $id = [
            "staff_id" => $this->input->post("staff_id"),
            "staff_shop_id" => $_SESSION["shop_id"]
        ];
        $data = [
            "staff_name" => $this->input->post("staff_name"),
            "staff_tel" => $this->input->post("staff_tel"),
            "staff_mail" => $this->input->post("staff_email"),
            "staff_color" => $this->input->post("staff_color"),
            "staff_remarks" => $this->input->post("staff_remarks")
        ];
        $this->load->model("mdl_staff");
        return $this->mdl_staff->update_staff_data($id, $data);
    }

    public function delete_staff()
    {
        $id = [
            "staff_id" => $this->input->post("staff_id"),
            "staff_shop_id" => $_SESSION["shop_id"],
        ];
        $this->load->model("mdl_staff");
        if($this->mdl_staff->delete_staff_data($id) === true) {
            echo "success";
            exit;
        } else {
            echo "dberror";
            exit;
        }
    }
}
