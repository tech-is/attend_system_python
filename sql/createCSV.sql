-- 現在日時でデータ集計を取ってCSVに出力するquery
USE attendance_db;
SET @t1=CONCAT(current_date, " 00:00:00"), @t2=CONCAT(current_date, " 23:59:59");
SELECT student_name, current_date, SEC_TO_TIME(SUM(TIME_TO_SEC(lefted_at) - TIME_TO_SEC(attended_at))) as result_time
FROM attendance_db.attendance_record
INNER JOIN students ON students.student_id = attendance_record.student_id
WHERE attended_at >= @t1
AND attended_at < @t2
INTO OUTFILE 'C:\\xampp\\tech_isys\\upload\\data.csv' -- 必要に応じて保存パスを書き換えてください
CHARACTER SET 'utf8'
  FIELDS TERMINATED BY ','
ENCLOSED BY '"'
 ESCAPED BY '"'
   LINES TERMINATED BY '\r\n';