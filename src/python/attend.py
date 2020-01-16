import os
import json
import requests
import sys
from time import sleep
from datetime import datetime, date, timedelta


import mysql.connector as mydb
from pynput.keyboard import Key, Listener
import pynput.keyboard


input_strings = ''


kintone_respError = {
    1: "生徒情報が空です",
    400: "クエリ構文エラー",
    520: "APIトークンエラー"
}


def dbconnect():
    try:
        config = json.load('./config/database.json')
        conn = mydb.connect(**config)
        return conn
    except:
        import traceback
        traceback.print_exc()
        print('error: database.jsonかSQLserverの設定を確認して下さい')
        sys.exit()


def get_students():
    option = json.load(
        open('/home/pi/workspace/techis/src/python/config/setting.json'))
    resp = requests.get(option['students']['url'],
                        json=option['students']['params'], headers=option['header'])
    if resp.status_code == requests.codes.ok:
        res_dict = resp.json()
        if int(res_dict['totalCount']) > 0:
            return res_dict['records']
        else:
            return 1
    else:
        return resp.status_code


def insert_students(students_dict):
    try:
        conn = dbconnect()
        cur = conn.cursor(prepared=True)
        for student in students_dict:
            query = "INSERT INTO students(student_name, student_barcode) SELECT %s, %s\
                    FROM DUAL WHERE NOT EXISTS(SELECT * FROM students WHERE student_barcode=%s)"
            data = (student['Name']['value'], student['barcode']['value'],
                    student['barcode']['value'])
            cur.execute(query, data)
            conn.commit()
        return True
    except:
        return False


def on_press(key):
    barcode = ''
    global input_strings
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
    student_id = find_student_id(barcode)
    if student_id > 0:
        record_id = get_kintone(student_id)
        if record_id > 0:
            if put_kintone(record_id):
                print('更新に成功しました')
            else:
                print('更新に失敗しました')
        else:
            if post_kintone(student_id):
                print('登録に成功しました')
            else:
                print('登録に失敗しました')
    else:
        print("バーコードが存在しないかAPIトークンが間違っています")
    return


def find_student_id(barcode):
    conn = dbconnect()
    cur = conn.cursor(prepared=True)
    query = "SELECT student_id FROM students WHERE student_barcode=?"
    cur.execute(query, (barcode, ))
    result = cur.fetchone()
    if result == None:
        return -1
    else:
        return int(result[0])


def get_kintone(student_id):
    option = json.load(
        open('./config/setting.json'))
    today = datetime.today()
    now = datetime.strftime(today, '%Y-%m-%dT00:00:00+0900')
    nextday = datetime.strftime(
        today + timedelta(days=1), '%Y-%m-%dT00:00:00+0900')
    params = {
        "app": "17",
        "query": "student_id = \"" + str(student_id) + "\" and attend_at > \"" + now + "\" and attend_at < \"" + nextday + "\" and attend_status in (\"出席中\")",
        "fields": [
            "record_id",
        ],
        "totalCount": True
    }
    resp = requests.get(option['GET']['url'],
                        json=params, headers=option['header'])
    res_dict = resp.json()
    if res_dict['totalCount'] == "1":
        return int(res_dict['records'][0]['record_id']['value'])
    else:
        return -1


def post_kintone(student_id):
    option = json.load(
        open('./config/setting.json'))
    now = datetime.now().strftime('%Y-%m-%dT%H:%M:%S+0900')
    params = {
        "app": option['POST']['app'],
        "record": {
            "student_id": {
                "value": student_id
            },
            "attend_at": {
                "value": now
            },
            "attend_status": {
                "value": "出席中"
            }
        }
    }
    resp = requests.post(option['POST']['url'],
                         json=params, headers=option['header'])
    if resp.status_code == requests.codes.ok:  # vscode上でpylintエラーが出るが無視して構わない
        return True
    else:
        return False


def put_kintone(record_id):
    option = json.load(
        open('./config/setting.json'))
    now = datetime.now().strftime('%Y-%m-%dT%H:%M:%S+0900')
    params = {
        "app": option['PUT']['app'],
        "id": record_id,
        "record": {
            "left_at": {
                "value": now
            },
            "attend_status": {
                "value": "退席済"
            }
        }
    }
    resp = requests.put(option['PUT']['url'],
                        json=params, headers=option['header'])
    if resp.status_code == requests.codes.ok:  # vscode上でpylintエラーが出るが無視して構わない
        return True
    else:
        return False


if __name__ == '__main__':
    result = get_students()
    if isinstance(result, list):
        if insert_students(result):
            print('生徒一覧を更新しました')
        else:
            print('生徒一覧の更新に失敗しました。')
            sys.exit()
    else:
        print(kintone_respError[result])
        sys.exit()
    if os.name == 'nt':
        # Windows用
        KeyCodeClassInfo = pynput.keyboard._win32.KeyCode
    else:
        # Linux用
        KeyCodeClassInfo = pynput.keyboard._xorg.KeyCode
    with Listener(
        on_press=on_press,
    ) as listener:
        listener.join()
