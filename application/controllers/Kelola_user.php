<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_user extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'kelola user',
        ];
        $this->load->view('pages/kelola_user/index', $data);
    }
}
