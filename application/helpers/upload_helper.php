<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('upload_image')) {
    /**
     * Fungsi untuk mengupload gambar
     * @param string $input_name Nama input file
     * @param string $upload_path Path penyimpanan file
     * @param array $allowed_types Tipe file yang diizinkan
     * @return array Hasil upload
     */
    function upload_image($input_name, $upload_path)
    {
        $ci = &get_instance(); // Ambil instance CI

        // Pastikan folder tujuan ada
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        // Konfigurasi upload
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 5000; // Maksimal ukuran file dalam KB (2 MB)
        $config['encrypt_name'] = true; // Enkripsi nama file

        $ci->load->library('upload', $config);

        // Proses upload
        if (!$ci->upload->do_upload($input_name)) {
            return [
                'status' => false,
                'error' => $ci->upload->display_errors('', ''),
            ];
        } else {
            return [
                'status' => true,
                'data' => $ci->upload->data(),
            ];
        }
    }
}
