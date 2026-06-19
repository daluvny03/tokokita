<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class PertanyaanAdmin extends CI_Controller { 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pertanyaan_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
        $this->load->library('upload');

        if (!$this->session->userdata('is_admin_logged_in')) {
            redirect('admin/pertanyaan');
        }
    } 
public function index() { 
    $data['pertanyaan'] = $this->Pertanyaan_model->getAllWithProdukAndPembeli(); 
    $this->load->view('admin/header');
    $this->load->view('admin/menu');
    $this->load->view('admin/pertanyaan/index', $data);

    $this->load->view('admin/footer');
} 
public function detail($id) { 
    $this->load->view('admin/header');
    $this->load->view('admin/menu');
    $this->load->view('admin/footer');

    $data['pertanyaan'] = $this->Pertanyaan_model->getById($id); 
    if (!$data['pertanyaan']) { show_404(); } 
    $this->load->view('admin/pertanyaan/detail', $data); 
}
     public function jawab() {
         $id = $this->input->post('id'); 
         $jawaban = $this->input->post('jawaban');
          $this->Pertanyaan_model->updateJawaban($id, $jawaban);
           $this->session->set_flashdata('success', 'Jawaban berhasil disimpan.');
            redirect('admin/PertanyaanAdmin');
         }
          public function delete($id) {
             $this->Pertanyaan_model->delete($id);
             $this->session->set_flashdata('success', 'Pertanyaan berhasil dihapus.'); 
             redirect('admin/PertanyaanAdmin'); } } 