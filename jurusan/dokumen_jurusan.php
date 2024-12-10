<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<!-- Content -->
<h2>Data Dokumen</h2>
    <div class="table-responsive col-12">
        <table id="tabel-dokumen-jurusan" class="table table-bordered table-striped border-left-warning">
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
                    <th>Upload Dokumen</th>
                </tr>
            </thead>

            <tbody>
                <?php 
            include ("../sikermaPNP/koneksi.php");

            $ambil = mysqli_query($koneksi,"SELECT * FROM tb_dokumen JOIN tb_mitra ON tb_dokumen.mitra_id = tb_mitra.id_mitra;");
            $no = 1;
            while($data_dokumen = mysqli_fetch_array($ambil)) {
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $data_dokumen['no_dokumen'] ?></td>
                    <td><?= $data_dokumen['instansi_mitra'] ?></td>
                    <td><?= $data_dokumen['jenis_dokumen'] ?></td>
                    <td><?= $data_dokumen['jangka_waktu'] ?></td>
                    <td><?= $data_dokumen['awal_kerjasama'] ?></td>
                    <td><?= $data_dokumen['akhir_kerjasama'] ?></td>
                    <td><?= $data_dokumen['keterangan'] ?></td>
                    <td><?= $data_dokumen['bidang_usaha'] ?></td>
                    <td><?= $data_dokumen['jurusan_terkait'] ?></td>
                    <td><?= $data_dokumen['topik_kerjasama'] ?></td>
                    <td><?= $data_dokumen['link_dokumen'] ?></td>
                    
                </tr>
                <?php 
            $no++;
        }
        ?>
            </tbody>
        </table>
    </div>