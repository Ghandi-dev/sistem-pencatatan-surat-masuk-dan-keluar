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

    public function count_letter($where = null)
    {
        if ($where) {
            $this->db->where($where);
        }
        $count = $this->db->count_all_results($this->table);
        return $count;
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

    public function get_filtered_data_table($start_date = null, $end_date = null, $type = 'incoming')
    {
        $totalRecords = $this->db->count_all($this->table);

        // Apply filters based on date range
        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where('DATE(l.tgl) >=', $start_date);
            $this->db->where('DATE(l.tgl) <=', $end_date);
        }
        $this->db->where('l.type', $type);

        // Perform the query
        $this->db->from($this->table . ' as l');
        $query = $this->db->get();

        // Return the data in the required format
        return [
            'totalRecords' => $totalRecords,
            'filteredRecords' => $query->num_rows(),
            'data' => $query->result(),
        ];
    }

    public function letters_per_day_last_5_days($type = null)
    {
        // Menghitung 5 hari terakhir
        $start_date = date('Y-m-d', strtotime('-5 days'));
        $end_date = date('Y-m-d');

        // Query untuk mendapatkan jumlah surat per hari
        $this->db->select('DATE(tgl) as letter_date, COUNT(*) as letter_count');
        if ($type) {
            $this->db->where('type', $type);
        }
        $this->db->where('DATE(tgl) >=', $start_date);
        $this->db->where('DATE(tgl) <=', $end_date);
        $this->db->group_by('DATE(tgl)');
        $this->db->order_by('DATE(tgl)', 'ASC'); // Urutkan berdasarkan tanggal
        $query_result = $this->db->get($this->table)->result();

        // Membuat array default untuk 5 hari terakhir
        $dates = [];
        for ($i = 5; $i >= 0; $i--) {
            $dates[date('Y-m-d', strtotime("-$i days"))] = 0;
        }

        // Memasukkan hasil query ke dalam array default
        foreach ($query_result as $row) {
            $dates[$row->letter_date] = $row->letter_count;
        }

        // Mengembalikan data dalam format yang bisa digunakan
        $result = [];
        foreach ($dates as $date => $count) {
            $result[] = [
                'letter_date' => $date,
                'letter_count' => $count,
            ];
        }

        return $result;
    }

}
