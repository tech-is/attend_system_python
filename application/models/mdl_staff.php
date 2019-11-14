<?php

class Mdl_staff extends CI_Model
{

    public function get_staff_list()
    {
        $where = ['staff_shop_id' => $_SESSION["shop_id"], 'staff_state' => 1];
        $this->db->where($where);
        $this->db->select("staff_id, staff_name, staff_tel, staff_mail, staff_color, staff_remarks");
        $this->db->from('staff');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_staff_data($data)
    {
        $this->db->insert('staff', $data)? $result = true: $result = false;
        return $result;
    }

    public function update_staff_data($id, $data)
    {
        $this->db->set($data);
        $this->db->where(['staff_id'=> $id['staff_id'], 'staff_shop_id' => $id['staff_shop_id']]);
        return $this->db->update('staff');
    }

    public function delete_staff_data($id)
    {
        $this->db->set("staff_state", 999);
        $this->db->where(['staff_id'=> $id['staff_id'], 'staff_shop_id' => $id['staff_shop_id']]);
        return $this->db->update('staff');
    }

}