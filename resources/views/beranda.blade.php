<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="d-flex">
        <div class=" p-4" style="width: 260px; min-height: 100vh; background-color: #C9B59C;">
            <h4 class="fw-bold">SOFTWARE</h4>
            <h4 class="fw-bold">ENGINEERING App</h4>

            <ul class="nav flex-column mt-4">
                <li class="nav-item mb-2"><a class="nav-link text-dark" href="beranda"><img src="images/Home Page.png" width="20"> Beranda</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-dark" href="presensi"><img src="images/Bookmark.png" width="20"> Presensi</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-dark" href="kas"><img src="images/Banknotes.png" width="20"> Kas</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-dark" href="laporan"><img src="images/Graph Report.png" width="20"> Laporan Kas</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-dark" onclick="hapus()"><img src="images/Emergency Exit.png" width="20"> Log out</a></li>
            </ul>
        </div>

        <div class="p-4 flex-grow-1">

            <h2 class="text-center mb-2">Selamat Pagi</h2>

            <p class="text-center">
                Selamat datang di halaman beranda kelas kita.
                Di sini kalian bisa melihat informasi terbaru, jadwal, tugas, serta pengumuman penting lainnya.
            </p>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="border rounded p-3 bg-white shadow-sm">
                        <p>H =</p>
                        <p>A =</p>
                        <p>S =</p>
                        <p>D =</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="border rounded p-3 bg-white shadow-sm">
                        <p class="fw-bold">Jadwal Hari Ini</p>
                    </div>
                </div>
            </div>

            <div class="border rounded p-3 bg-white shadow-sm">
                <p class="fw-bold">❗ Tugas / Pengumuman :</p>
                <footer class="p-3 mt-4 fixed-bottom d-flex justify-content-between"
                    style=" background-color: #C9B59C;">
                    <p style="margin-left: 35px;">2025 © Forum Kelas</p>
                    <p class="float-end">Dibuat Oleh : SANA TEAM</p>
                </footer>
            </div>

        </div>

        <script>
            function hapus() {
                Swal.fire({
                    title: 'Yakin Ingin Logout?',
                    text: "Anda akan keluar dari aplikasi ini.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Logout!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Swal.fire({
                            title: 'Logged Out!',
                            text: 'Anda telah berhasil logout.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "/in";
                        });

                    }
                })
            }
        </script>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
</body>

</html>