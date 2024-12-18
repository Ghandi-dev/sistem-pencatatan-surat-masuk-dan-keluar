<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user_detail extends CI_Model
{
    private $table = 'user_detail';

    public function get_all_details()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_all_details_with_user()
    {
        $this->db->select('user_detail.*, users.username, users.role'); // Pilih kolom yang dibutuhkan
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = user_detail.user_id', 'left'); // Lakukan LEFT JOIN
        $query = $this->db->get();

        return $query->result(); // Mengembalikan hasil sebagai array
    }

    public function get_detail_by_user_id($user_id)
    {
        return $this->db->get_where($this->table, ['user_id' => $user_id])->row();
    }

    public function insert_detail($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_detail($id, $data)
    {
        return $this->db->update($this->table, $data, ['user_id' => $id]);
    }

    public function delete_detail($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
