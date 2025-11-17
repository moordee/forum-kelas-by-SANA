<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forum Kelas: Kas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="d-flex">
        <div class=" p-4" style="width: 260px; min-height: 100vh; background-color: #C9B59C;">
            <h4 class="fw-bold">Forum Kelas</h4>
            <h4 class="fw-bold">SOFTWARE ENGINEERING App</h4>

           <ul class="nav flex-column mt-4">
                <li class="nav-item mb-2"><a class="nav-link text-dark" href="beranda"><img src="images/Home Page.png" width="20"> Beranda</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-dark" href="presensi"><img src="images/Bookmark.png" width="20"> Presensi</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-dark" href="kas"><img src="images/Banknotes.png" width="20"> Kas</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-dark" href="laporan"><img src="images/Graph Report.png" width="20"> Laporan Kas</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-dark" onclick="hapus()"><img src="images/Emergency Exit.png" width="20"> Log out</a></li>
            </ul>
        </div>

        <div class="p-4 flex-grow-1">
            <nav class="navbar bg-body-tertiary">
                <form class="container">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><img src="images/Search.png" width="20"></span>
                        <input type="text" class="form-control" placeholder="Cari Nama Siswa" aria-label="Username"
                            aria-describedby="basic-addon1" />
                    </div>
                </form>
            </nav>
            <div class="container mt-4">
                <table class="table table-bordered table-striped w-100 mt-4">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kas_data as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->nama_lengkap }}</td>
                            <td class="text-center"> {{ $item->tanggal_bayar }} </td>
                            </td>
                            <td class="text-center"> {{ $item->jumlah_bayar }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <footer class="p-3 mt-4 fixed-bottom d-flex justify-content-between" style=" background-color: #C9B59C;">
                <p style="margin-left: 35px;">2025 © Forum Kelas</p>
                <p class="float-end">Dibuat Oleh : SANA TEAM</p>
            </footer>
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
