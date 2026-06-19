<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/Midtrans/Config.php');
require_once(APPPATH . 'libraries/Midtrans/Snap.php');

class Midtrans {
    public function __construct() {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-D6Wo45LjY2K7qFjuWyWOsDhT';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    public function snap() {
        return new \Midtrans\Snap;
    }
}

/** 
 * Check PHP version.
 */
if (version_compare(PHP_VERSION, '5.4', '<')) {
    throw new Exception('PHP version >= 5.4 required');
}

// Check PHP Curl & json decode capabilities.
if (!function_exists('curl_init') || !function_exists('curl_exec')) {
    throw new Exception('Midtrans needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
    throw new Exception('Midtrans needs the JSON PHP extension.');
}

// Configurations
require_once 'Midtrans/Config.php';

// Midtrans API Resources
require_once 'Midtrans/Transaction.php';

// Plumbing
require_once 'Midtrans/ApiRequestor.php';
require_once 'Midtrans/Notification.php';
require_once 'Midtrans/CoreApi.php';
require_once 'Midtrans/Snap.php';
require_once 'SnapBi/SnapBi.php';
require_once 'SnapBi/SnapBiApiRequestor.php';
require_once 'SnapBi/SnapBiConfig.php';

// Sanitization
require_once 'Midtrans/Sanitizer.php';
