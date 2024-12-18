<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            redirect('auth');
        }
        $this->load->model('M_letter');
    }

    public function index()
    {
        $data = [
            'title' => 'laporan',
        ];
        $this->load->view('pages/laporan/index', $data);
    }

    public function data()
    {
        $date_range = $this->input->post('date_range');
        $start_date = null;
        $end_date = null;

        if (!empty($date_range)) {
            $dates = explode(' - ', $date_range);
            $start_date = $dates[0];
            $end_date = $dates[1];
        }

        // Panggil model
        $result = $this->M_letter->get_filtered_data_table($start_date, $end_date);

        // Menambahkan nomor urut pada hasil data
        $no = 0; // Nomor urut dimulai dari nilai $start + 1
        foreach ($result['data'] as $key => $value) {
            $result['data'][$key]->no = $no++; // Menambahkan kolom 'no' untuk nomor urut
        }

        // Kirim data dalam format JSON untuk DataTables
        $response = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $result['totalRecords'],
            "recordsFiltered" => $result['filteredRecords'],
            "data" => $result['data'],
        ];

        echo json_encode($response);
    }

    public function print()
    {
        $date_range = $this->input->get('date_range');
        // log_message('debug', 'Received date range: ' . $date_range);
        $start_date = null;
        $end_date = null;

        if (!empty($date_range)) {
            $dates = explode(' - ', $date_range);
            if (count($dates) == 2) {
                $start_date = trim($dates[0]);
                $end_date = trim($dates[1]);
            }
        }

        $result = $this->M_letter->get_filtered_data_table($start_date, $end_date)['data'];
        if (empty($result)) {
            $this->session->set_flashdata('error', "Data Kosong");
            redirect('laporan');
        }

        $data = [
            'title' => 'Laporan | ' . $date_range,
            'date_range' => $date_range,
            'surat_masuk' => $result, // pastikan result memiliki field 'data'
        ];

        // Load view untuk menampilkan report
        $this->load->view('pages/laporan/print_laporan', $data);
    }
}
