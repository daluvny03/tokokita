<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthHook {
    public function check_login() {
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->load->helper('url');

        $current_class = strtolower($CI->router->fetch_class());
        $current_method = strtolower($CI->router->fetch_method());

        $current_route = $current_class . '/' . $current_method;

        // Cek apakah controller berada dalam folder admin
        $directory = $CI->router->directory ?? ''; // fallback ke string kosong
        $is_admin_area = strpos(strtolower($directory), 'admin') !== false;
        
        // Jalankan pengecekan hanya untuk area admin
        if ($is_admin_area) {
            $excluded_routes = [
                'auth/index',
                'auth/login',
                'auth/logout',
            ];

            if (!in_array($current_route, $excluded_routes)) {
                if (!$CI->session->userdata('is_admin_logged_in')) {
                    redirect('admin/auth');
                }
            }
        }
    }
}
