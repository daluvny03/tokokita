<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load library yang dibutuhkan
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('upload');

        // Load model
        $this->load->model('Toko_model');
        $this->load->model('admin/Produk_model');
        $this->load->model('Cart_model'); // ⬅️ Sudah di-load di sini agar bisa dipakai semua method
    }

    public function index()
    {
        // Ambil ID pembeli dari session
        $pembeli_id = $this->session->userdata('pembeli_id');

        if (!$pembeli_id) {
            redirect('auth/login');
        }

        // Siapkan data untuk view
        $data['toko'] = $this->Toko_model->get_by_pembeli($pembeli_id);
        $data['cart_count'] = $this->Cart_model->total_item_cart($pembeli_id);

        // Load view
        $this->load->view('homepage/header');
        $this->load->view('homepage/menu', $data);
        $this->load->view('toko/index', $data);
        $this->load->view('homepage/footer');
    }

    public function tambah()
    {
        // Cek login
        $pembeli_id = $this->session->userdata('pembeli_id');
        if (!$pembeli_id) {
            redirect('auth/login');
        }

        // Data cart untuk ditampilkan di navbar
        $data['cart_count'] = $this->Cart_model->total_item_cart($pembeli_id);

        // Load form tambah toko
        $this->load->view('homepage/header');
        $this->load->view('homepage/menu', $data);
        $this->load->view('toko/tambah'); // Pastikan file ini ada
        $this->load->view('homepage/footer');
    }

    public function simpan()
    {
        // Cek apakah pembeli login
        $pembeli_id = $this->session->userdata('pembeli_id');
        if (!$pembeli_id) {
            redirect('auth/login');
        }

        // Konfigurasi upload foto
        $config['upload_path']   = './uploads/toko/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048; // 2MB
        $config['encrypt_name']  = TRUE;

        $this->upload->initialize($config);

        // Lakukan upload
        if (!$this->upload->do_upload('foto_toko')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('toko/tambah');
        }

        // Jika upload berhasil
        $foto_data = $this->upload->data();
        $foto_nama = $foto_data['file_name'];

        // Simpan ke database
        $data = [
            'pembeli_id'   => $pembeli_id,
            'nama_toko'    => $this->input->post('nama_toko'),
            'deskripsi'    => $this->input->post('deskripsi'),
            'alamat_toko'  => $this->input->post('alamat_toko'),
            'alamat_toko'  => $this->input->post('kodepos'),
            'foto_toko'    => $foto_nama,
            'status'       => 'aktif',
            'created_at'   => date('Y-m-d H:i:s')
        ];

        $this->Toko_model->insert($data);

        // Redirect ke halaman toko
        redirect('toko');
    }
    public function edit($id)
    {
        // Cek login
        $pembeli_id = $this->session->userdata('pembeli_id');
        if (!$pembeli_id) {
            redirect('auth/login');
        }

        // Ambil data toko berdasarkan ID
        $toko = $this->Toko_model->get_by_id($id);

        // Pastikan toko milik pembeli yang login
        if (!$toko || $toko['pembeli_id'] != $pembeli_id) {
            show_404();
        }

        // Siapkan data cart
        $data['cart_count'] = $this->Cart_model->total_item_cart($pembeli_id);
        $data['toko'] = $toko;

        // Load view
        $this->load->view('homepage/header');
        $this->load->view('homepage/menu', $data);
        $this->load->view('toko/edit', $data); // View edit.php
        $this->load->view('homepage/footer');
    }

    // ============= METHOD UPDATE TOKO =============
    public function update()
    {
        $pembeli_id = $this->session->userdata('pembeli_id');
        if (!$pembeli_id) {
            redirect('auth/login');
        }

        $toko_id = $this->input->post('id');

        // Ambil data lama untuk cek foto
        $toko = $this->Toko_model->get_by_id($toko_id);
        if (!$toko || $toko['pembeli_id'] != $pembeli_id) {
            show_404();
        }

        // Konfigurasi upload foto jika ada file baru
        $foto_nama = $toko['foto_toko']; // Default pakai foto lama

        if ($_FILES['foto_toko']['name']) {
            $config['upload_path']   = './uploads/toko/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto_toko')) {
                // Hapus foto lama jika bukan default
                if ($foto_nama && file_exists('./uploads/toko/' . $foto_nama)) {
                    unlink('./uploads/toko/' . $foto_nama);
                }
                $foto_nama = $this->upload->data('file_name');
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('toko/edit/' . $toko_id);
            }
        }

        // Update data ke database
        $data = [
            'nama_toko'    => $this->input->post('nama_toko'),
            'deskripsi'    => $this->input->post('deskripsi'),
            'alamat_toko'  => $this->input->post('alamat_toko'),
            'foto_toko'    => $foto_nama,
        ];

        $this->Toko_model->update($toko_id, $data);
        redirect('toko');
    }

    // ============= METHOD DELETE TOKO =============
    public function hapus($id)
    {
        $pembeli_id = $this->session->userdata('pembeli_id');
        if (!$pembeli_id) {
            redirect('auth/login');
        }

        $toko = $this->Toko_model->get_by_id($id);

        if (!$toko || $toko['pembeli_id'] != $pembeli_id) {
            show_404();
        }

        // Hapus foto dari folder
        $foto = $toko['foto_toko'];
        if ($foto && file_exists('./uploads/toko/' . $foto)) {
            unlink('./uploads/toko/' . $foto);
        }

        // Hapus dari database
        $this->Toko_model->delete($id);
        redirect('toko');
    }
    public function produk($id)
    {
        $this->session->set_userdata(['id_toko' => $id]);
        $data['produk'] = $this->Produk_model->get_produk_by_idtoko($id);
        $this->load->view('homepage/header');
        $this->load->view('homepage/menu');
        $this->load->view('toko/infoproduk/index', $data);
        $this->load->view('homepage/footer');
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
                'id_toko'      => $this->session->userdata('id_toko'),
                'foto'        => $foto,
            ];

            $this->Produk_model->insert($insert);
            $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
            redirect('toko/');
        }

        $this->load->view('homepage/header');
        $this->load->view('homepage/menu');
        $this->load->view('toko/infoproduk/create', $data);
        $this->load->view('homepage/footer');
    }
    public function editproduk($id)
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
                    redirect('toko/infoproduk/edit/'.$id);
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
                'id_toko'      => $this->session->userdata('id_toko'),
            ];
    
            $this->Produk_model->update_produk($id, $data_update); // <-- pastikan method ini ada di model
            $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
            redirect('toko/');
        }
    
        $data['produk'] = $produk;
        $this->load->view('homepage/header');
        $this->load->view('homepage/menu');
        $this->load->view('toko/infoproduk/edit', $data); // <- view edit kamu harus pakai $data['kategori'] juga
        $this->load->view('homepage/footer');
    }
    public function delete($id)
    {
        $this->Produk_model->delete($id);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('toko/infoproduk/index');
    }
}