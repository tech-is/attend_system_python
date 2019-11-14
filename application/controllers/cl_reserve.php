<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_reserve extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->helper(['url', 'form']);
        $this->load->model('mdl_reserve');
        $_SESSION['shop_id'] = 1;
    }

    public function index()
    {
        $this->load->model('mdl_total_list');
        $data = [
            'total' => !empty($array = $this->mdl_total_list->m_get_total_list($_SESSION['shop_id']))? $this->json_encode_array($array): null,
            'reserve' => !empty($array = $this->get_reserve($_SESSION['shop_id']))? $this->json_encode_array($array): null
        ];
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/reserve/view_reserve', $data);
    }

    private function json_encode_array($array)
    {
        return !empty($array) && gettype($array) === "array" ? json_encode($array): null;
    }

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

    private function judge_request_via_ajax()
    {
        if(empty($_SERVER['HTTP_X_CSRF_TOKEN']) || $_SERVER['HTTP_X_CSRF_TOKEN'] !== $_SESSION['token']) {
            header('HTTP/1.1 403 Forbidden');
            exit();
        }
    }

    public function get_reserve_via_ajax()
    {
        $this->judge_request_via_ajax();
        $columns = [
            'pet_name' => 'title',
            'reserve_start' => 'start',
            'reserve_end' => 'end'
        ];
        if(!empty($reserves = $this->mdl_reserve->get_reserve_list($_SESSION['shop_id']))) {
            foreach($reserves as $row => $reserve) {
                foreach($reserve as $column => $value) {
                    if(array_key_exists($column, $columns)) {
                        $data[$row][$columns[$column]] = $value;
                    } else {
                        $data[$row][$column] = $value;
                    }
                }
            }
            $data = $this->json_encode_array($data);
        } else {
            $data = "error";
        }
        header('Content-Type: application/json; charaset=utf-8');
        echo $data;
        exit();
    }

    private function reserve_column($which)
    {
        $columns = ['reserve_pet_id', 'reserve_start', 'reserve_end', 'reserve_content', 'reserve_color'];
        foreach($columns as $column) {
            $data[$column] = $this->input->post($column);
        }
        $which === 'insert'? $data['reserve_shop_id'] = $_SESSION['shop_id']: false;
        return $data;
    }

    public function register_reserve_data()
    {
        $this->judge_request_via_ajax();
        if($this->resereve_validation()) {
            $data = $this->reserve_column('insert');
            echo $this->mdl_reserve->insert_reserve_data($data)? 'success': 'dberr';
        } else {
            echo 'valierr';
        }
        exit;
    }

    public function update_reserve_data()
    {
        $this->judge_request_via_ajax();
        if($this->resereve_validation()) {
            $data = [
                'where' => [
                    'reserve_shop_id' => $_SESSION['shop_id'],
                    'reserve_id' => $this->input->post('reserve_id')
                ],
                'update' => $this->reserve_column('update')
            ];
            echo $this->mdl_reserve->update_reserve_data($data)? 'success': 'dberr';
        } else {
            echo 'valierr';
        }
        exit;
    }

    public function delete_reserve_data()
    {
        $this->judge_request_via_ajax();
        if(!empty($this->input->post('reserve_id'))) {
            $data = [
                'reserve_shop_id' => $_SESSION['shop_id'],
                'reserve_id' => $this->input->post('reserve_id')
            ];
            echo $this->mdl_reserve->delete_reserve_data($data)? 'success': 'dberr';
        } else {
            echo 'valierr';
        }
        exit;
    }

    private function resereve_validation()
    {
        $config = [
            [
                'field' => 'reserve_pet_id',
                'label' => 'ペット名',
                'rules' => 'required'
            ],
            [
                'field' => 'reserve_start',
                'label' => '来店予定日',
                'rules' => 'required'
            ],
            [
                'field' => 'reserve_end',
                'label' => '終了予定日',
                'rules' => 'required'
            ],
            [
                'field' => 'reserve_end',
                'label' => '終了予定日',
                'rules' => 'required'
            ],
            [
                'field' => 'reserve_end',
                'label' => '終了予定日',
                'rules' => 'required'
            ]
        ];
        $this->load->library('form_validation', $config);
        return $this->form_validation->run();
    }
}