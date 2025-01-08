<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->model('M_user_detail');
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
        ];
        $this->load->view('pages/auth/login', $data);
    }

    public function login()
    {
        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars($this->input->post('password'));
        // cek username
        $user = $this->M_user->find_where(['username' => $username]);
        if ($user) {
            // cek password
            $user_detail = $this->M_user_detail->get_detail_by_user_id($user->id);
            if (password_verify($password, $user->password)) {
                $data = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role,
                    'foto' => $user_detail->foto_profil,
                    'login' => true,
                ];
                $this->session->set_userdata($data);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Password Salah');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('error', 'Username Tidak Ditemukan');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
