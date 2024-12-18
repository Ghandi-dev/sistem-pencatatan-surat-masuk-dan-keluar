<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            redirect('auth');
        }
        $this->load->model('M_letter');
        $this->load->model('M_user');
    }

    public function index()
    {
        $jumlah_surat_keluar = $this->M_letter->count_letter();
        $jumlah_surat_masuk = $this->M_letter->count_letter(['type' => 'incoming']);
        $jumlah_user = $this->M_user->count_user();
        $letter_out_last_5_days = $this->M_letter->letters_per_day_last_5_days();
        $letter_in_last_5_days = $this->M_letter->letters_per_day_last_5_days('incoming');
        $data = [
            'title' => 'dashboard',
            'jumlah_surat_keluar' => $jumlah_surat_keluar,
            'jumlah_surat_masuk' => $jumlah_surat_masuk,
            'jumlah_user' => $jumlah_user,
            'letter_out_last_5_days' => $letter_out_last_5_days,
            'letter_in_last_5_days' => $letter_in_last_5_days,
        ];
        $this->load->view('pages/dashboard/index', $data);
    }
}
