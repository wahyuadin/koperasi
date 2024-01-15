<?php
session_start();
$judul = 'Bunga';
include(__DIR__.'/../template/header.php');
if (!isset($_SESSION['users'])) {
	return header('location:'.base_url());
}
include(__DIR__.'/../template/navbar_header.php');
include(__DIR__.'/../template/sitebar.php');


include(__DIR__.'/../Controller/RiwayatController.php');
?>

<?php include(__DIR__.'/../template/footer.php'); ?>