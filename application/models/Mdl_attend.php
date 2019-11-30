<?php
class Mdl_attend extends CI_Model
{
    public function get_attend()
    {
        return $this->db->join('students', 'students.student_id = attendance_record.student_id' ,'inner')
        ->select('TIMEDIFF(lefted_at, attended_at) as time_diff', FALSE)
        ->select('student_name, record_id, attended_at, lefted_at')->get('attendance_record')->result_array();
    }

    public function judge_attendance($barcode)
    {
        if (!empty($student = $this->db->select('student_id, student_name')->where($barcode)->get('students')->row_array())) {
            if (!empty($record = $this->db->select('record_id, scan_status')->where('attended_at >="'. date('Y-m-d H:i:s', strtotime('today')).'" and attended_at <"'. date('Y-m-d H:i:s', strtotime('tomorrow')).'" and scan_status = 0')->
            where('student_id', $student['student_id'])->get('attendance_record')->row_array())) {
                if($this->db->where(['record_id' => $record['record_id']])->update('attendance_record', ['lefted_at' => date('Y-m-d H:i:s'), 'scan_status' => 1])) {
                    return $return = ['index' => 2];
                } else {
                    return false;
                }
            } else {
                return $this->db->insert('attendance_record', ['student_id' => $student['student_id'], 'attended_at' => date('Y-m-d H:i:s')])? ['index' => 1, 'student' => $student['student_name']]: false;
            }
        } else {
            return false;
        }
    }
}