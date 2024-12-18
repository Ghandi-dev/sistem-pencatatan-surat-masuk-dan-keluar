<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'laporan',
        ];
        $this->load->view('pages/laporan/index', $data);
    }
}
