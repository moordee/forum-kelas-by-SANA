<?php
// =========================================================================
// BAGIAN 1: KONFIGURASI DAN KONEKSI DATABASE
// =========================================================================
$host = "localhost";
$user = "root"; 
$pass = "";     
$db_name = "db_toko"; // Pastikan database ini sudah dibuat

$koneksi = new mysqli($host, $user, $pass, $db_name);

if ($koneksi->connect_error) {
    die("Koneksi Database Gagal: " . $koneksi->connect_error);
}

// =========================================================================
// BAGIAN 2: FUNGSI-FUNGSI CRUD (Logika)
// Di PHP Native, fungsi didefinisikan di awal sebelum digunakan
// =========================================================================

// --- R: READ (Mengambil semua data) ---
function ambil_data_barang() {
    global $koneksi; 
    $query = "SELECT * FROM barang ORDER BY id DESC";
    $result = $koneksi->query($query);
    $barang = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $barang[] = $row;
        }
    }
    return $barang;
}

// --- R: READ (Mengambil 1 data untuk Edit) ---
function ambil_data_by_id($id) {
    global $koneksi;
    $id = $koneksi->real_escape_string($id);
    $query = "SELECT * FROM barang WHERE id = '$id'";
    $result = $koneksi->query($query);
    return ($result->num_rows == 1) ? $result->fetch_assoc() : null;
}

// --- C: CREATE (Menambah data baru) ---
function tambah_barang($data) {
    global $koneksi;
    $nama = $koneksi->real_escape_string($data['nama']);
    $harga = $koneksi->real_escape_string($data['harga']);
    $stok = $koneksi->real_escape_string($data['stok']);
    $deskripsi = $koneksi->real_escape_string($data['deskripsi']);

    $query = "INSERT INTO barang (nama_barang, harga, stok, deskripsi) VALUES ('$nama', '$harga', '$stok', '$deskripsi')";
    return $koneksi->query($query);
}

// --- U: UPDATE (Mengubah data) ---
function update_barang($data) {
    global $koneksi;
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
    return $koneksi->query($query);
}

// --- D: DELETE (Menghapus data) ---
function hapus_barang($id) {
    global $koneksi;
    $id = $koneksi->real_escape_string($id);
    $query = "DELETE FROM barang WHERE id = '$id'";
    return $koneksi->query($query);
}

// =========================================================================
// BAGIAN 3: KONTROL ALIRAN APLIKASI (Memproses POST dan GET)
// =========================================================================
$mode_edit = false;
$data_edit = [];
$pesan_status = ''; 

// --- Proses Form POST (Tambah/Update) ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tambah'])) {
        if (tambah_barang($_POST)) {
            $pesan_status = 'success|Data barang berhasil ditambahkan!';
        } else {
            $pesan_status = 'error|Gagal menambahkan data barang: ' . $koneksi->error;
        }
    } elseif (isset($_POST['update'])) {
        if (update_barang($_POST)) {
            $pesan_status = 'success|Data barang berhasil diperbarui!';
        } else {
            $pesan_status = 'error|Gagal memperbarui data barang: ' . $koneksi->error;
        }
    }
}

// --- Proses GET (Hapus) ---
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    if (hapus_barang($_GET['id'])) {
        $pesan_status = 'success|Data barang berhasil dihapus!';
    } else {
        $pesan_status = 'error|Gagal menghapus data barang: ' . $koneksi->error;
    }
}

// --- Proses GET (Edit) ---
if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit' && isset($_GET['id'])) {
    $data_edit = ambil_data_by_id($_GET['id']);
    if ($data_edit) {
        $mode_edit = true;
    } else {
        $pesan_status = 'error|Data barang tidak ditemukan.';
    }
}

// --- READ: Ambil semua data untuk ditampilkan ---
$daftar_barang = ambil_data_barang();

