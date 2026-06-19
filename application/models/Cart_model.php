<?php
class Cart_model extends CI_Model {

    public function tambah_ke_cart($pembeli_id, $produk_id) {
        $cek = $this->db->get_where('cart', ['pembeli_id' => $pembeli_id, 'produk_id' => $produk_id])->row();

        if ($cek) {
            $this->db->where('id', $cek->id);
            $this->db->update('cart', ['jumlah' => $cek->jumlah + 1]);
        } else {
            $this->db->insert('cart', [
                'pembeli_id' => $pembeli_id,
                'produk_id'  => $produk_id,
                'jumlah'     => 1
            ]);
        }
    }

    public function get_cart($pembeli_id) {
        return $this->db->select('cart.*, produk.nama_produk, produk.harga, produk.foto')
            ->from('cart')
            ->join('produk', 'produk.id = cart.produk_id')
            ->where('cart.pembeli_id', $pembeli_id)
            ->get()->result_array();
    }

    public function total_item_cart($pembeli_id) {
        return $this->db->where('pembeli_id', $pembeli_id)->count_all_results('cart');
    }
}
