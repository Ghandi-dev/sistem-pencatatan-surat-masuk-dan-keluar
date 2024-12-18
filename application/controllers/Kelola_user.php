<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login') || $this->session->userdata('role') != 'superadmin') {
            $this->session->sess_destroy();
            redirect('auth');
        }
        $this->load->model('M_user');
        $this->load->model('M_user_detail');
        $this->load->helper('upload');

    }

    public function index()
    {
        $users = $this->M_user_detail->get_all_details_with_user();
        $data = [
            'title' => 'kelola user',
            'users' => $users,
        ];
        $this->load->view('pages/kelola_user/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'kelola user',
        ];
        $this->load->view('pages/kelola_user/add', $data);
    }

    public function add_process()
    {
        // Ambil data dari input form
        $nama_lengkap = htmlspecialchars($this->input->post('nama_lengkap'));
        $nomor_telepon = htmlspecialchars($this->input->post('nomor_telepon'));
        $tanggal_lahir = htmlspecialchars($this->input->post('tanggal_lahir')); // Tambahkan ini
        $role = htmlspecialchars($this->input->post('role'));
        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars($this->input->post('password'));

        // Upload foto profil
        $upload = upload_image('image', 'assets/upload/user/');
        if (!$upload['status']) {
            $this->session->set_flashdata('error', $upload['error']);
            redirect('kelola_user/add'); // Perbaikan tujuan redirect
            return;
        }
        $image = $upload['data']['file_name'];

        // Siapkan data user
        $user = [
            "username" => $username,
            "password" => password_hash($password, PASSWORD_BCRYPT),
            "role" => $role,
        ];

        // Mulai transaksi database
        $this->db->trans_begin();

        // Insert data user
        if (!$this->M_user->insert_user($user)) {
            $this->session->set_flashdata('error', 'Gagal menambahkan user');
            $this->db->trans_rollback();
            redirect('kelola_user/add');
        }

        // Ambil ID user yang baru ditambahkan
        $user_id = $this->db->insert_id();

        // Siapkan data user detail
        $user_detail = [
            "user_id" => $user_id, // ID pengguna dari hasil insert
            "nama_lengkap" => $nama_lengkap,
            "nomor_telepon" => $nomor_telepon,
            "tanggal_lahir" => $tanggal_lahir,
            "foto_profil" => $image,
        ];

        // Insert data user detail
        if (!$this->M_user_detail->insert_detail($user_detail)) {
            $this->session->set_flashdata('error', 'Gagal menambahkan detail user');
            $this->db->trans_rollback();
            redirect('kelola_user/add');
        }

        // Commit transaksi
        $this->db->trans_commit();

        // Set pesan sukses dan redirect
        $this->session->set_flashdata('success', 'Berhasil menambahkan user');
        redirect('kelola_user');
    }

    public function edit($id)
    {
        $user = $this->M_user->get_user_by_id($id);
        $user_detail = $this->M_user_detail->get_detail_by_user_id($id);
        $data = [
            'title' => 'kelola user',
            'user' => $user,
            'user_detail' => $user_detail,
        ];
        $this->load->view('pages/kelola_user/edit', $data);
    }

    public function edit_process($id)
    {
        $nama_lengkap = htmlspecialchars($this->input->post('nama_lengkap'));
        $nomor_telepon = htmlspecialchars($this->input->post('nomor_telepon'));
        $tanggal_lahir = htmlspecialchars($this->input->post('tanggal_lahir')); // Tambahkan ini
        $role = htmlspecialchars($this->input->post('role'));
        $image = $_FILES['image']['name'];
        $old_image = htmlspecialchars($this->input->post('old_image'));
        if (empty($image)) {
            $image = $old_image;
        } else {
            $upload = upload_image('image', 'assets/upload/user/');

            if (!$upload['status']) {
                $this->session->set_flashdata('error', $upload['error']);
                redirect('kelola_user/edit/' . $id);
                return;
            }
            unlink('assets/upload/user/' . $old_image);
            $image = $upload['data']['file_name'];
        }
        // Mulai transaksi database
        $this->db->trans_begin();

        $user_detail = [
            "nama_lengkap" => $nama_lengkap,
            "nomor_telepon" => $nomor_telepon,
            "tanggal_lahir" => $tanggal_lahir,
            "foto_profil" => $image,
        ];

        // Insert data user detail
        if (!$this->M_user_detail->update_detail($id, $user_detail)) {
            $this->session->set_flashdata('error', 'Gagal mengubah detail user');
            $this->db->trans_rollback();
            redirect('kelola_user/edit' . $id);
            return;

        }

        $user = [
            "role" => $role,
        ];

        if (!$this->M_user->update_user($id, $user)) {
            $this->session->set_flashdata('error', 'Gagal mengubah detail user');
            $this->db->trans_rollback();
            redirect('kelola_user/edit' . $id);
            return;
        }

        // Commit transaksi
        $this->db->trans_commit();

        // Set pesan sukses dan redirect
        $this->session->set_flashdata('success', 'Berhasil mengubah user');
        redirect('kelola_user');

    }

    public function change_password($id)
    {
        $password = htmlspecialchars($this->input->post('password'));
        $data = [
            "password" => password_hash($password, PASSWORD_BCRYPT),
        ];
        if (!$this->M_user->update_user($id, $data)) {
            $this->session->set_flashdata('error', 'Gagal mengubah password user');
            redirect('kelola_user/edit' . $id);
            return;
        }
        $this->session->set_flashdata('success', 'Berhasil mengubah password');
        redirect('kelola_user');

    }
    public function delete($id)
    {
        $user_detail = $this->M_user_detail->get_detail_by_user_id($id);
        if (!$this->M_user->delete_user($id)) {
            $this->session->set_flashdata('error', 'Gagal menghapus user');
            redirect('kelola_user');
            return;
        }
        unlink('assets/upload/user/' . $user_detail->foto_profil);
        $this->session->set_flashdata('success', 'Berhasil menghapus user');
        redirect('kelola_user');
    }

    public function check_username()
    {
        $username = htmlspecialchars($this->input->post('username'));
        $is_exist = $this->M_user->is_username_exist($username);

        // Return hasil dalam format JSON
        echo json_encode(['exists' => $is_exist]);
    }

}
