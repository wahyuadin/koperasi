<?php
include(__DIR__.'/../template/config.php');
session_start();
session_destroy();
alert('Logout Berhasil !');
$script = "<script>
window.location = '".base_url()."';</script>";
echo $script;
?>