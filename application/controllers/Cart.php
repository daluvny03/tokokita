<?php
class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Produk_model');
        $this->load->library('cart'); // load CI_Cart
    }

    public function index()
    {
        $data['keranjang'] = $this->cart->contents(); // ambil semua item
        $this->load->view('homepage/header');
        $this->load->view('homepage/menu');
        $this->load->view('cart/index', $data);
        $this->load->view('homepage/footer');
    }

    public function add($id_produk)
    {
        $items = $this->cart->contents();
        $jml=count($items);

        if($jml==0){
            $id_toko_cart=0;
            $produk = $this->Produk_model->get_by_id($id_produk);
            var_dump($produk);
            // echo $id_toko_cart;
            // die;
            if($produk){
                $data = array(
                'id'      => $produk['id'],
                'qty'     => 1,
                'price'   => $produk['harga'],
                'name'    => $produk['nama_produk'],
                'options' => array('foto' => $produk['foto'],
                                   'id_toko'  => $produk->id_toko)
                );
                $this->cart->insert($data); // simpan ke keranjang
                                return redirect('cart');

            }} else {
            foreach($this->cart->contents() as $items){
            $id_toko_cart = $items['options']['id_toko'];
            ///

            $produk = $this->Produk_model->get_by_id($id_produk);
            $id_toko = $produk->id_toko;

            if($id_toko_cart != $id_toko){
               // echo "toko yg sama";
              //  Toko tidak sama, tolak
                $this->session->set_flashdata('error', 'Anda hanya bisa membeli dari satu toko dalam satu waktu.');
                return redirect('cart');
            } else {
                 $data = array(
                'id'      => $produk['id'],
                'qty'     => 1,
                'price'   => $produk['harga'],
                'name'    => $produk['nama_produk'],
                'options' => array('foto' => $produk['foto'],
                                   'id_toko'  => $produk->id_toko)
                );
                $this->cart->insert($data); // simpan ke keranjang
                redirect('cart');
                            

            }
            }
        }            
    }


    public function updateold()
    {
        $data = [
            'rowid' => $this->input->post('rowid'),
            'qty'   => $this->input->post('qty')
        ];
        $this->cart->update($data);
        redirect('cart');
    }

    public function update()
    {
        $rowid = $this->input->post('rowid');
        $qty = (int) $this->input->post('qty');
        $action = $this->input->post('action');

        if ($action === 'plus') {
            $qty += 1;
        } elseif ($action === 'minus') {
            $qty = max(1, $qty - 1); // Jangan kurang dari 1
        }

        $data = [
            'rowid' => $rowid,
            'qty'   => $qty
        ];
        $this->cart->update($data);
        redirect('cart');
    }

    public function hapus($rowid)
    {
        $this->cart->remove($rowid);
        redirect('cart');
    }
}
