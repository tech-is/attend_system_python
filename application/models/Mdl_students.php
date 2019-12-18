<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_students extends CI_Model
{
    /**
     * 生徒の情報を取得
     *
     * @param integer $student_id
     * @return array|bool
     */
    public function get_students(int $student_id = null)
    {
        $student_id? $this->db->where(['student_id' => $student_id]): false;
        return $this->db->select('student_id, student_barcode, student_name, student_kana, student_tel, student_email, student_zipcode, student_streetaddress')->get('students')->result_array();
    }

    /**
     * 生徒のdb情報を登録
     *
     * @param array $data
     * @return bool
     */
    public function insert_student($data)
    {
        return $this->db->insert('students', $data);
    }

    /**
     * 生徒のdb情報を更新
     *
     * @param array $data
     * @return bool
     */
    public function update_student($data)
    {
        return $this->db->where($data['where'])->update('students', $data['update']);
    }
}