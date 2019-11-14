<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
        // date_default_timezone_set('Asia/Tokyo');
        session_start();
        isset($_SESSION['shop_id'])?: header('location: //animarl.com/login');
    }

    public function index()
    {
        $this->load->model('mdl_reserve');
        $columns = [
            'pet_name' => 'title',
            'reserve_start' => 'start',
            'reserve_end' => 'end'
        ];
        if(!empty($reserves = $this->mdl_reserve->get_reserve_list($_SESSION['shop_id']))) {
            foreach($reserves as $row => $reserve) {
                foreach($reserve as $column => $value) {
                    if(array_key_exists($column, $columns)) {
                        $data['reserve'][$row][$columns[$column]] = $value;
                    } else {
                        $data['reserve'][$row][$column] = $value;
                    }
                }
            }
        } else {
            $data['reserve'] = null;
        }
        $data['reserve'] = !empty($data['reserve'])? json_encode($data['reserve']): null;
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/home/view_home', $data);
    }

}
