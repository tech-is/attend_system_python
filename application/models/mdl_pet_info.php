<?php

class mdl_pet_info extends CI_Model
{
     //ANIMARLのデータベースを呼び出し
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //データの登録
   //登録するデータを第一引数で持つ
    public function insert_pet_model($p_data)
    {
        //$c_testは連想配列、カラム名をkeyとして格納し
        //1引数でテーブル名、2で連想配列として受け渡す

        if($this->db->insert('pet',$p_data)) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * get_customer_table
     * custmoerテーブルからデータを配列で取得
     * @return $query->result();
     */
}