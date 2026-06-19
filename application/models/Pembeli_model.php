<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembeli_model extends CI_Model
{
  public function get_all_pembeli()
  {
    return $this->db->get('pembeli')->result_array();
  }

  public function insert_pembeli($data)
  {
    return $this->db->insert('pembeli', $data);
  }

  public function get_pembeli_by_id($id)
  {
    return $this->db->get_where('pembeli', ['id' => $id])->row_array();
  }

  public function update_pembeli($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update('pembeli', $data);
  }

  public function delete_pembeli($id)
  {
    return $this->db->delete('pembeli', ['id' => $id]);
  }
  public function get_by_email($email) {
    return $this->db->get_where('pembeli', ['email' => $email])->row_array();
}



  // Tambahkan ini
  public function cek_email($email)
  {
    return $this->db->get_where('pembeli', ['email' => $email])->row_array();
  }
}

