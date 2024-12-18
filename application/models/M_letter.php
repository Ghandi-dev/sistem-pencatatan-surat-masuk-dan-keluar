<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_letter extends CI_Model
{
    private $table = 'letters';

    public function get_all_letters()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_letter_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function get_letters_by_type($type)
    {
        return $this->db->get_where($this->table, ['type' => $type])->result();
    }

    public function insert_letter($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_letter($id, $data)
    {
        return $this->db->update($this->table, $data, ['id' => $id]);
    }

    public function delete_letter($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
