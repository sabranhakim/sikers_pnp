<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<!-- content -->
<div class="container-fluid">
    <?php 
        $aksi = isset($_GET["aksi"]) ? $_GET["aksi"] : 'list';

        switch ($aksi) :
            case 'list':
    ?>
    <h2>Data Dokumen</h2>
    <a href="?page=tabelDokumen&aksi=input" class="btn btn-primary mb-3 mt-3"><i class="bi bi-plus-circle"></i> New</a>
    <div class="table-responsive col-12">
        <table id="tabel-dokumen" class="table table-bordered table-striped border-left-warning">
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
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php 
            include ("../sikermaPNP/koneksi.php");
                //SELECT * FROM tb_mou_moa JOIN tb_mitra ON tb_mou_moa.mitra_idMitra = tb_mitra.idMitra
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
                    <td>
                        <?php if (!empty($data_dokumen['link_dokumen'])) { ?>
                        <a href="<?= $data_dokumen['link_dokumen'] ?>" target="_blank" class="btn btn-primary">
                            <i class="bi bi-download"></i> Download
                        </a>
                        <?php } else { ?>
                        <span class="text-muted">No File</span>
                        <?php } ?>
                    </td>
                    <td class="text-nowrap">
                        <a href="?page=tabelDokumen&aksi=edit&id_edit=<?= $data_dokumen['id_dokumen'] ?>"
                            class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                        <a href="/superAdmin/proses_dokumen.php?proses=delete&id_hapus=<?= $data_dokumen['id_dokumen'] ?>"
                            class="btn btn-danger" onclick="return confirm('Yakin menghapus data?')"><i
                                class="bi bi-trash"></i></a>
                    </td>
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
        case 'input':
    ?>
    <h2>Tambah Data Dokumen</h2>
    <form action="superAdmin/proses_dokumen.php?proses=insert" method="POST" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="id_dokumen">
        <div class="form-group">
            <label for="no_dokumen">Nomor MOU/MOA</label>
            <input type="text" class="form-control" name="no_dokumen" required>
        </div>
        <div class="mb-3">
            <label for="mitra_id" class="form-label">Nama Instansi</label>
            <select name="mitra_id" id="mitra_id" class="form-select" required>
                <option value="">--Pilih Instansi--</option>
                <?php 
                            include "koneksi.php";

                            $instansi = mysqli_query($koneksi, "SELECT * FROM tb_mitra");
                            while($data_mitra = mysqli_fetch_array($instansi)) {
                                echo "<option value=".$data_mitra['id_mitra'].">".$data_mitra['instansi_mitra']."</option>";
                            }
                        ?>
            </select>
        </div>
        <div class="form-group">
            <label for="jenis_dokumen">Jenis Dokumen</label>
            <select class="form-control" name="jenis_dokumen" id="jenis_dokumen" required>
                <option value="">-- Pilih Jenis Dokumen --</option>
                <option value="MOU">MOU</option>
                <option value="MOA">MOA</option>
                <option value="IA">IA</option>
            </select>
        </div>
        <div class="form-group">
            <label for="jangka_waktu">Jangka Waktu</label>
            <input type="text" class="form-control" name="jangka_waktu" required>
        </div>
        <div class="form-group">
            <label for="awal_kerjasama">Awal Kerjasama</label>
            <input type="date" class="form-control" name="awal_kerjasama" required>
        </div>
        <div class="form-group">
            <label for="akhir_kerjasama">Akhir Kerjasama</label>
            <input type="date" class="form-control" name="akhir_kerjasama" required>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label><br>
            <input type="radio" name="keterangan" value="Aktif" required> Aktif <br>
            <input type="radio" name="keterangan" value="Tidak Aktif" required> Tidak Aktif
        </div>
        <div class="form-group">
            <label for="bidang_usaha">Bidang Usaha</label>
            <input type="text" class="form-control" name="bidang_usaha" required>
        </div>
        <div class="form-group">
            <label for="jurusan_terkait">Jurusan Terkait</label>
            <select class="form-control" name="jurusan_terkait" required>
                <option value="">-- Pilih Jurusan Terkait --</option>
                <option value="Teknologi Informasi">Teknologi Informasi</option>
                <option value="Teknik Mesin">Teknik Mesin</option>
                <option value="Teknik Sipil">Teknik Sipil</option>
                <option value="Teknik Elektro">Teknik Elektro</option>
                <option value="Administrasi Niaga">Administrasi Niaga</option>
                <option value="Akuntansi">Akuntansi</option>
                <option value="Bahasa Inggris">Bahasa Inggris</option>
                <option value="General">General</option>
            </select>
        </div>
        <div class="form-group">
            <label for="topik_kerjasama">Topik Kerjasama</label>
            <input type="text" class="form-control" name="topik_kerjasama" required>
        </div>
        <div class="form-group">
            <label for="link_dokumen">Upload Dokumen (harus kurang dari 4mb)</label>
            <input type="file" class="form-control" name="link_dokumen" accept=".pdf,.doc,.docx" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
        <a href="?page=tabelDokumen&aksi=list" class="btn btn-secondary">Batal</a>
    </form>


    <?php 
        break;
        case 'edit':
            include '../sikermaPNP/koneksi.php';
            $id_edit = $_GET['id_edit'];
            $query_edit = mysqli_query($koneksi, "SELECT * FROM tb_dokumen WHERE id_dokumen = '$id_edit'");
            $data_edit = mysqli_fetch_array($query_edit);
    ?>

    <h2>Edit Data Dokumen</h2>
    <form action="superAdmin/proses_dokumen.php?proses=update" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_dokumen" value="<?= $data_edit['id_dokumen'] ?>">
        <div class="form-group">
            <label for="no_dokumen">Nomor MOU/MOA</label>
            <input type="text" class="form-control" name="no_dokumen" value="<?= $data_edit['no_dokumen'] ?>" required>
        </div>
        <div class="form-group">
            <label for="mitra_id">Instansi Mitra</label>
            <select class="form-control" name="mitra_id" required>
                <option value="">-- Pilih Instansi Mitra --</option>
                <?php
                    // Fetch all records from the tb_mitra table
                    $query_mitra = mysqli_query($koneksi, "SELECT * FROM tb_mitra");
                    while ($data_mitra = mysqli_fetch_array($query_mitra)) {
                        // Select the current mitra for edit
                        $selected = ($data_edit['mitra_id'] == $data_mitra['id_mitra']) ? 'selected' : '';
                        echo "<option value='{$data_mitra['id_mitra']}' $selected>{$data_mitra['instansi_mitra']}</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="jenis_dokumen">Jenis Dokumen</label>
            <select class="form-control" name="jenis_dokumen" id="jenis_dokumen" required>
                <option value="MOU" <?= $data_edit['jenis_dokumen'] == 'MOU' ? 'selected' : '' ?>>MOU</option>
                <option value="MOA" <?= $data_edit['jenis_dokumen'] == 'MOA' ? 'selected' : '' ?>>MOA</option>
                <option value="IA" <?= $data_edit['jenis_dokumen'] == 'IA' ? 'selected' : '' ?>>IA</option>
            </select>
        </div>
        <div class="form-group">
            <label for="jangka_waktu">Jangka Waktu</label>
            <input type="text" class="form-control" name="jangka_waktu" value="<?= $data_edit['jangka_waktu'] ?>"
                required>
        </div>
        <div class="form-group">
            <label for="awal_kerjasama">Awal Kerjasama</label>
            <input type="date" class="form-control" name="awal_kerjasama" value="<?= $data_edit['awal_kerjasama'] ?>"
                required>
        </div>
        <div class="form-group">
            <label for="akhir_kerjasama">Akhir Kerjasama</label>
            <input type="date" class="form-control" name="akhir_kerjasama" value="<?= $data_edit['akhir_kerjasama'] ?>"
                required>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label><br>
            <input type="radio" name="keterangan" value="Aktif"
                <?= $data_edit['keterangan'] == 'Aktif' ? 'checked' : '' ?> required> Aktif <br>
            <input type="radio" name="keterangan" value="Tidak Aktif"
                <?= $data_edit['keterangan'] == 'Tidak Aktif' ? 'checked' : '' ?> required> Tidak Aktif
        </div>
        <div class="form-group">
            <label for="bidang_usaha">Bidang Usaha</label>
            <input type="text" class="form-control" name="bidang_usaha" value="<?= $data_edit['bidang_usaha'] ?>"
                required>
        </div>
        <div class="form-group">
            <label for="jurusan_terkait">Jurusan Terkait</label>
            <select class="form-control" name="jurusan_terkait" required>
                <option value="">-- Pilih Jurusan Terkait --</option>
                <option value="Teknologi Informasi"
                    <?= $data_edit['jurusan_terkait'] == "Teknologi Informasi" ? 'selected' : '' ?>>Teknologi Informasi
                </option>
                <option value="Teknik Mesin" <?= $data_edit['jurusan_terkait'] == "Teknik Mesin" ? 'selected' : '' ?>>
                    Teknik Mesin</option>
                <option value="Teknik Sipil" <?= $data_edit['jurusan_terkait'] == "Teknik Sipil" ? 'selected' : '' ?>>
                    Teknik Sipil</option>
                <option value="Teknik Elektro"
                    <?= $data_edit['jurusan_terkait'] == "Teknik Elektro" ? 'selected' : '' ?>>Teknik Elektro</option>
                <option value="Administrasi Niaga"
                    <?= $data_edit['jurusan_terkait'] == "Administrasi Niaga" ? 'selected' : '' ?>>Administrasi Niaga
                </option>
                <option value="Akuntansi" <?= $data_edit['jurusan_terkait'] == "Akuntansi" ? 'selected' : '' ?>>
                    Akuntansi</option>
                <option value="Bahasa Inggris"
                    <?= $data_edit['jurusan_terkait'] == "Bahasa Inggris" ? 'selected' : '' ?>>Bahasa Inggris</option>
                <option value="General" <?= $data_edit['jurusan_terkait'] == "General" ? 'selected' : '' ?>>General
                </option>

            </select>
        </div>
        <div class="form-group">
            <label for="topik_kerjasama">Topik Kerjasama</label>
            <input type="text" class="form-control" name="topik_kerjasama" value="<?= $data_edit['topik_kerjasama'] ?>"
                required>
        </div>
        <div class="form-group">
            <label for="link_dokumen">Upload Dokumen (Kosongkan jika tidak diubah)</label>
            <input type="file" class="form-control" name="link_dokumen" value="<?= $data_edit['link_dokumen'] ?>" accept=".pdf,.doc,.docx">
        </div>
        <button type="submit" class="btn btn-success" name="submit">Update</button>
        <a href="?page=tabelDokumen&aksi=list" class="btn btn-secondary">Batal</a>
    </form>
    <?php 
        break;
        endswitch;
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>