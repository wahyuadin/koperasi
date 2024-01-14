<?php
session_start();
if (!isset($_SESSION['users'])) {
    return header("location: auth/login.php");
} elseif (!isset($_SESSION['nasabah'])) {
    return header("location: auth/login.php");
}
?>