<?php
include 'koneksi.php';

    // Query data berdasarkan tahun
    $query = "
        SELECT YEAR(tanggal_dokumen) AS tahun, jenis_dokumen, COUNT(*) AS jumlah 
        FROM tb_dokumen 
        GROUP BY tahun, jenis_dokumen
        ORDER BY tahun ASC
    ";
    $result = $koneksi->query($query);

    // Siapkan data untuk Chart.js
    $data = [];
    $years = [];
    $mouData = [];
    $moaData = [];

    while ($row = $result->fetch_assoc()) {
        $tahun = $row['tahun'];
        $jenis = strtoupper($row['jenis_dokumen']);
        $jumlah = (int)$row['jumlah'];

        if (!in_array($tahun, $years)) {
            $years[] = $tahun;
        }

        if ($jenis === 'MOU') {
            $mouData[$tahun] = $jumlah;
        } elseif ($jenis === 'MOA') {
            $moaData[$tahun] = $jumlah;
        }
    }

    // Pastikan semua tahun memiliki nilai default (0) jika tidak ada data
    foreach ($years as $tahun) {
        $mouData[$tahun] = $mouData[$tahun] ?? 0;
        $moaData[$tahun] = $moaData[$tahun] ?? 0;
    }

    // Konversi data ke format JSON
    $chartData = [
        'years' => $years,
        'mou' => array_values($mouData),
        'moa' => array_values($moaData)
    ];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>
    <div class="row">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total MOU</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">40,000</div>
                        </div>
                        <div class="col-auto">
                            <!-- icon -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total MOA</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">10.000</div>
                        </div>
                        <div class="col-auto">
                            <!-- icon -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Usulan Kerjasama</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">10.000</div>
                        </div>
                        <div class="col-auto">
                            <!-- icon -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="container-fluid" style="padding: 20px;">
        <div class="row">

            <!-- Bar Chart -->
            <div class="col-xl-8">
                <div class="card shadow mb-4 border-left-warning">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-light">Earnings Overview</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="barChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4">
                <div class="card shadow mb-4 border-left-warning">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-light">Pie Chart Overview</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="pieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Mitra Industri
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Perguruan Tinggi
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-warning"></i> Pemerintah
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Data dari PHP
        const chartData = < ? php echo json_encode($chartData); ? > ;

        // Inisialisasi Chart.js
        const ctx = document.getElementById('barChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.years,
                datasets: [{
                        label: 'MoU',
                        data: chartData.mou,
                        backgroundColor: '#007bff',
                    },
                    {
                        label: 'MoA',
                        data: chartData.moa,
                        backgroundColor: '#28a745',
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tahun'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Dokumen'
                        },
                        beginAtZero: true
                    }
                }
            }
        });


        // Pie Chart
        // const pieCtx = document.getElementById('pieChart').getContext('2d');
        // new Chart(pieCtx, {
        //     type: 'pie',
        //     data: {
        //         labels: ['Mitra Industri', 'Perguruan Tinggi', 'Pemerintah'],
        //         datasets: [{
        //             data: [30, 45, 25],
        //             backgroundColor: ['#007bff', '#28a745', '#ffc107'],
        //         }]
        //     }
        // });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>