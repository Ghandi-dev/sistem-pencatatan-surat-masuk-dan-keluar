<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    private $table = 'users';

    public function get_all_users()
    {
        return $this->db->get($this->table)->result();
    }

    public function count_user()
    {
        $count = $this->db->count_all_results($this->table);
        return $count;
    }

    public function is_username_exist($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0; // True jika username sudah ada
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function find_where($where)
    {
        return $this->db->get_where($this->table, $where)->row();
    }

    public function insert_user($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_user($id, $data)
    {
        return $this->db->update($this->table, $data, ['id' => $id]);
    }

    public function delete_user($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
