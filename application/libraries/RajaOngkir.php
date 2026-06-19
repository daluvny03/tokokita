<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rajaongkir {

    protected $api_key = 'WqHZSCIqfa9a044a579eb5e46myMKYUk'; // Ganti dengan API key RajaOngkir Anda
    protected $api_url = 'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost'; // gunakan paket "starter"

    private $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function get_provinsi() {
        $curl = curl_init();
        $options = [
           CURLOPT_URL => $this->api_url,
            CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => "",
           CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION =>
            CURL_HTTP_VERSION_1_1,
           CURLOPT_HTTPHEADER => ["key: " . $this->api_key],
       ];

        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);

        $array_response = json_decode($response, true);
        return $array_response;
    }

    public function get_kota($provinsi_id) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->api_url . "city?province=" . $provinsi_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ["key: " . $this->api_key]
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response)->rajaongkir->results;
    }

    public function get_ongkir($kota_asal, $kota_tujuan, $kurir, $berat_gram) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->api_url ,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                "origin" => $kota_asal,
                "destination" => $kota_tujuan,
                "weight" => $berat_gram,
                "courier" => $kurir
            ]),
            CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded",
                "key: " . $this->api_key
            ],
        ]);
        $response = curl_exec($curl);
        return json_decode($response)->data[0]->cost;
    }
}
