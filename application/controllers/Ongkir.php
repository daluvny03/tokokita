<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ongkir extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('RajaOngkir');
        $this->load->model('Pembeli_model');
        $this->load->model('Cart_model');
    }

    public function provinsi() {
    $this->rajaongkir->get_provinsi();
}

public function kota($id_provinsi) {
    $data = $this->rajaongkir->get_kota($id_provinsi);
    foreach ($data as $kota) {
        echo "<option value='{$kota['city_id']}'>{$kota['city_name']}</option>";
    }
}

public function ongkir()
    {
        $kota = $this->input->post('kota_asal'); // asal
        $kurir = $this->input->post('kurir');
        $berat = $this->input->post('berat');
        $kodepos = $this->input->post('kode_pos'); // tujuan  
        
        $ongkir = $this->rajaongkir->get_ongkir($kota, $kodepos, $kurir, $berat);
        echo $ongkir;
    }

}
