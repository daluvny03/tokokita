<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    public function get_all() {
        return $this->db->select('produk.*, kategori.nama_kategori')
                        ->from('produk')
                        ->join('kategori', 'produk.kategori_id = kategori.id')
                        ->get()->result_array();
    }

    public function insert($data) {
        return $this->db->insert('produk', $data);
    }

    // Ambil data produk berdasarkan ID
    public function get_by_id($id) {
        return $this->db->get_where('produk', ['id' => $id])->row_array();
    }

    public function update($id, $data) {
        return $this->db->update('produk', $data, ['id' => $id]);
    }

    public function delete($id) {
        return $this->db->delete('produk', ['id' => $id]);
    }

    public function get_kategori() {
        return $this->db->get('kategori')->result_array();
    }
    public function get_produk_by_idtoko($id) {
        return $this->db->get_where('produk', ['id_toko' => $id])->result_array();
    }
    public function get_by_kategori($kategori_id)
{
    return $this->db->get_where('produk', ['kategori_id' => $kategori_id])->result_array();
}

    public function update_produk($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('produk', $data);
    }
    public function get_produk_tersedia()
{
    $this->db->select('*');
    $this->db->from('produk');
    $this->db->where('status', 'tersedia');
    return $this->db->get()->result_array();
}
public function jawabPertanyaan($id_pertanyaan, $jawaban, $jawaban_at)
{
$this->db->where('id', $id_pertanyaan);
$this->db->update('pertanyaan', [
'jawaban' => $jawaban,
'jawaban_at' => $jawaban_at
]);
}

public function getProdukIdByPertanyaan($produk_id)
{

$this->db->select('pertanyaan_produk.*, produk.nama_produk as produk_nama, pembeli.nama_pembeli as pembeli_nama');
         $this->db->join('produk', 'produk.id = pertanyaan_produk.produk_id'); 
         $this->db->join('pembeli', 'pembeli.id = pertanyaan_produk.pembeli_id'); 
         return $this->db->get_where('pertanyaan_produk', ['produk_id' => $produk_id])->result();

}
    
    
}
