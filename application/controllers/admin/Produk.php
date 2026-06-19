<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_model');
        $this->load->model('admin/Produk_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
        $this->load->library('upload');

        if (!$this->session->userdata('is_admin_logged_in')) {
            redirect('admin/auth');
        }
    }
    public function index()
    {
        $data['produk'] = $this->Produk_model->get_all();
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/produk/index', $data);
        $this->load->view('admin/footer');
    }
    public function create() {
        $data['kategori'] = $this->Produk_model->get_kategori();

        if ($this->input->post()) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = uniqid();
            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto')) {
                $fileData = $this->upload->data();
                $foto = $fileData['file_name'];
            } else {
                $foto = null;
            }
            $insert = [
                'kategori_id' => $this->input->post('kategori_id'),
                'nama_produk' => $this->input->post('nama_produk'),
                'deskripsi'   => $this->input->post('deskripsi'),
                'harga'       => $this->input->post('harga'),
                'stok'        => $this->input->post('stok'),
                'status'      => $this->input->post('status'),
                'foto'        => $foto,
            ];
            $this->Produk_model->insert($insert);
            $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
            redirect('admin/produk');
        }
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/produk/create', $data);
        $this->load->view('admin/footer');
    }
    public function kategori($id)
    {
        $this->load->model('Produk_model');
        $this->load->model('Kategori_model');
        $this->load->model('Cart_model'); // Tambahkan ini untuk load model cart
        $data['produk'] = $this->Produk_model->get_by_kategori($id);
        $kategori = $this->Kategori_model->get_by_id($id);
        $data['kategori'] = $kategori;
        // Tambahkan ini untuk hitung cart count
        $pembeli_id = $this->session->userdata('pembeli_id');
        $data['cart_count'] = 0;
        if ($pembeli_id) {
            $data['cart_count'] = $this->Cart_model->total_item_cart($pembeli_id);
        }
    
        $this->load->view('homepage/header');
        $this->load->view('homepage/menu', $data); // Kirim data ke view menu
        $this->load->view('produk/index', $data);
        $this->load->view('homepage/footer');
    }
    
    public function edit($id)
    {
        $produk = $this->Produk_model->get_by_id($id);
    
        if (!$produk) {
            show_404();
        }
    
        $data['kategori'] = $this->Produk_model->get_kategori(); // <-- Tambahkan ini
    
        if ($this->input->post()) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048;
            $this->upload->initialize($config);
    
            $foto = $produk['foto']; // tetap gunakan foto lama jika tidak diunggah baru
            if (!empty($_FILES['foto']['name'])) {
                if ($this->upload->do_upload('foto')) {
                    $upload_data = $this->upload->data();
                    $foto = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/produk/edit/'.$id);
                    return;
                }
            }
            $data_update = [
                'kategori_id' => $this->input->post('kategori_id'),
                'nama_produk' => $this->input->post('nama_produk'),
                'deskripsi'   => $this->input->post('deskripsi'),
                'harga'       => $this->input->post('harga'),
                'stok'        => $this->input->post('stok'),
                'foto'        => $foto,
                'status'      => $this->input->post('status'),
            ];
    
            $this->Produk_model->update_produk($id, $data_update); // <-- pastikan method ini ada di model
            $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
            redirect('admin/produk');
        }
    
        $data['produk'] = $produk;
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/produk/edit', $data); // <- view edit kamu harus pakai $data['kategori'] juga
        $this->load->view('admin/footer');
    }
    
    public function tanya()
{
    if (!$this->session->userdata('pembeli_id')) {
        redirect('login');
    }

    $data = [
        'produk_id' => $this->input->post('produk_id'),
        'pembeli_id' => $this->session->userdata('pembeli_id'),
        'isi_pertanyaan' => $this->input->post('isi_pertanyaan'),
        'tanggal_dibuat' => date('Y-m-d H:i:s')
    ];

    $this->db->insert('pertanyaan_produk', $data);
    $this->session->set_flashdata('pesan', 'Pertanyaan Anda telah dikirim.');
    redirect('home/detail/' . $data['produk_id']);
}

public function jawab($id_pertanyaan)
{
// Pastikan user sudah login dan merupakan penjual
if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'penjual') {
redirect('login');
}
$jawaban = $this->input->post('jawaban', true);
$jawaban_at = date('Y-m-d H:i:s');

$this->load->model('Produk_model');
$this->Produk_model->jawabPertanyaan($id_pertanyaan, $jawaban, $jawaban_at);

// Opsional: set flashdata notifikasi
$this->session->set_flashdata('success', 'Jawaban berhasil dikirim.');

// Redirect kembali ke halaman detail produk
$produk_id = $this->Produk_model->getProdukIdByPertanyaan($id_pertanyaan);
redirect('produk/detail/' . $produk_id);
}

    public function delete($id)
    {
        $this->Produk_model->delete($id);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('admin/produk');
    }
}
