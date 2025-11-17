<?php
// Pengaturan parameter koneksi
$host = "localhost";
$user = "root"; // Sesuaikan dengan username MySQL Anda (default XAMPP/MAMP)
$pass = "";     // Sesuaikan dengan password MySQL Anda (default XAMPP/MAMP kosong)
$db_name = "db_toko"; // Nama database yang telah dibuat

// Buat objek koneksi menggunakan MySQLi Object-Oriented
$koneksi = new mysqli($host, $user, $pass, $db_name);

// Cek apakah koneksi berhasil atau gagal
if ($koneksi->connect_error) {
    // Jika gagal, hentikan eksekusi dan tampilkan pesan error
    die("Koneksi Database Gagal: " . $koneksi->connect_error);
}

// Catatan: Variabel $koneksi akan digunakan di semua file lain
?>