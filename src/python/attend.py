import os
import json
import requests
import sys
import mysql.connector as mydb
from time import sleep
from datetime import datetime, date, timedelta
import tkinter
from tkinter import ttk
from PIL import Image, ImageTk

input_strings = ''
NUM_LIST = [
    '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
]
IMG_PATH = '/home/pi/workspace/techis/tmp/'
DB_SETTING = json.load(
    open('/home/pi/workspace/techis/src/python/config/database.json'))
API_OPTION = json.load(
    open('/home/pi/workspace/techis/src/python/config/setting.json'))
ERROR = json.load(
    open('/home/pi/workspace/techis/src/python/config/error.json'))


def dbconnect():
    try:
        config = DB_SETTING
        conn = mydb.connect(**config)
        return conn
    except:
        # import traceback
        # traceback.print_exc()
        print('error: database.jsonかSQLserverの設定を確認して下さい')
        sys.exit(1)


def get_students():
    try:
        option = API_OPTION
        resp = requests.get(option['students']['url'],
                            json=option['students']['params'], headers=option['header'])
        if resp.status_code == requests.codes.ok:
            res_dict = resp.json()
            if int(res_dict['totalCount']) > 0:
                return res_dict['records']
            else:
                raise ValueError(1)
        else:
            raise ValueError(resp.status_code)
    except ValueError as e:
        res_dict = resp.json()
        print(res_dict)
        print(ERROR['api_error'][str(e)])
        sys.exit(1)
        # return -1
        # sys.exit(1)


def insert_students(students_dict):
    try:
        conn = dbconnect()
        cur = conn.cursor(prepared=True)
        for student in students_dict:
            student_id = student['ID']['value'].replace('STUDENT-', '')
            # query = "INSERT INTO students(student_id, student_name, student_barcode) SELECT %s, %s, %s\
            #         FROM DUAL WHERE NOT EXISTS(SELECT * FROM students WHERE student_barcode=%s)"
            query = "INSERT INTO students(student_id, student_name, student_barcode) VALUES(%s, %s, %s)\
                    ON DUPLICATE KEY UPDATE `student_name` = %s, `student_barcode` = %s; "
            data = (student_id, student['Name']['value'], student['barcode']['value'],
                    student['Name']['value'], student['barcode']['value'])
            cur.execute(query, data)
            conn.commit()
        return True
    except ValueError as e:
        print(e)
        error_render_img()
        print(ERROR['api_error'][str(e)])
        return -1
        # sys.exit(1)


def on_press(event):
    global input_strings
    if format(event.keysym) in NUM_LIST:
        input_strings += format(event.keysym)
    return


def on_release(event):
    global input_strings
    barcode = ''
    if event.keysym == 'Escape':
        print("exit program")
        root.destroy()
    elif event.keysym == 'Return':
        try:
            if (input_strings == ''):
                raise ValueError(1)
            barcode = input_strings
            input_strings = ''
            print(barcode)
            sleep(2)
            student_id = find_student_id(barcode)
            print(student_id)
            if student_id > 0:
                record_id = get_record_kintone(student_id)
                if record_id > 0:
                    if update_record_kintone(record_id):
                        print('更新に成功しました')
                        status = 0
                    else:
                        print('更新に失敗しました')
                else:
                    if insert_record_kintone(student_id):
                        print('登録に成功しました')
                        status = 1
                    else:
                        print('登録に失敗しました')
                name = find_student_name(barcode)
                change_render_img(status, name)
            else:
                error = ERROR["scan_error"]["1"]
                error_render_img(error)
                print(error)
        except ValueError:
            print('エラーが発生しました')
    return


def default():
    label.configure(text="バーコードスキャン待機中")
    img2 = ImageTk.PhotoImage(Image.open(
        IMG_PATH + 'logo.png'))
    label1.configure(image=img2)
    label1.image = img2
    label1.grid()


def change_render_img(status, name=None):
    if status > 0:
        label.configure(text=name)
        img2 = ImageTk.PhotoImage(Image.open(
            IMG_PATH + 'hello.jpg'))
        label1.configure(image=img2)
        label1.image = img2
    else:
        label.configure(text=name)
        img2 = ImageTk.PhotoImage(Image.open(
            IMG_PATH + 'bye.jpg'))
        label1.configure(image=img2)
        label1.image = img2
    root.after(1000, default)


def error_render_img(error=None):
    label.configure(text=error)
    img2 = ImageTk.PhotoImage(Image.open(
        IMG_PATH + 'error.jpg'))
    label1.configure(image=img2)
    label1.image = img2
    root.after(1000, default)


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


def find_student_name(barcode):
    conn = dbconnect()
    cur = conn.cursor(prepared=True)
    query = "SELECT student_name FROM students WHERE student_barcode=?"
    cur.execute(query, (barcode, ))
    result = cur.fetchone()
    if result == None:
        return "名無しさん"
    else:
        return str(result[0] + "さん")


def get_record_kintone(student_id):
    try:
        option = API_OPTION
        today = datetime.today()
        now = datetime.strftime(today, '%Y-%m-%dT00:00:00+0900')
        nextday = datetime.strftime(
            today + timedelta(days=1), '%Y-%m-%dT00:00:00+0900')
        params = {
            "app": option['GET']['app'],
            "query": "student_id = \"" + str(student_id) + "\" and attend_at > \"" + now + "\" and attend_at < \"" + nextday + "\" and attend_status in (\"出席中\")",
            "fields": [
                "record_id",
            ],
            "totalCount": True
        }
        resp = requests.get(option['GET']['url'],
                            json=params, headers=option['header'])
        res_dict = resp.json()
        if resp.status_code == requests.codes.ok:  # vscode上でpylintエラーが出るが無視して構わない
            print(res_dict)
            if res_dict['totalCount'] == "1":
                return int(res_dict['records'][0]['record_id']['value'])
            else:
                return -1
        else:
            raise ValueError(resp.status_code)
    except ValueError as e:
        error = ERROR['api_error'][str(e)]
        error_render_img(error)
        print(error)
        return
        # sys.exit(1)


def insert_record_kintone(student_id):
    try:
        option = API_OPTION
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
            raise ValueError(resp.status_code)
    except ValueError as e:
        error = ERROR['api_error'][str(e)]
        error_render_img(error)
        print(error)
        return False
        # sys.exit(1)


def update_record_kintone(record_id):
    try:
        option = API_OPTION
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
            raise ValueError(resp.status_code)
    except ValueError as e:
        error_render_img()
        print(ERROR['api_error'][e])
        return -1
        # sys.exit(1)


if __name__ == "__main__":
    result = get_students()
    if insert_students(result):
        print('生徒情報更新完了')
    root = tkinter.Tk()
    # root.configure(bg='white')
    root.title(u"出席管理システム")
    root.attributes('-zoomed', True)
    label = ttk.Label(root, text="バーコードスキャン待機中")
    label.grid(row=0, column=0)
    img = tkinter.PhotoImage(file='/home/pi/workspace/popup/src/img/logo.png')
    label1 = ttk.Label(root, image=img)
    label1.grid(row=1, column=0)
    root.grid_columnconfigure(0, weight=1)
    root.grid_rowconfigure(0, weight=1)
    root.grid_rowconfigure(1, weight=1)
    root.bind('<KeyPress>', on_press)
    root.bind('<KeyRelease>', on_release)
    root.mainloop()
