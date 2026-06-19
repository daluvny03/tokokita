<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pesanan_model');
        // Pastikan pembeli sudah login
        if (!$this->session->userdata('pembeli_id')) {
            redirect('login');
        }
    }

    public function index() {
        $pembeli_id = $this->session->userdata('pembeli_id');
        $data['pesanan'] = $this->Pesanan_model->get_pesanan_by_pembeli($pembeli_id);

        $this->load->view('homepage/header');
        $this->load->view('homepage/menu');
        $this->load->view('history/index', $data);
        $this->load->view('homepage/footer');
    }

    public function detail($id) {
        $pembeli_id = $this->session->userdata('pembeli_id');
        $data['pesanan'] = $this->Pesanan_model->get_pesanan_detail($id, $pembeli_id);

        if (!$data['pesanan']) {
            show_404();
        }

        $this->load->view('homepage/header');
        $this->load->view('homepage/menu');
        $this->load->view('history/history_detail', $data);
        $this->load->view('homepage/footer');
    }
}
