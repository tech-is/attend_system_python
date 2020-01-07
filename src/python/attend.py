import os
import json
import sys
from time import sleep

from datetime import datetime, date, timedelta
import mysql.connector as mydb
from pynput.keyboard import Key, Listener
import pynput.keyboard


input_strings = ''


def dbconnect():
    try:
        path = os.path.dirname(os.path.abspath(__file__))
        config = json.load(open(path + '/config/database.json'))
        conn = mydb.connect(**config)
        return conn
    except:
        print('error: database.jsonかSQLserverの設定を確認して下さい')
        sys.exit()


def on_press(key):
    barcode = ''
    global input_strings
    # if isinstance(key, pynput.keyboard._xorg.KeyCode): #linux用
    if isinstance(key, pynput.keyboard._win32.KeyCode): #windows用
        input_strings += key.char
        return
    elif isinstance(key, Key) and str(key) == "Key.enter":
        barcode = input_strings
        input_strings = ''
    elif isinstance(key, Key) and str(key) == "Key.esc":
        return False
    else:
        return
    student_id = exists_barcode(barcode)
    if student_id:
        result = record_attend(student_id)
        print(result)
        return
    else:
        print("バーコードが存在しません")
        return


def exists_barcode(barcode):
    conn = dbconnect()
    # print(conn.is_connected()) #接続確認用
    cur = conn.cursor(prepared=True)
    query = "SELECT student_id FROM students WHERE student_barcode=?"
    cur.execute(query, (barcode, ))
    result = cur.fetchone()
    if result == None:
        return False
    else:
        return str(result[0])


def record_attend(student_id):
    conn = dbconnect()
    today = str(datetime.today().strftime('%Y-%m-%d 00:00:00'))
    tomorrow = str(datetime.today().strftime('%Y-%m-%d 23:59:59'))
    cur = conn.cursor(prepared=True)
    query = "SELECT record_id FROM attendance_record INNER JOIN students ON attendance_record.student_id = students.student_id WHERE students.student_id = %s AND attended_at >= %s  AND attended_at < %s AND scan_status = 0"
    data = (student_id, today, tomorrow)
    cur.execute(query, data)
    result = cur.fetchone()
    if result == None:
        try:
            query = "INSERT INTO attendance_record (student_id, attended_at) VALUES (%s, %s)"
            now = str(datetime.now().strftime('%Y-%m-%d %H:%M:%S'))
            data = (student_id, now)
            cur.execute(query, data)
            conn.commit()
            conn.close()
            return '登録しました'
        except:
            import traceback
            traceback.print_exc()
            conn.close()
            return '登録に失敗しました'
    else:
        record_id = str(result[0])
        # print(record_id)
        try:
            now = str(datetime.now().strftime('%Y-%m-%d %H:%M:%S'))
            sql = "UPDATE attendance_record SET lefted_at=%s, scan_status = 1 WHERE record_id=%s"
            data = (now, record_id)
            cur.execute(sql, data)
            conn.commit()
            conn.close()
            return '更新しました'
        except:
            import traceback
            traceback.print_exc()
            conn.close()
            return '更新に失敗しました'


if __name__ == '__main__':
    with Listener(
        on_press=on_press,
    ) as listener:
        listener.join()