<?php

class Mdl_shift extends CI_Model
{
    public function select_shift_data()
    {
        $this->db->where(['shift_shop_id' => $_SESSION["shop_id"], 'shift_state' => 1, 'staff_state' => 1]);
        $this->db->select('staff_id, shift_id, staff_name, shift_start, shift_end, staff_color');
        $this->db->from('staff_shift');
        $this->db->join('staff', 'staff_id = shift_staff_id', 'inner');
        $query = $this->db->get();
        $result =  $query->result_array();
        return $result;
    }

    public function insert_shift_data($data)
    {
        $this->db->insert('staff_shift', $data)? $result = true: $result = false;
        return $result;
    }

    public function update_shift_data($id, $data)
    {
        $this->db->set($data);
        $this->db->where(['shift_id'=> $id['shift_id'], 'shift_shop_id' => $id['shift_shop_id']]);
        return $this->db->update('staff_shift');
}

    public function delete_shift_data($id)
    {
        $this->db->set("shift_state", 999);
        $this->db->where(['shift_id'=> $id['shift_id'], 'shift_shop_id' => $id['shift_shop_id']]);
        return $this->db->update('staff_shift');
    }
}