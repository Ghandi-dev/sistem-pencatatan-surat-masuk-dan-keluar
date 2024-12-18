<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_keluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_letter');
        $this->load->helper('upload');
    }

    public function index()
    {
        $surat_keluar = $this->M_letter->get_letters_by_type('outgoing');
        $data = [
            'title' => 'surat keluar',
            'surat_keluar' => $surat_keluar,
        ];
        $this->load->view('pages/surat_keluar/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'tambah surat keluar',
        ];
        $this->load->view('pages/surat_keluar/add', $data);
    }

    public function add_process()
    {
        $no_manifest = $this->input->post('no_manifest');
        $perusahaan_penghasil = $this->input->post('perusahaan_penghasil');
        $transporter = $this->input->post('transporter');
        $nama_supir = $this->input->post('nama_supir');
        $tanggal_surat = $this->input->post('tanggal_surat');
        $image = $_FILES['image']['name'];

        $upload = upload_image('image', 'assets/upload/surat_keluar/');

        if (!$upload['status']) {
            $this->session->set_flashdata('error', $upload['error']);
            redirect('surat_keluar/add');
            return;
        }

        $image = $upload['data']['file_name'];

        $data = [
            'no_manifest' => $no_manifest,
            'perusahaan_penghasil' => $perusahaan_penghasil,
            'transporter' => $transporter,
            'nama_supir' => $nama_supir,
            'tgl' => $tanggal_surat,
            'image' => $image,
            'type' => 'outgoing',
            // 'created_by' => $this->session->userdata('id'),
            'created_by' => 1,
        ];

        if (!$this->M_letter->insert_letter($data)) {
            $this->session->set_flashdata('error', 'Data surat keluar gagal ditambahkan');
        };
        $this->session->set_flashdata('success', 'Data surat keluar berhasil ditambahkan');
        redirect('surat_keluar');
    }

    public function edit($id)
    {
        $surat_keluar = $this->M_letter->get_letter_by_id($id);
        $data = [
            'title' => 'edit surat keluar',
            'surat_keluar' => $surat_keluar,
        ];
        $this->load->view('pages/surat_keluar/edit', $data);
    }

    public function edit_process($id)
    {
        $no_manifest = $this->input->post('no_manifest');
        $perusahaan_penghasil = $this->input->post('perusahaan_penghasil');
        $transporter = $this->input->post('transporter');
        $nama_supir = $this->input->post('nama_supir');
        $tanggal_surat = $this->input->post('tanggal_surat');
        $image = $_FILES['image']['name'];
        $old_image = $this->input->post('old_image');

        if (empty($image)) {
            $image = $old_image;
        } else {
            $upload = upload_image('image', 'assets/upload/surat_keluar/');

            if (!$upload['status']) {
                $this->session->set_flashdata('error', $upload['error']);
                redirect('surat_keluar/edit/' . $id);
                return;
            }
            unlink('assets/upload/surat_keluar/' . $old_image);
            $image = $upload['data']['file_name'];
        }

        $data = [
            'no_manifest' => $no_manifest,
            'perusahaan_penghasil' => $perusahaan_penghasil,
            'transporter' => $transporter,
            'nama_supir' => $nama_supir,
            'tgl' => $tanggal_surat,
            'image' => $image,
            'type' => 'outgoing',
            // 'updated_by' => $this->session->userdata('id'),
            'created_by' => 1,
        ];

        if (!$this->M_letter->update_letter($id, $data)) {
            $this->session->set_flashdata('error', 'Data surat keluar gagal diubah');
        };
        $this->session->set_flashdata('success', 'Data surat keluar berhasil diubah');
        redirect('surat_keluar');
    }

    public function delete($id)
    {
        if (!$this->M_letter->delete_letter($id)) {
            $this->session->set_flashdata('error', 'Data surat keluar gagal dihapus');
        };
        $this->session->set_flashdata('success', 'Data surat keluar berhasil dihapus');
        redirect('surat_keluar');
    }
}
