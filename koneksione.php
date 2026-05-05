<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "dream_escapeone"; // Sesuai gambar phpMyAdmin Anda

$connone = mysqli_connect($host, $user, $pass, $db);

if (!$connone) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>