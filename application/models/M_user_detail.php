<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user_detail extends CI_Model
{
    private $table = 'detail_pengguna';

    public function get_all_details()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function get_detail_by_user_id($user_id)
    {
        return $this->db->get_where($this->table, ['user_id' => $user_id])->row_array();
    }

    public function insert_detail($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_detail($id, $data)
    {
        return $this->db->update($this->table, $data, ['id' => $id]);
    }

    public function delete_detail($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
