<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cl_staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        $_SESSION["shop_id"] = 1;
        $this->load->model('mdl_staff');
        $this->load->model('mdl_shift');
        $this->load->helper(["url", "form"]);
        $_SESSION['shop_id'] = 1;
    }

    public function index()
    {
        $column_array = [ "staff_name" => "title", "shift_name" => "start", "shift_start" => "start", "shift_end" => "end" ];
        if($staffs = $this->mdl_staff->get_staff_list()) {
            foreach($staffs as $row => $staff) {
                foreach($staff as $column => $value) {
                    $data['staff'][$row][$column] = $value;
                }
            }
            $data['staff'] = $this->json_encode_array($data['staff']);
        } else {
            $data['staff'] = null;
        }
        if($shifts = $this->mdl_shift->select_shift_data()) {
            foreach($shifts as $row => $shift) {
                foreach($shift as $column => $value) {
                    if(array_key_exists($column, $column_array)) {
                        $data['shift'][$row][$column_array[$column]] = $value;
                    } else {
                        $data['shift'][$row][$column] = $value;
                    }
                }
            }
            $data["shift"] = $this->json_encode_array($data["shift"]);
        } else {
            $data["shift"] = "{}";
        }
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/staff/view_staff_list', $data);
    }

    private function json_encode_array($array)
    {
        return !empty($array) && gettype($array) === "array" ? json_encode($array, JSON_UNESCAPED_UNICODE): null;
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
    public function check_staff_data()
    {
        $config = [
            [
            'field' => 'staff_name',
            'label' => '名前',
            'rules' => 'required|trim'
            ],
            [
                'field' => 'staff_tel',
                'label' => '電話',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'staff_email',
                'label' => 'メールアドレス',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'staff_color',
                'label' => 'カラーラベル',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'staff_remarks',
                'label' => '備考',
                'rules' => 'trim'
            ]
    ];
        $this->load->library("form_validation", $config);
        return $this->form_validation->run();
    }

    private function insert_staff()
    {
        $data = [
        "staff_shop_id" => $_SESSION['shop_id'],
        "staff_name" => $this->input->post("staff_name"),
        "staff_tel" => $this->input->post("staff_tel"),
        "staff_mail" => $this->input->post("staff_email"),
        "staff_color" => $this->input->post("staff_color"),
        "staff_remarks" => $this->input->post("staff_remarks")
    ];
        return $this->mdl_staff->insert_staff_data($data);
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
        return $this->mdl_staff->update_staff_data($id, $data);
    }

    public function delete_staff()
    {
        $id = [
            "staff_id" => $this->input->post("staff_id"),
            "staff_shop_id" => $_SESSION["shop_id"],
        ];
        if($this->mdl_staff->delete_staff_data($id) === true) {
            echo "success";
            exit;
        } else {
            echo "dberror";
            exit;
        }
    }
}
