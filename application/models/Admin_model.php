<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    
    public function check_admin($email, $password) {
        $this->db->where('email', $email);
        $admin = $this->db->get('admin')->row();

        if ($admin && password_verify($password, $admin->password)) {
            return $admin;
        } else {
            return false;
        }
    }
    public function get_by_id($id) {
        return $this->db->get_where('admin', ['id' => $id])->row();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('admin', $data);
    }
}
?>
