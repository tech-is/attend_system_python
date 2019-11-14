<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_reserve extends CI_Model
{

    public function get_reserve_list($shop_id)
    {
        return $this->db->where(['reserve_shop_id' => $shop_id, 'reserve_state' => 1])
            ->select("reserve_id, reserve_customer_id, reserve_pet_id, reserve_start, reserve_end, reserve_content, customer_name, pet_name")
            ->from('reserve')
            ->join('pet', 'pet_id = reserve_pet_id', 'left')
            ->join('customer', 'customer_id = reserve_customer_id', 'left')
            ->get()
            ->result_array();
    }

    public function insert_reserve_data($data)
    {
        return $this->db->insert('reserve', $data);
    }


    public function update_reserve_data($data)
    {
        return $this->db->set($data['update'])
            ->where($data['where'])
            ->update('reserve');
    }

    public function delete_reserve_data($id)
    {
        return $this->db->set('reserve_state', 999)
            ->where($id)
            ->update('reserve');
    }

}