<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_masuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_letter');
    }

    public function index()
    {
        $surat_masuk = $this->M_letter->get_letters_by_type('incoming');
        $data = [
            'title' => 'surat masuk',
            'surat_masuk' => $surat_masuk,
        ];
        $this->load->view('pages/surat_masuk/index', $data);
    }
}
