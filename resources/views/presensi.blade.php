<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forum Kelas: Presensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="icons/favicon.png">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <div class="d-flex flex-grow-1">

        <!-- SIDEBAR -->
        <div class="p-4" style="width: 260px; min-height: 100vh; background-color: #C9B59C;">
            <h4 class="fw-bold">Forum Kelas</h4>
            <h4 class="fw-bold">SOFTWARE ENGINEERING App</h4>

            <ul class="nav flex-column mt-4">
                <li class="nav-item mb-2"><a class="nav-link text-dark" href="beranda"><img src="images/Home Page.png"
                            width="20"> Beranda</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-dark" href="presensi"><img src="images/Bookmark.png"
                            width="20"> Presensi</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-dark" href="kas"><img src="images/Banknotes.png"
                            width="20"> Kas</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-dark" href="laporan"><img
                            src="images/Graph Report.png" width="20"> Laporan Kas</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-dark" onclick="hapus()"><img
                            src="images/Emergency Exit.png" width="20"> Log out</a></li>
            </ul>
        </div>

        <!-- MAIN CONTENT -->
        <main class="p-4 flex-grow-1">

            <nav class="navbar bg-body-tertiary">
                <form class="container" method="GET" action="{{ route('presensi.index') }}">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><img src="images/Search.png"
                                width="20"></span>
                        <input type="search" name="q" value="{{ request('q') }}" class="form-control"
                            placeholder="Cari Nama Siswa" aria-label="Username" aria-describedby="basic-addon1" />
                    </div>
                </form>
            </nav>

            <div class="container mt-4">
                <h5>Tanggal Presensi : Hari ini</h5>
                @if ($q)
                    <table class="table table-bordered table-striped w-100 mt-4">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Presensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $key => $item)
                                @php
                                    // Find attendance record for this student
                                    $attendance = $items->firstWhere('nama_lengkap', $item->nama_lengkap);
                                    $isHadir = $attendance ? $attendance->isHadir : null;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-4">
                                            <label class="form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="presensi{{ $item->nama_lengkap }}" value="H"
                                                    {{ $isHadir === 'H' ? 'checked' : '' }}> H
                                            </label>
                                            <label class="form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="presensi{{ $item->nama_lengkap }}" value="A"
                                                    {{ $isHadir === 'T' ? 'checked' : '' }}> A
                                            </label>
                                            <label class="form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="presensi{{ $item->nama_lengkap }}" value="S"
                                                    {{ $isHadir === 'S' ? 'checked' : '' }}> S
                                            </label>
                                            <label class="form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="presensi{{ $item->nama_lengkap }}" value="I"
                                                    {{ $isHadir === 'I' ? 'checked' : '' }}> I
                                            </label>
                                            <label class="form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="presensi{{ $item->nama_lengkap }}" value="D"
                                                    {{ $isHadir === 'D' ? 'checked' : '' }}> D
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <div class="col-12 text-danger text-center">
                                        <p>Catatan presensi tidak ditemukan.</p>
                                    </div>
                                @endforelse
                        </table>
                    @endif
                </div>

                @if (!$q)
                    <div class="container mx-4">
                        <table class="table table-bordered table-striped w-100 mt-4">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Presensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $key => $item)
                                    @php
                                        // Find attendance record for this student
                                        $attendance = $absensi->firstWhere('nama_lengkap', $item->nama_lengkap);
                                        $isHadir = $attendance ? $attendance->isHadir : null;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $item->nama_lengkap }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-4">
                                                <label class="form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="presensi{{ $item->nama_lengkap }}" value="H"
                                                        {{ $isHadir === 'H' ? 'checked' : '' }}> H
                                                </label>
                                                <label class="form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="presensi{{ $item->nama_lengkap }}" value="A"
                                                        {{ $isHadir === 'T' ? 'checked' : '' }}> A
                                                </label>
                                                <label class="form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="presensi{{ $item->nama_lengkap }}" value="S"
                                                        {{ $isHadir === 'S' ? 'checked' : '' }}> S
                                                </label>
                                                <label class="form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="presensi{{ $item->nama_lengkap }}" value="I"
                                                        {{ $isHadir === 'I' ? 'checked' : '' }}> I
                                                </label>
                                                <label class="form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="presensi{{ $item->nama_lengkap }}" value="D"
                                                        {{ $isHadir === 'D' ? 'checked' : '' }}> D
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </main>
        </div>

        <!-- FOOTER -->
        <footer class="p-3 d-flex justify-content-between" style=" background-color: #C9B59C;">
            <p style="margin-left: 35px;">2025 © Forum Kelas</p>
            <p class="float-end">Dibuat Oleh : SANA TEAM</p>
        </footer>

    </body>



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
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    </html>
