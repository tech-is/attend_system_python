import mysql.connector as mydb
from pynput.keyboard import Key, Listener
import pynput.keyboard
from time import sleep
from datetime import datetime, date, timedelta

input_strings = ''
now = str(datetime.now().strftime('%Y-%m-%d %H:%M:%S'))
today = str(datetime.today().strftime('%Y-%m-%d 00:00:00'))
tomorrow = str(datetime.today().strftime('%Y-%m-%d 23:59:59'))


def on_press(key):
    barcode = ''
    global input_strings
    if isinstance(key, pynput.keyboard._xorg.KeyCode):
        input_strings += key.char
        return
    elif isinstance(key, Key) and str(key) == "Key.enter":
        barcode = input_strings
        input_strings = ''
    elif isinstance(key, Key) and str(key) == "Key.esc":
        return False
    else:
        return
    print(judge_barcode(barcode))


def judge_barcode(barcode):
    conn = mydb.connect(
        host='localhost',
        port='3306',
        user='pi',
        password='h1r0n0bu',
        database='attendance_db'
    )
    # print(conn.is_connected())
    cur = conn.cursor()
    cur.execute(
        'select student_id from students where student_barcode ="' + barcode + '"')
    result = cur.fetchone()
    if result == None:
        return "バーコードが存在しません"
    else:
        student_id = str(result[0])
        sql = str('select record_id from attendance_record inner join students on attendance_record.student_id = students.student_id where students.student_id ="' +
                  student_id + '" and attended_at >="' + today + '" and attended_at <"' + tomorrow + '" and scan_status = 0')
        # print(sql)
        cur.execute(sql)
        result = cur.fetchone()
        if result == None:
            try:
                cur.execute(
                    'insert into attendance_record (student_id, attended_at) values (%s, %s)', (student_id, now))
                conn.commit()
                conn.close()
                return '登録しました'
            except:
                # import traceback
                # traceback.print_exc()
                conn.close()
                return '登録に失敗しました'
        else:
            record_id = str(result[0])
            try:
                sql = str('update attendance_record set lefted_at = "' +
                          now + '", scan_status = 1 where record_id="' + record_id + '"')
                # print(sql)
                cur.execute(sql)
                conn.commit()
                conn.close()
                return '更新しました'
            except:
                # import traceback
                # traceback.print_exc()
                conn.close()
                return '更新に失敗しました'


if __name__ == '__main__':
    with Listener(
        on_press=on_press,
    ) as listener:
        listener.join()
