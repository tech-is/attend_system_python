<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attend extends CI_Controller
{
    //コンストラクタ
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form", 'ajax']);
        $this->load->model('Mdl_attend');
        date_default_timezone_set('Asia/Tokyo');
    }

    public function index()
    {
        $data['json'] = !empty($return = $this->Mdl_attend->get_attend())? json_encode($return): '{}';
        $this->load->view('pages/parts/header');
        $this->load->view('pages/parts/sidebar');
        $this->load->view('pages/attend/view_attend', $data);
    }

    public function accepting()
    {
        $this->load->view('pages/attend/view_accepting');
    }

    public function judge_attendance()
    {
        if (!empty($barcode = $this->input->post('barcode'))) {
            $this->load->model('Mdl_attend');
            if ($data = $this->Mdl_attend->judge_attendance(['student_barcode' => $barcode])) {
                $res_array = callback_json_msg('attend', true, $data['index'], @$data['student']?: null);
            } else {
                $res_array = callback_json_msg('attend', false);
            }
            header('Content-Type: application/json');
            exit(json_encode($res_array));
        }
        exit;
    }

    public function get_attend_in_designated_date()
    {
        $date = $this->input->post('date')?: header('Location: '.base_url().'attend');
    }
}