<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_model extends CI_Model {

    // Ambil semua penjualan untuk toko tertentu (group by pesanan)
    public function get_penjualan_by_toko($toko_id) {
        $this->db->select('pesanan.id, pesanan.tanggal_pesanan, pesanan.total_bayar, pesanan.status');
        $this->db->from('pesanan');
        $this->db->join('pesanan_detail', 'pesanan_detail.pesanan_id = pesanan.id');
        $this->db->join('produk', 'produk.id = pesanan_detail.produk_id');
        $this->db->where('produk.id', $toko_id);
        $this->db->group_by('pesanan.id');
        $this->db->order_by('pesanan.tanggal_pesanan', 'DESC');

        return $this->db->get()->result();
    }

    // Detail penjualan (header + detail produk yang milik toko)
    public function get_penjualan_detail($pesanan_id, $toko_id) {
        // Ambil pesanan
        $this->db->where('id', $pesanan_id);
        $pesanan = $this->db->get('pesanan')->row();
        if (!$pesanan) return false;

        // Ambil produk detail yang milik toko tersebut
        $this->db->where('pesanan_id', $pesanan_id);
        $this->db->join('produk', 'produk.id = pesanan_detail.produk_id');
        $this->db->where('produk.id', $toko_id);
        $detail = $this->db->get('pesanan_detail')->result();

        if (empty($detail)) return false; // Tidak ada produk milik toko di pesanan ini

        return ['header' => $pesanan, 'detail' => $detail];
    }
}
