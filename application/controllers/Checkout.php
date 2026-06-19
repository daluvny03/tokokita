<?php
class Checkout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Cart_model', 'Pesanan_model','Pembeli_model','Toko_model']);
        $this->load->library('Midtrans');
        $this->load->library(['rajaongkir','cart']); // library custom untuk API RajaOngkir  
        
        $this->api_key=$this->config->item('rajaongkir_api_key');
        $this->base_url=$this->config->item('rajaongkir_base_url');

        $this->load->helper('url');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $krnjg = $this->cart->contents();
        if (empty($krnjg)) {
            $this->session->set_flashdata('error', 'Keranjang belanja masih kosong.');
            redirect('Cart'); // arahkan ke halaman produk atau keranjang
        }

        $idpembeli = $this->session->userdata('pembeli_id');


        foreach ($krnjg as $item) {
            $id_toko_cart = $item['id'];
            break;
        }
        $this->load->model('diskon_model');
        $diskon_aktif = $this->diskon_model->get_all();
        $data['diskon_aktif'] = $diskon_aktif;
        $data['kode_pos'] = $this->Toko_model->get_by_kodepos($id_toko_cart);

        $data['cart'] = $this->cart->contents();
        $data['pembeli'] = $this->Pembeli_model->get_pembeli_by_id($idpembeli);
        $this->load->view('homepage/header.php');
        $this->load->view('homepage/menu.php');
        $this->load->view('Checkout/index.php', $data);
        $this->load->view('homepage/footer');
    }

    public function proses()
    {
        
        $post = $this->input->post();
        $cart_items = $this->cart->contents();
        if (empty($cart_items)) {
            redirect('cart');
        }

        $total_harga = $this->cart->total();
        $ongkir = (int) $post['ongkir'];
        $diskon =  $post['diskon'];
        $grand_total = ($total_harga + $ongkir)-$diskon;

        // Simpan ke database 
        $pesanan = [
            'id_pembeli' => $this->session->userdata('pembeli_id'),
            'nama' => $post['nama'],
            'alamat' => $post['alamat'],
            'no_hp' => $post['no_hp'],
            'kurir' => $post['kurir'],
            'ongkir' => $ongkir,
            'total_bayar' => $grand_total,
            'status' => 'pending',
            'tanggal_pesanan' => date('Y-m-d H:i:s')
        ];
        $id_pesanan = $this->Pesanan_model->insert($pesanan, $cart_items);

        // Midtrans Snap 
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => 'INV-' . $id_pesanan,
                'gross_amount' => $grand_total
            ],
            'customer_details' => [
                'first_name' => $post['nama'],
                'email' => $this->session->userdata('email'),
                'phone' => $post['no_hp']
            ]
        ];

        // Ketika dipanggil, ini akan menghasilkan token
    $snapToken = \Midtrans\Snap::getSnapToken($midtrans_params);
        
        $data['snapToken'] = $snapToken;
        $data['order_id'] = 'INV-' . time();

        $this->load->view('checkout_pembayaran', $data);
    }
    public function cek_ongkir()
    {
        $kota_asal = $this->input->post('kota_asal');
        $kota_tujuan = $this->input->post('kota_tujuan');
        $berat = $this->input->post('berat');
        $kurir = $this->input->post('kurir');

        $ongkir = $this->rajaongkir->get_ongkir($kota_asal, $kota_tujuan, $berat, $kurir);
        echo $ongkir;
    }
