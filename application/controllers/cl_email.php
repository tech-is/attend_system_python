<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * class cl_mail
 * メールを扱う関数を主に置いています
 * メールホストを設定したい場合にはapplication/confing/email.phpを書き換えてください
 */

class Cl_email extends CI_Controller {

    /**
     * send_mail_magazine メールマガジンを送る
     * @param $magazine_id = マガジンテンプレートのインデックスid
     *        $data = DB内のマガジンテンプレートを配列で格納
     * @return メールを指定した顧客に送信
     */
    public function send_mail_magazine()
    {
        $this->judge_request_via_ajax();
        $this->load->model('mdl_magazine', 'mdl_customer');
        $id = [
            "customer_shop_id" => @$_SESSION['shop_id']?: exit,
            "customer_id" => @$this->input->post['customer_id']?: exit
        ];
        $bbc_email = $this->mdl_customer->get_customer_email($id);
        $id = [
            "mail_magazine_id" => $this->input->post("mail_magazine_id"),
            "mail_shop_id" => @$_SESSION['shop_id']?: exit,
        ];
        $data = $this->mdl_magazine->get_magazine_setting($id);
        $this->load->library("email");
        $this->email->from($data["mail"], $data["mail_sender_name"])
            ->subject($data["mail_subject"])
            ->bcc('them@their-example.com')
            ->message($data["mail_detail"])
            ->send();
    }

    private function judge_request_via_ajax()
    {
        if(empty($_SERVER['HTTP_X_CSRF_TOKEN']) || $_SERVER['HTTP_X_CSRF_TOKEN'] !== $_SESSION['token']) {
            header('HTTP/1.1 403 Forbidden');
            exit();
        }
    }

    public function send_mail_test()
    {
        try {
            $mail = [
                "mail_header_name" => ["hero"],
                "to" => ["delta0716@gmail.com"],
            ];
            $this->load->library("email");
            $this->load->model("mdl_cms");
            $data = ["mail_subject" => "システムメール","mail_detail" => "テスト"];
            for($i = 0; $i < count($mail); $i++) {
                $this->email->from("system_animarl@niji-desk.work", $mail["mail_header_name"][$i]);
                $this->email->to($mail["to"][$i]);
                $this->email->set_newline("\r\n");
                $this->email->subject($data["mail_subject"]);
                $this->email->message($data["mail_detail"]);
                $this->email->send();
            }
            echo "送信成功";
        } catch(extension $e) {
            echo "メールの送信に失敗しました";
            exit;
        }
    }

}