// --- REDIRECT (Pencegahan Form Resubmission) ---
if ($_SERVER["REQUEST_METHOD"] == "POST" || (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus')) {
    // Redirect ke halaman yang sama dengan menyertakan pesan status
    $redirect_url = strtok($_SERVER["REQUEST_URI"], '?') . "?status=" . urlencode($pesan_status);
    header("Location: " . $redirect_url);
    exit();
}

// --- Ambil pesan status setelah redirect ---
if (isset($_GET['status'])) {
    $pesan_status = urldecode($_GET['status']);
}

// Parsing pesan status menjadi tipe dan teks
list($tipe_pesan, $teks_pesan) = explode('|', $pesan_status . '|');

// =========================================================================
// BAGIAN 4: TAMPILAN HTML
// Setelah PHP Logic selesai, output HTML dimulai di sini
// =========================================================================
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi CRUD PHP Native Satu File</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f7f9fb; }
        .pesan-sukses { background-color: #d1fae5; color: #065f46; border-color: #10b981; }
        .pesan-gagal { background-color: #fee2e2; color: #991b1b; border-color: #ef4444; }
    </style>
</head>
<body class="p-4 sm:p-8 min-h-screen flex justify-center">

    <div class="w-full max-w-6xl">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center border-b pb-4">CRUD Data Barang (Single File)</h1>

        <?php if ($pesan_status) : ?>
            <div class="pesan-<?php echo ($tipe_pesan == 'success' ? 'sukses' : 'gagal'); ?> px-4 py-3 rounded-xl border-l-4 mb-6 shadow-md">
                <p class="font-bold"><?php echo ($tipe_pesan == 'success' ? 'Berhasil!' : 'Gagal!'); ?></p>
                <p class="text-sm"><?php echo htmlspecialchars($teks_pesan); ?></p>
            </div>
        <?php endif; ?>

        <div class="bg-white shadow-xl rounded-2xl p-6 mb-8 border border-blue-100">
            <h2 class="text-2xl font-bold mb-4 text-blue-600">
                <?php echo $mode_edit ? 'Ubah Data Barang' : 'Tambah Data Barang Baru'; ?>
            </h2>
            
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                
                <?php if ($mode_edit): ?>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($data_edit['id']); ?>">
                    <input type="hidden" name="update" value="1">
                <?php else: ?>
                    <input type="hidden" name="tambah" value="1">
                <?php endif; ?>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                        <input type="text" id="nama" name="nama" required 
                               value="<?php echo $mode_edit ? htmlspecialchars($data_edit['nama_barang']) : ''; ?>"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                        <input type="number" id="harga" name="harga" required 
                               value="<?php echo $mode_edit ? htmlspecialchars($data_edit['harga']) : ''; ?>"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" id="stok" name="stok" required 
                               value="<?php echo $mode_edit ? htmlspecialchars($data_edit['stok']) : ''; ?>"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3"
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 resize-none"><?php echo $mode_edit ? htmlspecialchars($data_edit['deskripsi']) : ''; ?></textarea>
                </div>
                
                <div class="flex space-x-3">
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-xl transition duration-300 shadow-lg">
                        <?php echo $mode_edit ? 'Simpan Perubahan' : 'Tambah Barang'; ?>
                    </button>
                    <?php if ($mode_edit): ?>
                        <a href="<?php echo strtok($_SERVER["REQUEST_URI"], '?'); ?>" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded-xl transition duration-300 shadow-lg flex items-center">
                            Batal Edit
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <h2 class="text-2xl font-bold text-gray-700 mb-4 pt-4 border-t">Daftar Stok Barang</h2>
        
        <div class="bg-white shadow-xl rounded-2xl overflow-x-auto border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    
                    <?php 
                    if (count($daftar_barang) > 0) {
                        foreach($daftar_barang as $barang) { 
                    ?>
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($barang['id']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold"><?php echo htmlspecialchars($barang['nama_barang']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Rp<?php echo number_format($barang['harga'], 0, ',', '.'); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-bold <?php echo ($barang['stok'] < 10) ? 'text-red-500' : 'text-green-600'; ?>"><?php echo htmlspecialchars($barang['stok']); ?></td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="<?php echo htmlspecialchars($barang['deskripsi']); ?>"><?php echo htmlspecialchars($barang['deskripsi']); ?></td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                <a href="?aksi=edit&id=<?php echo $barang['id']; ?>" 
                                   class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 hover:bg-indigo-200 p-2 rounded-lg transition duration-150 text-xs font-bold">
                                    EDIT
                                </a>
                                <a href="?aksi=hapus&id=<?php echo $barang['id']; ?>" 
                                   onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS DATA INI?')"
                                   class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 p-2 rounded-lg transition duration-150 text-xs font-bold">
                                    HAPUS
                                </a>
                            </td>
                        </tr>
                    <?php 
                        } 
                    } else {
                    ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">Tidak ada data barang saat ini.</td>
                        </tr>
                    <?php
                    }
                    $koneksi->close(); // Tutup koneksi di akhir script
                    ?>

                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
