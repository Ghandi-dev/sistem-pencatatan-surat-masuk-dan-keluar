<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_masuk extends CI_Controller
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
        $surat_masuk = $this->M_letter->get_letters_by_type('incoming');
        $data = [
            'title' => 'surat masuk',
            'surat_masuk' => $surat_masuk,
        ];
        $this->load->view('pages/surat_masuk/index', $data);
    }

    public function add()
    {
        $surat_keluar = $this->M_letter->get_letters_by_type('outgoing');
        $data = [
            'title' => 'tambah surat masuk',
            'surat_keluar' => $surat_keluar,
        ];
        $this->load->view('pages/surat_masuk/add', $data);

    }

    public function add_process()
    {
        $id = htmlspecialchars($this->input->post('id_surat'));
        // var_dump($id);
        $deskripsi_barang = htmlspecialchars($this->input->post('deskripsi_barang'));
        $satuan = htmlspecialchars($this->input->post('satuan'));
        $qty = htmlspecialchars($this->input->post('qty'));
        // Hapus format ribuan (koma)
        $qty = str_replace('.', '', $qty);

        // Pastikan nilai adalah integer
        $qty = (int) $qty;

        $no_pol = htmlspecialchars($this->input->post('no_pol'));
        $tgl_kembali = htmlspecialchars($this->input->post('tgl_kembali'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));

        $data = [
            "deskripsi_barang" => $deskripsi_barang,
            "qty" => $qty,
            "no_pol" => $no_pol,
            "satuan" => $satuan,
            "tgl_kembali" => $tgl_kembali,
            "keterangan" => $keterangan,
            "type" => 'incoming',

        ];

        if (!isset($id)) {
            $this->session->set_flashdata('error', 'Data surat tidak ada');
            redirect('surat_masuk/add');
        }
        if (!$this->M_letter->update_letter($id, $data)) {
            $this->session->set_flashdata('error', 'Data surat masuk gagal ditambahkan');
            redirect('surat_masuk/add');
        }
        $this->session->set_flashdata('success', 'Data surat masuk berhasil ditambahkan');
        redirect('surat_masuk');
    }

    public function edit($id)
    {
        $surat_masuk = $this->M_letter->get_letter_by_id($id);
        $data = [
            'title' => 'edit surat keluar',
            'surat_masuk' => $surat_masuk,
        ];
        $this->load->view('pages/surat_masuk/edit', $data);
    }

    public function edit_process($id)
    {
        $id = $id;
        $deskripsi_barang = htmlspecialchars($this->input->post('deskripsi_barang'));
        $qty = htmlspecialchars($this->input->post('qty'));
        // Hapus format ribuan (koma)
        $qty = str_replace('.', '', $qty);

        // Pastikan nilai adalah integer
        $qty = (int) $qty;
        $satuan = htmlspecialchars($this->input->post('satuan'));
        $no_pol = htmlspecialchars($this->input->post('no_pol'));
        $tgl_kembali = htmlspecialchars($this->input->post('tgl_kembali'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));

        $data = [
            "deskripsi_barang" => $deskripsi_barang,
            "qty" => $qty,
            "satuan" => $satuan,
            "no_pol" => $no_pol,
            "tgl_kembali" => $tgl_kembali,
            "keterangan" => $keterangan,
            "type" => 'incoming',

        ];

        if (!$this->M_letter->update_letter($id, $data)) {
            $this->session->set_flashdata('error', 'Data surat masuk gagal diubah');
            redirect('surat_masuk/add');
        }
        $this->session->set_flashdata('success', 'Data surat masuk berhasil diubah');
        redirect('surat_masuk');
    }

}
