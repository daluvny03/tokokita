<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class diskon extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('diskon_model');
        $this->load->library('session'); // Load library session untuk flashdata
    }

    public function index() {
        $data['diskon'] = $this->diskon_model->get_all();
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/diskon/index', $data);
        $this->load->view('admin/footer');
    }

    public function create()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/diskon/create');
        $this->load->view('admin/footer');
        
    }

    public function save()
    {
        $this->diskon_model->insert($this->input->post());
        redirect('admin/diskon');
    }

    public function edit($id)
    {
        $data['diskon'] = $this->diskon_model->get($id);
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/diskon/edit', $data);
        $this->load->view('admin/footer');
    }

    public function update($id)
    {
        $this->Diskon_model->update($id, $this->input->post());
        redirect('admin/diskon');
    }

    public function delete($id)
    {
        $this->Diskon_model->delete($id);
        redirect('admin/diskon');
    }
}
