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

    /**
     * GETで受け取った値を参照してviewファイルに出力
     *
     * @return void
     */
    public function index()
    {
        $column = 'default';
        if (!empty($_GET)) {
            if(array_key_exists('where', $_GET)) {
                $data['td_arrays'] = $this->Mdl_attend->get_attend($column = $this->input->get('where')); //月集計、週集計
            } elseif (array_key_exists('designated', $_GET)) {
                $data['td_arrays'] = $this->Mdl_attend->get_attend_designated_date($this->input->get('designated')); //日付指定
            } elseif (array_key_exists('dateRange', $_GET)) {
                $data['td_arrays'] = $this->Mdl_attend->get_attend_DateRange($this->input->get('dateRange')); //範囲指定
            } else {
                $data['td_arrays'] = $this->Mdl_attend->get_attend(); //参照がないときは基本的に今日の日付のデータを返す
            }
        } else {
            $data['td_arrays'] = $this->Mdl_attend->get_attend(); //参照がないときは基本的に今日の日付のデータを返す
        }
        // exit($this->db->last_query()); // SQLデバッグ用
        $data['columns'] = $column;
        $this->load->view('pages/parts/header');
        $this->load->view('pages/parts/sidebar');
        $this->load->view('pages/attend/view_attend', $data);
    }

    /**
     * バーコード読み取り用のviewを生成
     *
     * @return void
     */
    public function accepting()
    {
        $this->load->view('pages/attend/view_accepting');
    }

    /**
     * POSTされたバーコードからDB参照してあれば出退席をDBに登録する
     *
     * @return mixed
     */
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

    /**
     * テストデータをDBに登録
     *
     * @return void
     */
    public function migrarion()
    {
        // for ($i=0; $i<30; $i++) {
            // $start = date('Y-m-d H:i:s', 1569855600+36000+(86400*$i))."\n";
            // // $end = date('Y-m-d H:i:s', 1569855600+79200+(86400*$i))."\n";
            // $start = date('Y-m-d H:i:s', 1572534000+36000+(86400*$i))."\n";
            // $end = date('Y-m-d H:i:s', 1572534000+79200+(86400*$i))."\n";
            // $this->db->insert('attendance_record', ['student_id' => 1, 'attended_at' => $start, 'lefted_at' => $end]);
            // $this->db->insert();
        // }
    }
}
