<?php 
include(__DIR__.'/../Controller/LoginController.php');

alert('Halaman Isi Proses Pengerjaan');
$script = "<script>
window.location = '".base_url()."';</script>";
echo $script;

?>