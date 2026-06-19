<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merek extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('merek_model');
        $this->load->library('upload');
        $this->load->helper(['url', 'form']);
        $this->load->library('session'); // Load library session untuk flashdata
    }

    public function index() {
        $data['merek'] = $this->merek_model->get_all_merek();
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/merek/index', $data);
        $this->load->view('admin/footer');
    }

    public function create() {
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/merek/create');
        $this->load->view('admin/footer');
        
    }

    public function store() {
        if ($this->input->post()) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = uniqid();
            $this->upload->initialize($config);

            if ($this->upload->do_upload('logo')) {
                $fileData = $this->upload->data();
                $foto = $fileData['file_name'];
            } else {
                $logo = null;
            }

            $insert = [
                'id' => $this->input->post('id'),
                'nama_merek' => $this->input->post('nama_merek'),
                'logo'        => $foto,
            ];

        if ($this->merek_model->insert_merek($insert)) {
            $this->session->set_flashdata('success', 'merek berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan merek.');
        }
        redirect('admin/merek');
    }
}

    public function edit($id) {
        $data['merek'] = $this->merek_model->get_merek_by_id($id);
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/merek/edit', $data);
        $this->load->view('admin/footer');
    }

    public function update($id) {
        $merek = $this->merek_model->get_merek_by_id($id);
        if ($this->input->post()) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048;
            $this->upload->initialize($config);
    
            $logo = $merek['logo']; // tetap gunakan foto lama jika tidak diunggah baru
            if (!empty($_FILES['logo']['name'])) {
                if ($this->upload->do_upload('logo')) {
                    $upload_data = $this->upload->data();
                    $logo = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/merek/edit/'.$id);
                    return;
                }
            }
    
            $data_update = [
                'id' => $id,
                'nama_merek' => $this->input->post('nama_merek'),
                'logo'        => $logo,            
            ];
    
            $this->merek_model->update_merek($id, $data_update); // <-- pastikan method ini ada di model
        if ($this->merek_model->update_merek($id, $data_update)) {
            $this->session->set_flashdata('success', 'merek berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui merek.');
        }
        redirect('admin/merek');
    }
}

    public function delete($id) {
        if ($this->merek_model->delete_merek($id)) {
            $this->session->set_flashdata('success', 'merek berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus merek.');
        }
        redirect('admin/merek');
    }
}
