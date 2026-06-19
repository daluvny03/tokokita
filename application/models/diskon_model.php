<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class diskon_model extends CI_Model {
    
    public function get_all()
    {
        return $this->db->get('diskon')->result();
    }

    public function get($id)
    {
        return $this->db->get_where('diskon', ['id' => $id])->row();
    }
    public function insert($data)
    {
        return $this->db->insert('diskon', $data);
    }

    public function update($id, $data)
    {
        return $this->db->update('diskon', $data, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete('diskon', ['id' => $id]);
    }

    public function hitung_diskon($produk_id, $harga_awal)
    {
        $tanggal = date('Y-m-d');
        $this->db->where('mulai <=', $tanggal);
        $this->db->where('selesai >=', $tanggal);
        $this->db->group_start();
        $this->db->where('produk_id', $produk_id);
        $this->db->or_where('produk_id IS NULL');
        $this->db->group_end();
        $diskon = $this->db->get('diskon')->row();

        if ($diskon) {
            if ($diskon->tipe == 'persen') {
                return $harga_awal - ($harga_awal * $diskon->nilai / 100);
            } else {
                return max(0, $harga_awal - $diskon->nilai);
            }
        }
        return $harga_awal;
    }
}
