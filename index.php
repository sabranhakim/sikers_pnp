<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Kerjasama - Politeknik Negeri Padang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
    #overview {
        background-image: url('img/');
        background-size: cover;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

</style>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top" style="height: 70px;">
        <div class="container">
            <a class="navbar-brand" href="#">SIKers PNP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#statistik">Statistik</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kerjasama">Kerjasama</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li> -->
                    <button style="background-color: #de6e24; color: white;" class="btn" data-bs-toggle="modal" data-bs-target="#usulanModal">Usulkan
                        Kerjasama</button>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Overview Section -->
    <section id="overview" class="d-flex align-items-center justify-content-center text-center text-white"
        style="min-height: 100vh;">
        <div class="container">
            <div>
                <img src="img/PNP.PNG" alt="" height="200px" width="200px">
            </div>
            <h1>Sistem Informasi Kerjasama</h1>
            <h3>Politeknik Negeri Padang</h3>
            <a href="login.php" class="btn btn-lg mt-3" style="background-color: #de6e24; color: white;">Login</a>
        </div>
    </section>


    <!-- Statistik Section -->
    <section id="statistik" class="py-5 bg-light" style="min-height: 100vh;">
        <div class="container">
            <h2 class="text-center mb-4" style="padding-top: 30px;">Statistik Kerjasama</h2>
            <div class="row">
                <div class="col-md-4">
                    <canvas id="pieChart"></canvas>
                </div>
                <div class="col-md-8">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    <!-- Kerjasama Section -->
    <section id="kerjasama" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Daftar Kerjasama</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mitra</th>
                        <th>Jenis Kerjasama</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>PT ABC</td>
                        <td>Magang</td>
                        <td>2023-01-15</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Universitas XYZ</td>
                        <td>Penelitian</td>
                        <td>2023-03-10</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Universitas XYZ</td>
                        <td>Penelitian</td>
                        <td>2023-03-10</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Universitas XYZ</td>
                        <td>Penelitian</td>
                        <td>2023-03-10</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Universitas XYZ</td>
                        <td>Penelitian</td>
                        <td>2023-03-10</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Universitas XYZ</td>
                        <td>Penelitian</td>
                        <td>2023-03-10</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Universitas XYZ</td>
                        <td>Penelitian</td>
                        <td>2023-03-10</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal Section -->
    <div class="modal modal-lg fade" id="usulanModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/superAdmin/proses_usulan.php?proses=insert" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Form Usulan Kerjasama</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_usulan" id="id_usulan">
                        <div class="mb-3">
                            <label for="nama_instansi" class="form-label">Nama Instansi</label>
                            <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pejabat_penanda_tangan" class="form-label">Nama Pejabat Penanda Tangan</label>
                            <input type="text" class="form-control" id="nama_pejabat_penanda_tangan" name="nama_pejabat_penanda_tangan" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_kontak" class="form-label">No Kontak</label>
                            <input type="text" class="form-control" id="no_kontak" name="no_kontak" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat_email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="alamat_email" name="alamat_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="upload_dokumen" class="form-label">Upload Dokumen (tidak lebih dari 4mb)</label>
                            <input type="file" class="form-control" id="upload_dokumen" name="upload_dokumen" accept=".pdf,.doc,.docx" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Politeknik Negeri Padang. All Rights Reserved.</p>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js Config -->
    <script>
        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Mitra Industri', 'Perguruan Tinggi', 'Pemerintah'],
                datasets: [{
                    data: [30, 45, 25],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                }]
            }
        });

        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['2021', '2022', '2023'], // Tahun
                datasets: [{
                        label: 'Jumlah MoU', // Dataset untuk MoU
                        data: [15, 25, 40], // Data jumlah MoU
                        backgroundColor: '#007bff', // Warna biru untuk MoU
                    },
                    {
                        label: 'Jumlah MoA', // Dataset untuk MoA
                        data: [10, 20, 30], // Data jumlah MoA
                        backgroundColor: '#28a745', // Warna hijau untuk MoA
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top', // Posisi legenda di atas
                    },
                    tooltip: {
                        enabled: true, // Menampilkan tooltip saat hover
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tahun', // Label pada sumbu X
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Kerjasama', // Label pada sumbu Y
                        },
                        beginAtZero: true // Mulai dari nol
                    }
                }
            }
        });
    </script>
</body>

</html>