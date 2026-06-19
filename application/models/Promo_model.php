<?php
class Promo_model extends CI_Model
{
  public function get_all()
  {
    return $this->db->get('promo')->result();
  }

  public function get_by_id($id)
  {
    return $this->db->get_where('promo', ['id_promo' => $id])->row();
  }

  public function insert($data)
  {
    return $this->db->insert('promo', $data);
  }
  public function get_promo_aktif()
  {
    return $this->db->where('status', 'aktif')->get('promo')->result();
  }


  public function update($id, $data)
  {
    return $this->db->where('id_promo', $id)->update('promo', $data);
  }

  public function delete($id)
  {
    return $this->db->delete('promo', ['id_promo' => $id]);
  }

  public function get_all_promo($limit, $start, $status = null)
  {
    if ($status) {
      $this->db->where('status', $status);
    }
    return $this->db->get('promo', $limit, $start)->result();
  }

  public function count_promo($status = null)
  {
    if ($status) {
      $this->db->where('status', $status);
    }
    return $this->db->count_all_results('promo');
  }
}
