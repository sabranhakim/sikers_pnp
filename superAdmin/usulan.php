<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<!-- Content -->

<body>
    <?php 
        $aksi = isset($_GET["aksi"]) ? $_GET["aksi"] : 'list';

        switch ($aksi) :
            case 'list':
    ?>
    <h2>Data Usulan Kerjasama</h2>
    <!-- <a href="?page=tabelUsulan&aksi=input" class="btn btn-primary mb-3 mt-3"><i class="bi bi-plus-circle"></i> New</a> -->
    <div class="table-responsive col-12">
        <table id="tabel-usulan" class="table table-bordered table-hover caption-top text-center table-striped border-left-warning">
            <thead>
                <tr>
                    <!-- id_usulan	nama_instansi	alamat	nama_pejabat_penanda_tangan	nama_jabatan	no_kontak	alamat_email	upload_dokumen -->
                    <th>No</th>
                    <th>Nama Instansi</th>
                    <th>Alamat</th>
                    <th>Pejabat Penanda Tangan</th>
                    <th>Jabatan</th>
                    <th>No Kontak</th>
                    <th>Alamat Email</th>
                    <th>Dokumen Usulan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php 
            include ("../sikermaPNP/koneksi.php");

            $ambil = mysqli_query($koneksi,"SELECT * FROM tb_usulan");
            $no = 1;
            while($data_usulan = mysqli_fetch_array($ambil)) {
                $status = $data_usulan['status'];
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $data_usulan['nama_instansi'] ?></td>
                    <td><?= $data_usulan['alamat'] ?></td>
                    <td><?= $data_usulan['nama_pejabat_penanda_tangan'] ?></td>
                    <td><?= $data_usulan['nama_jabatan'] ?></td>
                    <td><?= $data_usulan['no_kontak'] ?></td>
                    <td><?= $data_usulan['alamat_email'] ?></td>
                    <td>
                        <?php if (!empty($data_usulan['upload_dokumen'])) { ?>
                        <a href="<?= $data_usulan['upload_dokumen'] ?>" target="_blank" class="btn"
                        style="background-color: #dc5902; color: white;" download>
                            <i class="bi bi-download"></i> Download
                        </a>
                        <?php } else { ?>
                        <span class="text-muted">No File</span>
                        <?php } ?>
                    </td>
                    <td>
                        <span
                            class="badge <?= $status == 'Approved' ? 'text-success' : ($status == 'Declined' ? 'text-danger' : 'bg-secondary') ?>">
                            <?= $status ?>
                        </span>
                    </td>
                    <td class="text-nowrap">
                        <?php if ($status == 'Pending') { ?>
                        <a href="/superAdmin/proses_usulan.php?proses=approve&id=<?= $data_usulan['id_usulan'] ?>"
                            class="btn btn-success btn-sm" onclick="return confirm('Approve usulan ini?')">
                            <i class="bi bi-check"></i>
                        </a>
                        <a href="/superAdmin/proses_usulan.php?proses=decline&id=<?= $data_usulan['id_usulan'] ?>"
                            class="btn btn-danger btn-sm" onclick="return confirm('Decline usulan ini?')">
                            <i class="bi bi-x"></i>
                        </a>
                        <?php } ?>
                        <a href="?page=tabelUsulan&aksi=edit&id_edit=<?= $data_usulan['id_usulan'] ?>"
                            class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                        <a href="/superAdmin/proses_usulan.php?proses=delete&id_hapus=<?= $data_usulan['id_usulan'] ?>"
                            class="btn btn-danger" onclick="return confirm('Yakin menghapus data?')"><i
                                class="bi bi-trash"></i></a>
                    </td>

                </tr>
                <?php 
            $no++;
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php 
        break;
        case 'edit':
            include "../sikermaPNP/koneksi.php";
            
            // Cek apakah ada parameter `id_edit` di URL
            if (isset($_GET['id_edit'])) {
                $id_edit = $_GET['id_edit'];
            
                // Ambil data usulan berdasarkan `id_usulan`
                $query = "SELECT * FROM tb_usulan WHERE id_usulan = '$id_edit'";
                $result = mysqli_query($koneksi, $query);
                $data_usulan = mysqli_fetch_array($result);
            }
            ?>

    <!-- Form Edit Usulan Kerjasama -->
    <h2>Edit Usulan Kerjasama</h2>
    <form action="superAdmin/proses_usulan.php?proses=update" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_usulan" value="<?= $data_usulan['id_usulan'] ?>">

        <div class="form-group">
            <label for="nama_instansi">Nama Instansi</label>
            <input type="text" name="nama_instansi" class="form-control" value="<?= $data_usulan['nama_instansi'] ?>"
                required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="<?= $data_usulan['alamat'] ?>" required>
        </div>

        <div class="form-group">
            <label for="nama_pejabat_penanda_tangan">Nama Pejabat Penanda Tangan</label>
            <input type="text" name="nama_pejabat_penanda_tangan" class="form-control"
                value="<?= $data_usulan['nama_pejabat_penanda_tangan'] ?>" required>
        </div>

        <div class="form-group">
            <label for="nama_jabatan">Nama Jabatan</label>
            <input type="text" name="nama_jabatan" class="form-control" value="<?= $data_usulan['nama_jabatan'] ?>"
                required>
        </div>

        <div class="form-group">
            <label for="no_kontak">No Kontak</label>
            <input type="text" name="no_kontak" class="form-control" value="<?= $data_usulan['no_kontak'] ?>" required>
        </div>

        <div class="form-group">
            <label for="alamat_email">Alamat Email</label>
            <input type="email" name="alamat_email" class="form-control" value="<?= $data_usulan['alamat_email'] ?>"
                required>
        </div>

        <div class="form-group">
            <label for="upload_dokumen">Upload Dokumen Usulan</label>
            <input type="file" name="upload_dokumen" class="form-control">
            <!-- Menampilkan nama file yang ada di database jika file sudah ada -->
            <?php if ($data_usulan['upload_dokumen']) { ?>
            <p>File yang ada: <?= $data_usulan['upload_dokumen'] ?></p>
            <?php } ?>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</body>
<?php 
        break;
        endswitch;
    ?>