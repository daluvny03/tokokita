<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembeli extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('pembeli_model');
        $this->load->library('session');
    }

    public function index() {
        $data['pembeli'] = $this->pembeli_model->get_all_pembeli();
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/pembeli/index', $data);
        $this->load->view('admin/footer');
    }

    public function create() {
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/pembeli/create');
        $this->load->view('admin/footer');
    }

    public function store() {
        $data = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'no_hp' => $this->input->post('no_hp'),
            'alamat' => $this->input->post('alamat')
        ];

        if ($this->pembeli_model->insert_pembeli($data)) {
            $this->session->set_flashdata('success', 'Pembeli berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan pembeli.');
        }
        redirect('admin/pembeli');
    }

    public function edit($id) {
        $data['pembeli'] = $this->pembeli_model->get_pembeli_by_id($id);
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/pembeli/edit', $data);
        $this->load->view('admin/footer');
    }

    public function update($id) {
        $data = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'no_hp' => $this->input->post('no_hp'),
            'alamat' => $this->input->post('alamat')
        ];
        
        // Update password hanya jika diisi
        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        if ($this->pembeli_model->update_pembeli($id, $data)) {
            $this->session->set_flashdata('success', 'Pembeli berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui pembeli.');
        }
        redirect('admin/pembeli');
    }

    public function delete($id) {
        if ($this->pembeli_model->delete_pembeli($id)) {
            $this->session->set_flashdata('success', 'Pembeli berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pembeli.');
        }
        redirect('admin/pembeli');
    }
}