<?php
// Wajib menyertakan file koneksi agar fungsi-fungsi ini bisa terhubung ke database
require 'koneksi.php';

// =========================================================================
// R: FUNGSI READ (Membaca semua data)
// =========================================================================
/**
 * Mengambil semua data dari tabel barang.
 * @return array Array berisi semua data barang
 */
function ambil_data_barang() {
    global $koneksi; // Mengakses variabel koneksi dari luar fungsi

    // Query untuk mengambil semua data, diurutkan berdasarkan ID terbaru
    $query = "SELECT * FROM barang ORDER BY id DESC";
    $result = $koneksi->query($query);

    $barang = [];
    if ($result->num_rows > 0) {
        // Ambil setiap baris data dan masukkan ke array $barang
        while ($row = $result->fetch_assoc()) {
            $barang[] = $row;
        }
    }
    return $barang;
}

// =========================================================================
// R: FUNGSI READ (Mengambil 1 data untuk Edit)
// =========================================================================
/**
 * Mengambil satu data barang berdasarkan ID.
 * @param int $id ID barang
 * @return array/null Data barang atau null jika tidak ditemukan
 */
function ambil_data_by_id($id) {
    global $koneksi;
    // Bersihkan input ID untuk keamanan (mencegah SQL Injection)
    $id = $koneksi->real_escape_string($id);

    $query = "SELECT * FROM barang WHERE id = '$id'";
    $result = $koneksi->query($query);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    }
    return null;
}

// =========================================================================
// C: FUNGSI CREATE (Menambah data baru)
// =========================================================================
/**
 * Menambahkan data barang baru ke database.
 * @param array $data Data dari form ($_POST)
 * @return bool True jika berhasil, False jika gagal
 */
function tambah_barang($data) {
    global $koneksi;

    // Ambil dan bersihkan data dari array $data (form POST)
    $nama = $koneksi->real_escape_string($data['nama']);
    $harga = $koneksi->real_escape_string($data['harga']);
    $stok = $koneksi->real_escape_string($data['stok']);
    $deskripsi = $koneksi->real_escape_string($data['deskripsi']);

    $query = "INSERT INTO barang (nama_barang, harga, stok, deskripsi) VALUES ('$nama', '$harga', '$stok', '$deskripsi')";

    if ($koneksi->query($query) === TRUE) {
        return true;
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
        return false;
    }
}

// =========================================================================
// U: FUNGSI UPDATE (Mengubah data)
// =========================================================================
/**
 * Memperbarui data barang yang sudah ada.
 * @param array $data Data dari form ($_POST)
 * @return bool True jika berhasil, False jika gagal
 */
function update_barang($data) {
    global $koneksi;

    // Ambil dan bersihkan data
    $id = $koneksi->real_escape_string($data['id']);
    $nama = $koneksi->real_escape_string($data['nama']);
    $harga = $koneksi->real_escape_string($data['harga']);
    $stok = $koneksi->real_escape_string($data['stok']);
    $deskripsi = $koneksi->real_escape_string($data['deskripsi']);

    $query = "UPDATE barang SET 
                nama_barang = '$nama', 
                harga = '$harga', 
                stok = '$stok', 
                deskripsi = '$deskripsi'
              WHERE id = '$id'";

    if ($koneksi->query($query) === TRUE) {
        return true;
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
        return false;
    }
}

// =========================================================================
// D: FUNGSI DELETE (Menghapus data)
// =========================================================================
/**
 * Menghapus data barang.
 * @param int $id ID barang
 * @return bool True jika berhasil, False jika gagal
 */
function hapus_barang($id) {
    global $koneksi;
    $id = $koneksi->real_escape_string($id);

    $query = "DELETE FROM barang WHERE id = '$id'";

    if ($koneksi->query($query) === TRUE) {
        return true;
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
        return false;
    }
}
?>