public function bayar()
{
    $order_id = "INV-" . time();
    $data['order_id'] = $order_id;
    $this->load->view('checkout/sukses', $data);
}
public function simpan_pesanan($order_id)
{
    // Ambil data dari session atau input
    $id_pembeli = $this->session->userdata('id_pembeli');
    $total = $this->input->post('total');
    $ongkir = $this->input->post('ongkir');
    $kurir = $this->input->post('kurir');
    $layanan = $this->input->post('layanan');
    $provinsi = $this->input->post('provinsi');
    $kota = $this->input->post('kota');
    $alamat = $this->input->post('alamat');
    $kode_pos = $this->input->post('kode_pos');

    $data_pesanan = [
        'id_pembeli' => $id_pembeli,
        'order_id' => $order_id,
        'total' => $total,
        'ongkir' => $ongkir,
        'kurir' => $kurir,
        'layanan' => $layanan,
        'provinsi' => $provinsi,
        'kota' => $kota,
        'alamat' => $alamat,
        'kode_pos' => $kode_pos,
        'status_pembayaran' => 'pending'
    ];

    $this->db->insert('pesanan', $data_pesanan);
    $id_pesanan = $this->db->insert_id();

    // Simpan detail pesanan dari cart
    foreach ($this->cart->contents() as $item) {
        $data_detail = [
            'id_pesanan' => $id_pesanan,
            'id_produk' => $item['id'],
            'jumlah' => $item['qty'],
            'harga' => $item['price']
        ];
        $this->db->insert('pesanan_detail', $data_detail);
    }

    // Kosongkan keranjang
    $this->cart->destroy();

    // Redirect ke halaman sukses
    redirect('checkout/sukses/' . $order_id);
}
public function proses_checkout()
{
    $this->load->library('cart');
    $this->load->helper('string');
    $this->load->library('rajaongkir');

    $id_pembeli = $this->session->userdata('id_pembeli');
    $order_id = 'INV-' . date('YmdHis') . '-' . random_string('alnum', 5);
    $total = $this->input->post('total'); // sudah termasuk ongkir
    $ongkir = $this->input->post('ongkir');
    $kurir = $this->input->post('kurir');
    $layanan = $this->input->post('layanan');
    $provinsi = $this->input->post('provinsi');
    $kota = $this->input->post('kota');
    $alamat = $this->input->post('alamat');
    $kode_pos = $this->input->post('kode_pos');

    // Simpan ke tabel pesanan
    $data_pesanan = [
        'id_pembeli' => $id_pembeli,
        'order_id' => $order_id,
        'total' => $total,
        'ongkir' => $ongkir,
        'kurir' => $kurir,
        'layanan' => $layanan,
        'provinsi' => $provinsi,
        'kota' => $kota,
        'alamat' => $alamat,
        'kode_pos' => $kode_pos,
        'status_pembayaran' => 'pending'
    ];
    $this->db->insert('pesanan', $data_pesanan);
    $id_pesanan = $this->db->insert_id();

    // Simpan detail pesanan
    foreach ($this->cart->contents() as $item) {
        $data_detail = [
            'id_pesanan' => $id_pesanan,
            'id_produk' => $item['id'],
            'jumlah' => $item['qty'],
            'harga' => $item['price']
        ];
        $this->db->insert('pesanan_detail', $data_detail);
    }

    // Konfigurasi Midtrans Snap
    require_once APPPATH . 'libraries/Midtrans.php';
    \Midtrans\Config::$serverKey = getenv('MIDTRANS_SERVER_KEY');
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    // Data transaksi untuk Snap
    $param = [
        'transaction_details' => [
            'order_id' => $order_id,
            'gross_amount' => $total
        ],
        'customer_details' => [
            'first_name' => $this->session->userdata('nama'),
            'email' => $this->session->userdata('email')
        ]
    ];

    $snapToken = \Midtrans\Snap::getSnapToken($param);

    // Simpan token jika mau (opsional)
    $this->db->where('id', $id_pesanan);
    $this->db->update('pesanan', ['snap_token' => $snapToken]);

    // Tampilkan halaman bayar
    $data['snap_token'] = $snapToken;
    $data['order_id'] = $order_id;
    $this->cart->destroy(); // kosongkan keranjang
    $this->load->view('checkout/bayar', $data);
}
public function get_diskon()
{
    $id = $this->input->post('diskon_id');
    $this->load->model('diskon_model');
    $diskon = $this->Diskon_model->get($id);
    echo json_encode($diskon);
}




}
