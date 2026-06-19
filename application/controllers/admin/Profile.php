<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        // Pastikan user admin login
        if (!$this->session->userdata('is_admin_logged_in')) {
            redirect('admin/login');
        }
    }

    public function index() {
        $data['admin'] = $this->Admin_model->get_by_id($this->session->userdata('admin_id'));
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/profile', $data);
        $this->load->view('admin/footer');
    }

    public function update() {
        $id = $this->session->userdata('admin_id');
        $data = [
            'nama'  => $this->input->post('nama'),
            'email' => $this->input->post('email')
        ];
        $this->Admin_model->update($id, $data);
        $this->session->set_flashdata('success', 'Profil berhasil diperbarui');
        redirect('admin/profile');
    }
    public function ganti() {
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $data['admin'] = $this->Admin_model->get_by_id($this->session->userdata('admin_id'));
        $this->load->view('admin/ganti_password', $data);
        $this->load->view('admin/footer');
    }

    public function ganti_password() {
       
        $id = $this->session->userdata('admin_id');
        $admin = $this->Admin_model->get_by_id($id);

        $lama = $this->input->post('password_lama');
        $baru = $this->input->post('password_baru');
        $konfirmasi = $this->input->post('konfirmasi_password');

        if (!password_verify($lama, $admin->password)) {
            $this->session->set_flashdata('error', 'Password lama salah');
        } elseif ($baru != $konfirmasi) {
            $this->session->set_flashdata('error', 'Konfirmasi password tidak cocok');
        } else {
            $this->Admin_model->update($id, ['password' => password_hash($baru, PASSWORD_DEFAULT)]);
            $this->session->set_flashdata('success', 'Password berhasil diubah');
        }

        redirect('admin/profile');
    }
}

?>