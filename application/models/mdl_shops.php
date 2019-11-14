<?php

class Mdl_shops extends CI_Model
{

    public function get_tmp_email($code)
    {
        return $this->db->select("tmp_shop_email")
            ->where("tmp_shop_code", $code)
            ->get("tmp_shops")
            ->row_array();
    }

    public function insert_shops($data)
    {
        $this->db->trans_start();
        $query = $this->db->insert('shops', $data);
        $query = $this->db->where('tmp_shop_email', $data['shop_email'])->delete('tmp_shops');
        $this->db->trans_complete();
        return !$this->db->trans_status()? false: true;
    }

    public function update_shops()
    {
        $this->db->where('id', $id);
        return $this->db->update('shops', $data);
    }

    public function delete_email($email)
    {
        $this->db->delete('shops', ['email' => $email]);
    }

}