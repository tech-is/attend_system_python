<?php

class mdl_customer extends CI_Model
{
     //ANIMARLのデータベースを呼び出し
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //カスタマーの更新の時に以下を呼び出す。
    public function m_select_customer()
    {
        $this->db->where(['customer_shop_id'=> 1, 'customer_state' => 1]);
        // $this->db->where('shop_id', 1);
        $this->db->select('customer_name, customer_kana, customer_tel, customer_zip_adress, customer_address, customer_mail, customer_magazine, customer_group');
        $this->db->from('customer');
        $query = $this->db->get();
        $result =  $query->result_array();
        return  $result;
    }

    public function m_insert_customer($newresult)
    {
        // var_dump($c_test);
        //$c_testは連想配列、カラム名をkeyとして格納し
        //1引数でテーブル名、2で連想配列として受け渡す

        if($this->db->insert('customer', $newresult)) {
            return true;
        }else{
            echo "セッション以外のやつが失敗";
            // return false;
        }
    }

    public function update_customer_data($id, $data)
    {
        //update customer set ($data) where = customer_id and customer_shop_id;
        $this->db->set($data);
        $this->db->where(['customer_id'=> $id['customer_id'], 'customer_shop_id' => $id['customer_shop_id']]);
        return $this->db->update('customer');
    }

    public function delete_customer_data($id)
    {
        $this->db->set("customer_state", 999);
        $this->db->where(['customer_id'=> $id['customer_id'], 'customer_shop_id' => $id['customer_shop_id']]);
        return $this->db->update('customer');
    }

    public function get_customer_email($id)
    {
        return $this->db->select('customer_mail')
            ->where($id)
            ->get();
    }

}