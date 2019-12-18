<?php
class Mdl_attend extends CI_Model
{
    /**
     * 引数から月別・週別を参照し、SQLを実行
     *
     * @param string $where
     * @return array|bool
     */
    public function get_attend($where = null)
    {
        if ($where === 'weeks') {
            $this->db->select('record_id, student_name, SEC_TO_TIME(SUM(TIME_TO_SEC(lefted_at) - TIME_TO_SEC(attended_at))) as time_diff ,DATE_SUB(attended_at, INTERVAL (WEEKDAY(attended_at)+1) DAY) wday')
            ->group_by('wday');
        } elseif ($where === 'months') {
            $this->db->select('record_id, student_name, SEC_TO_TIME(SUM(TIME_TO_SEC(lefted_at) - TIME_TO_SEC(attended_at))) as time_diff, DATE_FORMAT(attended_at, "%Y-%m") as month')
            ->group_by('DATE_FORMAT(attended_at, "%Y%m")');
        } elseif ($where === 'total') {
            $this->db->select('record_id, student_name, attended_at, lefted_at, TIMEDIFF(lefted_at, attended_at) as time_diff')->order_by('record_id', 'DESC');
        } else {
            $this->db->select('record_id, student_name, attended_at, lefted_at, TIMEDIFF(lefted_at, attended_at) as time_diff')->where('attended_at > DATE_SUB(NOW(), INTERVAL 1 DAY)');
        }
        return $this->db->join('students', 'students.student_id = attendance_record.student_id', 'inner')->get('attendance_record')->result_array();
    }

    /**
     * 指定した日付のデータを取得するSQLを実行
     *
     * @param string $date
     * @return array|bool
     */
    public function get_attend_designated_date($date)
    {
        $this->db->select('record_id, student_name, attended_at, lefted_at, TIMEDIFF(lefted_at, attended_at) as time_diff')->where(" DATE_FORMAT(`attended_at`, '%m%d') = DATE_FORMAT('{$date}', '%m%d')");
        return $this->db->join('students', 'students.student_id = attendance_record.student_id', 'inner')->get('attendance_record')->result_array();
    }

    /**
     * 指定範囲内の日付のデータを取得するSQLを実行
     *
     * @param array $date
     * @return array|bool
     */
    public function get_attend_DateRange($date)
    {
        $this->db->select('record_id, student_name, attended_at, lefted_at, TIMEDIFF(lefted_at, attended_at) as time_diff')->where("attended_at BETWEEN '{$date[0]}' AND '{$date[1]}'");
        return $this->db->join('students', 'students.student_id = attendance_record.student_id', 'inner')->get('attendance_record')->result_array();
    }

    /**
     * 生徒dbからバーコードの読み取った値を参照して出席を記録
     *
     * @param string $barcode
     * @return bool
     */
    public function judge_attendance($barcode)
    {
        if (!empty($student = $this->db->select('student_id, student_name')->where($barcode)->get('students')->row_array())) {
            if (
                !empty($record = $this->db->select('record_id, scan_status')->
                where('attended_at >="'. date('Y-m-d H:i:s', strtotime('today')).'" and attended_at <"'. date('Y-m-d H:i:s', strtotime('tomorrow')).'" and scan_status = 0')->
                where('student_id', $student['student_id'])->get('attendance_record')->row_array())
            ) {
                return $this->db->where(['record_id' => $record['record_id']])->update('attendance_record', ['lefted_at' => date('Y-m-d H:i:s'), 'scan_status' => 1])? ['index' => 2]: false;
            } else {
                return $this->db->insert('attendance_record', ['student_id' => $student['student_id'], 'attended_at' => date('Y-m-d H:i:s')])? ['index' => 1, 'student' => $student['student_name']]: false;
            }
        } else {
            return false;
        }
    }
}
