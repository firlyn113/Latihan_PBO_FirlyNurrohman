<?php 

$host = 'localhost';
$user = 'root';
$password = '';
$name = 'db_latihan_pbo_trpl1b_firlynurrohman';

$conn = new mysqli($host,$user,$password,$name);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set charset ke UTF-8
$conn->set_charset("utf8mb4");

?>