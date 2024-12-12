<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<style>
    .custome-active {
        background-color: #FFD1B3;
    }
</style>

<!-- content -->
<div class="container-fluid">
    <?php 
        $aksi = isset($_GET["aksi"]) ? $_GET["aksi"] : 'list';

        switch ($aksi) :
            case 'list':
    ?>
    <h2>Data kegiatan</h2>
    <a href="?page=tabelKegiatan&aksi=input" class="btn mb-3 mt-3" style="background-color: #dc5902; color: white;"><i
            class="bi bi-plus-circle"></i> New</a>
    <div class="table-responsive col-12">
        <table id="tabel-kegiatan"
            class="table table-bordered table-hover caption-top text-center table-striped border-left-warning">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Dokumen</th>
                    <th>Jenis Dokumen</th>
                    <th>Keterangan</th>
                    <th>Awal Kerjasama</th>
                    <th>Akhir Kerjasama</th>
                    <th>Deskripsi Kegiatan</th>
                    <th>Dokumentasi Kegiatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                include ("../sikermaPNP/koneksi.php");
                $ambil = mysqli_query($koneksi,"SELECT * FROM tb_kegiatan JOIN tb_dokumen ON tb_kegiatan.dokumen_id_dokumen = tb_dokumen.id_dokumen ;");
                $no = 1;
                while($data_kegiatan = mysqli_fetch_array($ambil)) {
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $data_kegiatan['no_dokumen']?></td>
                    <td><?= $data_kegiatan['jenis_dokumen']?></td>
                    <td><?= $data_kegiatan['keterangan']?></td>
                    <td><?= $data_kegiatan['awal_kerjasama']?></td>
                    <td><?= $data_kegiatan['akhir_kerjasama']?></td>
                    <td><?= $data_kegiatan['deskripsi_kegiatan'] ?></td>
                    <td><?= $data_kegiatan['dokumentasi'] ?></td>
                    
                    <td class="text-nowrap">
                        <a href="?page=tabelKegiatan&aksi=edit&id_edit=<?= $data_kegiatan['id_kegiatan'] ?>"
                            class="btn btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="/superAdmin/proses_kegiatan.php?proses=delete&id_hapus=<?= $data_kegiatan['id_kegiatan'] ?>"
                            class="btn btn-danger" onclick="return confirm('Yakin menghapus data?')">
                            <i class="bi bi-trash"></i>
                        </a>
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
    <h2>Tambah Data Kegiatan</h2>
    <form action="superAdmin/proses_kegiatan.php?proses=insert" method="POST" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="id_kegiatan">
        <div class="mb-3">
            <label for="no_dokumen" class="form-label">Nomor Dokumen</label>
            <select name="no_dokumen" id="no_dokumen" class="form-select" required>
                <option value="">--Pilih Instansi--</option>
                <?php 
                            include "koneksi.php";

                            $nomor = mysqli_query($koneksi, "SELECT * FROM tb_dokumen");
                            while($data_dokumen = mysqli_fetch_array($nomor)) {
                                echo "<option value=".$data_dokumen['id_dokumen'].">".$data_dokumen['no_dokumen']."</option>";
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
            </select>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label><br>
            <input type="radio" name="keterangan" value="Aktif" required> Aktif <br>
            <input type="radio" name="keterangan" value="Tidak Aktif" required> Tidak Aktif
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
            <label for="deskripsi_kegiatan">Deskripsi Kegiatan</label>
            <input type="text" class="form-control" name="deskripsi_kegiatan" required>
        </div>
        <div class="form-group">
            <label for="dokumentasi">Dokumentasi (png, jpg, jpeg)</label>
            <input type="file" class="form-control" name="dokumentasi[]" accept=".png,.jpg,.jpeg" multiple required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
        <a href="?page=tabelDokumen&aksi=list" class="btn btn-secondary">Batal</a>
    </form>

    <?php 
    break;
    case 'edit':
        include '../sikermaPNP/koneksi.php';
        $id_edit = $_GET['id_edit'];
        $query_edit = mysqli_query($koneksi, "SELECT * FROM tb_kegiatan WHERE id_kegiatan = '$id_edit'");
        $data_edit = mysqli_fetch_array($query_edit);
    ?>

<h2>Edit Data Kegiatan</h2>
<form action="superAdmin/proses_kegiatan.php?proses=update" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_kegiatan" value="<?= $data_edit['id_kegiatan'] ?>">
    <div class="form-group">
        <label for="deskripsi_kegiatan">Deskripsi Kegiatan</label>
        <input type="text" class="form-control" name="deskripsi_kegiatan" value="<?= $data_edit['deskripsi_kegiatan'] ?>" required>
    </div>
    <div class="form-group">
        <label for="dokumentasi">Dokumentasi (png, jpg, jpeg, dan bisa lebih dari satu)</label>
        <input type="file" class="form-control" name="dokumentasi[]" accept=".png,.jpg,.jpeg" multiple required>
    </div>
    <div class="form-group">
        <label for="dokumentasi_existing">Dokumentasi yang sudah ada:</label><br>
        <?php 
            $dokumentasi_files = explode(",", $data_edit['dokumentasi']); // Assuming your existing files are saved as comma-separated
            foreach ($dokumentasi_files as $file) {
                echo "<a href='../uploads/$file' target='_blank'>$file</a><br>";
            }
        ?>
    </div>
    <button type="submit" class="btn btn-success" name="submit">Update</button>
    <a href="?page=tabelKegiatan&aksi=list" class="btn btn-secondary">Batal</a>
</form>

    <?php 
        break;
        endswitch;
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>