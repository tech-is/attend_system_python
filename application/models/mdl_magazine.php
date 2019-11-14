<?php
class Mdl_magazine extends CI_Model
{

    public function get_magazine($id)
    {
        return $this->db->select('mail_magazine_id, mail_sender_name, mail_subject, mail_detail')
            ->where(['mail_shop_id' => $id, 'mail_state' => 1])
            ->get('mail_magazine', 10)
            ->result_array();
    }

    public function get_magazine_count($id)
    {
        return $this->db->select('mail_magazine_id')
            ->where('mail_shop_id', $id)
            ->count_all('mail_magazine');
    }

    public function get_magazine_setting($id)
    {
        return $this->db->select('mail_sender_name, mail_subject, mail_detail')
            ->where($id)
            ->get('mail_magazine')
            ->row_array();
    }

    public function insert_magazine($data)
    {
        return $this->db->insert('mail_magazine', $data['set']);
    }

    public function update_magazine($data)
    {
        return $this->db->set($data['set'])
            ->where($data['where'])
            ->update('mail_magazine');
    }

    public function delete_magazine($id)
    {
        return $this->db->set('mail_state', 999)
            ->where($id)
            ->update('mail_magazine');
    }
}