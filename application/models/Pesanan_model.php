<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_model extends CI_Model {

    // Simpan data pesanan utama dan detail produk
    public function insert($pesanan, $cart_items) 
     { 
        // Simpan ke tabel pesanan
        $this->db->insert('pesanan', $pesanan); 
        $id_pesanan = $this->db->insert_id(); 
        
        // Simpan ke tabel detail_pesanan 
        foreach ($cart_items as $item) { 
            $detail = [ 
                'pesanan_id' => $id_pesanan, 
                'produk_id' => $item['id'], 
                'nama_produk' => $item['name'], 
                'jumlah' => $item['qty'], 
                'harga' => $item['price'], 
                // 'subtotal' => $item['subtotal'], 
            ]; 
            $this->db->insert('pesanan_detail', $detail); 
            } 
            return $id_pesanan; 
     } 

    // Ambil data pesanan berdasarkan ID
    public function get_pesanan($id_pesanan) {
        $this->db->where('id_pesanan', $id_pesanan);
        return $this->db->get('pesanan')->row();
    }
    public function get_pesanan_by_pembeli($pembeli_id) {
        return $this->db->where('id_pembeli', $pembeli_id)
                        ->order_by('tanggal_pesanan', 'DESC')
                        ->get('pesanan')
                        ->result();
    }

    // Ambil detail pesanan (header dan detail produk)
    public function get_pesanan_detail($id, $pembeli_id) {
        $this->db->where('id', $id);
        $this->db->where('id', $pembeli_id);
        $pesanan = $this->db->get('pesanan')->row();

        if (!$pesanan) return false;

        $this->db->where('pesanan_id', $id);
        $this->db->join('produk', 'produk.id = pesanan_detail.produk_id');
        $detail = $this->db->get('pesanan_detail')->result();

        return ['header' => $pesanan, 'detail' => $detail];
    }

    // Ambil detail item dari suatu pesanan
    public function get_detail_pesanan($id_pesanan) {
        $this->db->where('id_pesanan', $id_pesanan);
        return $this->db->get('detail_pesanan')->result();
    }

    // Update status pembayaran (callback dari Midtrans)
    public function update_status($id_pesanan, $status) {
        $this->db->where('id_pesanan', $id_pesanan);
        $this->db->update('pesanan', ['status' => $status]);
    }
}
