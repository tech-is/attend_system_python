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

class Mdl_total_list extends CI_Model {

    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
        $this->load->database();
    }

    //kind_groupをインサート
    public function insert_model_data($data)
    {
        $this->db->insert('kind_group', $data)? $result = true: $result = false;
        return $result;
    }
    //kind_groupを削除
    public function delete_kind_group_data($id)
    {
        $this->db->set("kind_group_state", 999);
        $this->db->where(['kind_group_id'=> $id['kind_group_id'], 'kind_group_shop_id ' => $id["shop_id"]]);
        return $this->db->update('kind_group');
    }

    //グループの登録の中身を取得
    public function m_get_kind_group($id)
    {
        $where = ['kind_group_shop_id ' => $id, 'kind_group_state ' => 1];
        $this->db->where($where);
        $this->db->select('kind_group_id, kind_group_name');
        $this->db->from('kind_group');
        $query = $this->db->get();
        return $query->result_array(); //結果を配列で返す。
    }

    //更新の中身を取得
    public function m_get_total_all($pet_id)
    {
        $where = ['customer_state ' => 1, 'pet_state ' => 1, 'pet_id '=> $pet_id];
        $this->db->where($where);
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('pet', 'customer_id = pet_customer_id', 'left');
        $query = $this->db->get();
        return $query->row_array(); //結果を配列で返す。
    }

    //画面表示分カスタマーのセレクトの分をとってくる
    public function m_get_total_list($shop_id)
    {
        $where = ['customer_state ' => 1, 'customer_shop_id '=> $shop_id];
        $this->db->where($where);
        $this->db->select("customer_id, pet_id , customer_name , pet_name , customer_tel , customer_mail , kind_group_name");
        $this->db->from('customer');
        $this->db->join('pet', 'customer_id = pet_customer_id', 'left');
        $this->db->join('kind_group', 'customer_group_id = kind_group_id', 'left');
        $query = $this->db->get();
        return $query->result_array(); //結果を配列で返す。
    }

    //新規登録のペットと顧客をここで登録
    public function m_insert_total_list($customer_data, $pet_data)
    {
        $this->db->trans_start();
        $this->db->insert('customer', $customer_data);
        //insert_idを取得して今↑で登録されたお客さんの新規顧客IDを取得する
        //$pet_data に上のIDを追加する
        $id = $this->db->insert_id();
        $pet_data['pet_customer_id'] = $id;
        $this->db->insert('pet',$pet_data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
            return false;
        } else {
        $this->db->trans_commit();
            return true;
        }
    }

    //更新処理
    public function m_update_total_list($id, $customer_data, $pet_data)
    {
        $this->db->trans_start();
        $this->db->set($customer_data);
        $this->db->where(['customer_id'=> $id['customer_id']]);
        $this->db->update('customer');
        $this->db->set($pet_data);
        $this->db->where(['pet_id'=> $id['pet_id']]);
        $this->db->update('pet');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
            return false;
        } else {
        $this->db->trans_commit();
            return true;
        }
    }
}