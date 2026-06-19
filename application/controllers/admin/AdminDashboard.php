<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load session library
        $this->load->library('session');
        $this->load->helper('url');
        
        // Pastikan hanya admin yang bisa mengakses
        if (!$this->session->userdata('is_admin_logged_in')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('admin/auth'); // Redirect ke halaman login jika belum login
            exit;
        }
    }

    public function index() {
        // Periksa kembali session untuk mencegah akses setelah logout
        if (!$this->session->userdata('is_admin_logged_in')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('admin/auth');
            exit;
        }
        
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/footer');
    }

    
}