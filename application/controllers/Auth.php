<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pembeli_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }

    public function register() {
        // Jika form disubmit
        if ($this->input->post()) {
            $nama      = $this->input->post('nama');
            $email     = $this->input->post('email');
            $password  = $this->input->post('password');
            $password2 = $this->input->post('password2');
            $nohp = $this->input->post('nohp');
            $kodepos = $this->input->post('kodepos');

            // Cek apakah password dan konfirmasi cocok
            if ($password != $password2) {
                $this->session->set_flashdata('error', 'Password dan konfirmasi tidak cocok!');
                redirect('auth/register');
            }

            // Cek apakah email sudah terdaftar
            if ($this->Pembeli_model->cek_email($email)) {
                $this->session->set_flashdata('error', 'Email sudah terdaftar!');
                redirect('auth/register');
            }

            // Simpan ke database
            $data = [
                'nama_pembeli' => $nama,
                'email'        => $email,
                'no_hp'        => $nohp,
                'kode_pos'        => $kodepos,
                'password'     => password_hash($password, PASSWORD_DEFAULT),
                'status'       => 'aktif' // default aktif
            ];
            $this->Pembeli_model->insert_pembeli($data);

            $this->session->set_flashdata('success', 'Pendaftaran berhasil, silakan login.');
            redirect('auth/login');
        } else {
            $this->load->view('register');
        }
    }

    public function login()
    {
        // Jika sudah login, redirect ke home
        if ($this->session->userdata('pembeli_id')) {
            redirect('home');
        }
    
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
    
            $user = $this->Pembeli_model->get_by_email($email);
    
            if ($user && password_verify($password, $user['password'])) {
                // Simpan ke session
                $this->session->set_userdata([
                    'pembeli_id' => $user['id'], // pastikan sesuai field database
                    'nama_pembeli' => $user['nama'],
                    'is_logged_in' => true
                ]);
    
                redirect('home'); // Arahkan ke halaman utama setelah login
            } else {
                $this->session->set_flashdata('error', 'Email atau password salah!');
                redirect('auth/login');
            }
        } else {
            $this->load->view('login');
        }
    }
    
    public function logout()
    {
        $this->session->unset_userdata(['pembeli_id', 'nama_pembeli', 'is_logged_in']);
        $this->session->set_flashdata('success', 'Anda telah logout.');
        redirect('auth/login');
    }

    
}
