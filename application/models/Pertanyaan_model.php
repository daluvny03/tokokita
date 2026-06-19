<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class Pertanyaan_model extends CI_Model { 
    public function getAllWithProdukAndPembeli() { 
        $this->db->select('pertanyaan_produk.*, produk.nama_produk as produk_nama, pembeli.nama as pembeli_nama');
         $this->db->from('pertanyaan_produk'); $this->db->join('produk', 'produk.id = pertanyaan_produk.produk_id'); 
         $this->db->join('pembeli', 'pembeli.id = pertanyaan_produk.pembeli_id'); 
         $this->db->order_by('pertanyaan_produk.tanggal_dibuat', 'DESC'); 
         return $this->db->get()->result();
         }
          public function getById($id) {
             $this->db->select('pertanyaan_produk.*, produk.nama_produk as produk_nama, pembeli.nama_pembeli as pembeli_nama'); 
             $this->db->from('pertanyaan_produk'); 
             $this->db->join('produk', 'produk.id = pertanyaan_produk.produk_id');
              $this->db->join('pembeli', 'pembeli.id = pertanyaan_produk.pembeli_id'); 
              $this->db->where('pertanyaan_produk.id', $id); 
              return $this->db->get()->row();
            }
             public function updateJawaban($id, $jawaban) {
                 $this->db->set('jawaban', $jawaban);
                  $this->db->where('id', $id);
                   return $this->db->update('pertanyaan_produk'); } 
                   public function delete($id) { 
                    return $this->db->delete('pertanyaan', ['id' => $id]);
                 }
                 }