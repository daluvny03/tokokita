<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Penjualan_model');
        // Pastikan penjual sudah login dan punya toko
        if (!$this->session->userdata('pembeli_id')) {
            redirect('login');
        }
    }

    public function index($id) {
        $toko_id = $id;
        $data['penjualan'] = $this->Penjualan_model->get_penjualan_by_toko($toko_id);

        $this->load->view('homepage/header');
        $this->load->view('penjualan/index', $data);
        $this->load->view('homepage/footer');
    }

    public function detail($pesanan_id) {
        $toko_id = 4;
        $data['penjualan'] = $this->Penjualan_model->get_penjualan_detail($pesanan_id, $toko_id);

        if (!$data['penjualan']) {
            show_404();
        }

        $this->load->view('homepage/header');
        $this->load->view('penjualan/detail', $data);
        $this->load->view('homepage/footer');
    }
}
