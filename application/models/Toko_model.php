<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko_model extends CI_Model
{
    public function update($id, $data)
{
    $this->db->where('id_toko', $id);
    return $this->db->update('toko', $data);
}
    public function get_by_id($id)
{
    return $this->db->get_where('toko', ['id_toko' => $id])->row_array();
}
    public function get_by_kodepos($id)
{
    return $this->db->get_where('toko', ['id_toko' => $id])->row_array();
}
    public function insert($data)
    {
        return $this->db->insert('toko', $data);
    }

    public function get_by_pembeli($pembeli_id)
    {
        return $this->db->get_where('toko', ['pembeli_id' => $pembeli_id])->result_array();
    }

    public function delete($id)
{
    $this->db->delete('toko', ['id' => $id]);
}
}