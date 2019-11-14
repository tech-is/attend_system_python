<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_shift extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        session_start();
        isset($_SESSION["shop_id"])? true : exit;
        $this->load->helper(["url", "form"]);
    }

    public function insert_shift()
    {
        if($this->shift_validation() === true) {
            $this->load->model("Mdl_shift");
            $data = [
                'shift_shop_id' => $_SESSION['shop_id'],
                'shift_staff_id' => $this->input->post("staff_id"),
                'shift_start' => $this->input->post("shift_start"),
                'shift_end' => $this->input->post("shift_end")
            ];
            if($this->Mdl_shift->insert_shift_data($data)) {
                echo "success";
                exit;
            } else {
                echo "dberror";
                exit;
            }
        } else {
            echo "valierr";
            exit;
        }
    }

    public function update_shift_data()
    {
        if($this->shift_validation() === true) {
            $this->load->model("Mdl_shift");
            $id = [
                'shift_shop_id' => $_SESSION["shop_id"],
                'shift_id' => $this->input->post("shift_id")
            ];
            $data = [
                'shift_staff_id' => $this->input->post("staff_id"),
                'shift_start' => $this->input->post("shift_start"),
                'shift_end' => $this->input->post("shift_end")
            ];
            if($this->Mdl_shift->update_shift_data($id, $data)) {
                echo "success";
                exit;
            } else {
                echo "dberror";
                exit;
            }
        } else {
            echo "valierr";
            exit;
        }
    }

    public function delete_shift_data()
    {
        $id = [
            "shift_id" => $this->input->post("shift_id"),
            "shift_shop_id" =>  $_SESSION["shop_id"]
        ];
        $this->load->model("Mdl_shift");
        if($this->Mdl_shift->delete_shift_data($id) == true) {
            echo "success";
        } else {
            echo "dberror";
        }
    }

    private function shift_validation()
    {
        $config = [
            [
                'field' => 'staff_id',
                'label' => 'スタッフID',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'shift_start',
                'label' => '開始日時',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'shift_end',
                'label' => '終了日時',
                'rules' => 'required|trim'
            ]
        ];
        $this->load->library("form_validation", $config);
        $result = $this->form_validation->run();
        return $result;
    }

}