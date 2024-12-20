<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<!-- Content -->
<h2>Data Dokumen</h2>
<div class="table-responsive col-12">
    <table id="tabel-dokumen-jurusan"
        class="table table-bordered table-hover caption-top text-center table-striped border-left-warning">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor MOU/MOA</th>
                <th>Instansi Mitra</th>
                <th>Jenis Dokumen</th>
                <th>Jangka Waktu</th>
                <th>Awal Kerjasama</th>
                <th>Akhir Kerjasama</th>
                <th>Keterangan</th>
                <th>Bidang Usaha</th>
                <th>Jurusan Terkait</th>
                <th>Topik Kerjasama</th>
                <th>Download Dokumen</th>
            </tr>
        </thead>

        <tbody>
            <?php 
include ("../sikermaPNP/koneksi.php");

// Ambil data dari database
$ambil = mysqli_query($koneksi, "SELECT * FROM tb_dokumen JOIN tb_mitra ON tb_dokumen.mitra_id = tb_mitra.id_mitra;");
$no = 1;

// Tanggal hari ini
$tanggal_sekarang = date("Y-m-d");

while ($data_dokumen = mysqli_fetch_array($ambil)) {
    // Cek apakah akhir kerjasama sudah lewat
    $akhir_kerjasama = $data_dokumen['akhir_kerjasama'];
    $isAktif = $akhir_kerjasama >= $tanggal_sekarang;

    // Tentukan warna baris
    $bgColor = $isAktif ? 'bg-success' : 'bg-danger';
    ?>
            <tr class="<?= $bgColor ?>">
                <td><?= $no ?></td>
                <td><?= $data_dokumen['no_dokumen'] ?></td>
                <td><?= $data_dokumen['instansi_mitra'] ?></td>
                <td><?= $data_dokumen['jenis_dokumen'] ?></td>
                <td><?= $data_dokumen['jangka_waktu'] ?></td>
                <td><?= $data_dokumen['awal_kerjasama'] ?></td>
                <td><?= $akhir_kerjasama ?></td>
                <td>
                    <?php if ($isAktif) : ?>
                    <span class="text-success"><strong>Aktif</strong></span>
                    <?php else : ?>
                    <span class="text-danger"><strong>Tidak Aktif</strong></span>
                    <?php endif; ?>
                </td>
                <td><?= $data_dokumen['bidang_usaha'] ?></td>
                <td><?= $data_dokumen['jurusan_terkait'] ?></td>
                <td><?= $data_dokumen['topik_kerjasama'] ?></td>
                <td>
                    <?php if (!empty($data_dokumen['link_dokumen'])) { ?>
                        <a href="<?= $data_dokumen['link_dokumen'] ?>" target="_blank" class="btn" style="background-color: #dc5902; color: white;" download>
                            <i class="bi bi-download"></i> Download
                        </a>
                    <?php } else { ?>
                    <span class="text-muted">No File</span>
                    <?php } ?>
                </td>
            </tr>
            <?php 
    $no++;
}
?>

        </tbody>
    </table>
</div>