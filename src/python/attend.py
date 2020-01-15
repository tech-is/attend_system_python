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
        # print(conn.is_connected()) #接続確認用
        return conn
    except:
        print('エラー発生のためシステムを強制終了します')
        print('error: database.jsonかSQLserverの設定を確認して下さい')
        sys.exit()


def on_press(key):
    barcode = ''
    global input_strings, KeyCodeClassInfo
    if isinstance(key, KeyCodeClassInfo):
        input_strings += key.char
        return
    elif isinstance(key, Key) and str(key) == "Key.enter":
        barcode = input_strings
        input_strings = ''
    elif isinstance(key, Key) and str(key) == "Key.esc":
        return False
    else:
        return
    student_id = find_studend_id(barcode)
    if student_id > 0:
        record_id = get_attend(student_id)
        if record_id > 0:
            if update_attend(record_id):
                print('更新に成功しました')
            else:
                print('更新に失敗しました')
        else:
            if insert_attend(student_id):
                print('登録に成功しました')
            else:
                print('登録に失敗しました')
    else:
        print("バーコードが存在しません")
    return


def find_studend_id(barcode):
    conn = dbconnect()
    cur = conn.cursor(prepared=True)
    query = "SELECT student_id FROM students WHERE student_barcode=?"
    cur.execute(query, (barcode, ))
    result = cur.fetchone()
    if result == None:
        return -1
    else:
        return int(result[0])


def get_attend(student_id):
    conn = dbconnect()
    cur = conn.cursor(prepared=True)
    today = str(datetime.today().strftime('%Y-%m-%d 00:00:00'))
    tomorrow = str(datetime.today().strftime('%Y-%m-%d 23:59:59'))
    cur = conn.cursor(prepared=True)
    query = "SELECT record_id FROM attend_record INNER JOIN students ON attend_record.student_id = students.student_id WHERE students.student_id = %s AND attended_at >= %s  AND attended_at < %s AND scan_status = 0"
    data = (student_id, today, tomorrow)
    cur.execute(query, data)
    result = cur.fetchone()
    if result == None:
        return -1
    else:
        return int(result[0])


def insert_attend(student_id):
    try:
        conn = dbconnect()
        cur = conn.cursor(prepared=True)
        query = "INSERT INTO attend_record (student_id, attended_at) VALUES (%s, %s)"
        now = str(datetime.now().strftime('%Y-%m-%d %H:%M:%S'))
        data = (student_id, now)
        cur.execute(query, data)
        conn.commit()
        conn.close()
        return True
    except:
        # import traceback
        # traceback.print_exc()
        conn.close()
        return False


def update_attend(record_id):
    try:
        conn = dbconnect()
        cur = conn.cursor(prepared=True)
        now = str(datetime.now().strftime('%Y-%m-%d %H:%M:%S'))
        sql = "UPDATE attend_record SET lefted_at=%s, scan_status = 1 WHERE record_id=%s"
        data = (now, record_id)
        cur.execute(sql, data)
        conn.commit()
        conn.close()
        return True
    except:
        # import traceback
        # traceback.print_exc()
        conn.close()
        return False


if __name__ == '__main__':
    if os.name == 'nt':
        # Windows用
        KeyCodeClassInfo = pynput.keyboard. _win32.KeyCode
    else:
        # Linux用
        KeyCodeClassInfo = pynput.keyboard._xorg.KeyCode
    with Listener(
        on_press=on_press,
    ) as listener:
        listener.join()
