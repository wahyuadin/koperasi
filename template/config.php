<?php

define('BASE_URL', 'http://localhost/koperasi/');
function base_url($uri = ''){
  return BASE_URL . $uri;
}

function set_flash_data($key, $value) {
  $_SESSION['flash_data'][$key] = $value;
}

function get_flash_data($key) {
  if (isset($_SESSION['flash_data'][$key])) {
      $value = $_SESSION['flash_data'][$key];
      unset($_SESSION['flash_data'][$key]);
      return $value;
  } else {
      return null;
  }

}

function alert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

?>