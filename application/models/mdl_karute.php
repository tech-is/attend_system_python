<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * タイトル：顧客・ペット管理
 * 説明    ：顧客・ペットの登録・変更・削除を行う
 *
 * 著作権  ：Copyright(c) 2019 TECH I.S
 * 会社名  ：TECH I.S
 *
 * 変更履歴：2019.8 開発
 */

class Mdl_karute extends CI_Model {

    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
        $this->load->database();
    }

    //kind_groupをインサート
    public function insert_karute_data($data)
    {
        $this->db->insert('karure', $data)? $result = true: $result = false;
        return $result;
    }
    //kauteの診断内容のを削除
    public function delete_karute_data($id)
    {
        $this->db->set("kareute", 999);
        $this->db->where(['karute_id'=> $id['karute_id'], 'karute_shop_id ' => $id["shop_id"]]);
        return $this->db->update('kakrute');
    }

    //更新の中身を取得(Cl_karuteもしよう)
    public function m_karute_get($shop_id,$customer_id)
    {
        // echo $customer_id;
        // exit;
        $where = ['customer_state ' => 1, 'pet_state ' => 1, 'customer_shop_id'=>$shop_id, 'customer_id'=>$customer_id];
        $this->db->where($where);
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('pet', 'customer_id = pet_customer_id', 'left');
        $this->db->join('kind_group', 'customer_id = kind_group_shop_id', 'left');
        $this->db->join('reserve', 'customer_id = reserve_customer_id', 'left');
        $this->db->join('staff', 'customer_id = staff_shop_id', 'left');
        $query = $this->db->get();
        // SQL文を教えてくれる
        // echo $this->db->last_query();
        // exit;
        return $query->row_array(); //結果を配列で返す。
    }

    //新規登録の顧客とカルテをここで登録
    // public function m_insert_karute($customer_data, $pet_data)
    // {
    //     $this->db->trans_start();
    //     $this->db->insert('customer', $customer_data);
    //     //insert_idを取得して今↑で登録されたお客さんの新規顧客IDを取得する
    //     //$pet_data に上のIDを追加する
    //     $id = $this->db->insert_id();
    //     $pet_data['pet_customer_id'] = $id;
    //     $this->db->insert('pet',$pet_data);
    //     $this->db->trans_complete();
    //     if ($this->db->trans_status() === FALSE) {
    //     $this->db->trans_rollback();
    //         return false;
    //     } else {
    //     $this->db->trans_commit();
    //         return true;
    //     }
    // }

    //更新処理
    // public function m_update_total_list($id, $customer_data, $pet_data)
    // {
    //     $this->db->trans_start();
    //     $this->db->set($customer_data);
    //     $this->db->where(['customer_id'=> $id['customer_id']]);
    //     $this->db->update('customer');
    //     $this->db->set($pet_data);
    //     $this->db->where(['pet_id'=> $id['pet_id']]);
    //     $this->db->update('pet');
    //     $this->db->trans_complete();
    //     if ($this->db->trans_status() === FALSE) {
    //     $this->db->trans_rollback();
    //         return false;
    //     } else {
    //     $this->db->trans_commit();
    //         return true;
    //     }
    // }
}        