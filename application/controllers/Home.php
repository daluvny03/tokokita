<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function index()
  {
      $this->load->model('Promo_model', 'Promo_model');
      $this->load->model('admin/Produk_model', 'Produk_model');
      $this->load->model('Kategori_model');
      $this->load->model('merek_model');
      $this->load->model('Cart_model'); // <- tambahkan model Cart
  
      $data['promo'] = $this->Promo_model->get_promo_aktif();
      $data['produk'] = $this->Produk_model->get_produk_tersedia();
      $data['kategori'] = $this->Kategori_model->get_all();
      $data['merek'] = $this->merek_model->get_all_merek();
  
      // Hitung jumlah cart jika pembeli sudah login
      $pembeli_id = $this->session->userdata('pembeli_id');
      $data['cart_count'] = 0;
      if ($pembeli_id) {
          $data['cart_count'] = $this->Cart_model->total_item_cart($pembeli_id);
      }
  
      $this->load->view('homepage/header');
      $this->load->view('homepage/menu', $data); // <- kirim data cart_count ke menu
      $this->load->view('homepage/content', $data);
      $this->load->view('homepage/footer');
  }
  public function detail($id)
{
    $this->load->model('admin/Produk_model', 'Produk_model');
    $this->load->model('Cart_model');

    $data['produk'] = $this->Produk_model->get_by_id($id);

    if (!$data['produk']) {
        show_404(); // Produk tidak ditemukan
    }

    // Hitung jumlah cart jika pembeli sudah login
    $pembeli_id = $this->session->userdata('pembeli_id');
    $data['cart_count'] = 0;
    if ($pembeli_id) {
        $data['cart_count'] = $this->Cart_model->total_item_cart($pembeli_id);
    }
    $data['pertanyaan']=$this->Produk_model->getProdukIdByPertanyaan($id);
    $this->load->view('homepage/header');
    $this->load->view('homepage/menu', $data);
    $this->load->view('homepage/detail_produk', $data);
    $this->load->view('homepage/footer');
}
  

}
