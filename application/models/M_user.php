<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    private $table = 'users';

    public function get_all_users()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
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
