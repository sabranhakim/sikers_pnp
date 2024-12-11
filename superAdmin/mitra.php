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
    <h2>Data Mitra</h2>
    <a href="?page=tabelMitra&aksi=input" class="btn mb-3 mt-3" style="background-color: #dc5902; color: white;"><i class="bi bi-plus-circle"></i> New</a>
    <div class="table-responsive col-12">
        <table id="tabel-mitra" class="table table-bordered table-hover caption-top text-center table-striped border-left-warning">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Instansi</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Provinsi</th>
                    <th>Kota</th>
                    <th>Website</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php 
            include ("../sikermaPNP/koneksi.php");

            $ambil = mysqli_query($koneksi,"SELECT * FROM tb_mitra");
            $no = 1;
            while($data_mitra = mysqli_fetch_array($ambil)) {
            ?>
                <tr>
                    <td><?= $no ?></td> 
                    <td><?= $data_mitra['instansi_mitra'] ?></td>
                    <td><?= $data_mitra['email_mitra'] ?></td>
                    <td><?= $data_mitra['notelp_mitra'] ?></td>
                    <td><?= $data_mitra['provinsi'] ?></td>
                    <td><?= $data_mitra['kota'] ?></td>
                    <td><?= $data_mitra['website'] ?></td>
                    <td class="text-nowrap"><?= $data_mitra['alamat_mitra'] ?></td>
                    <td class="text-nowrap">
                    <a href="?page=tabelMitra&aksi=edit&id_edit=<?= $data_mitra['id_mitra'] ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                    <a href="/superAdmin/proses_mitra.php?proses=delete&id_hapus=<?= $data_mitra['id_mitra'] ?>"
                        class="btn btn-danger" onclick="return confirm('Yakin menghapus data?')"><i class="bi bi-trash"></i></a>
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
    <h2>Tambah Data Mitra</h2>
    <form action="superAdmin/proses_mitra.php?proses=insert" method="POST">
        <div class="form-group">
            <input type="hidden" class="form-control" name="id_mitra" required>
        </div>
        <div class="form-group">
            <label for="instansi_mitra">Instansi</label>
            <input type="text" class="form-control" name="instansi_mitra" required>
        </div>
        <div class="form-group">
            <label for="email_mitra">Email</label>
            <input type="email" class="form-control" name="email_mitra" required>
        </div>
        <div class="form-group">
            <label for="notelp_mitra">No Telepon</label>
            <input type="text" class="form-control" name="notelp_mitra" required>
        </div>
        <div class="form-group">
            <label for="provinsi">Provinsi</label>
            <input type="text" class="form-control" name="provinsi" required>
        </div>
        <div class="form-group">
            <label for="kota">Kota</label>
            <input type="text" class="form-control" name="kota" required>
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" class="form-control" name="website">
        </div>
        <div class="form-group">
            <label for="alamat_mitra">Alamat</label>
            <textarea class="form-control" name="alamat_mitra" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
        <a href="?page=tabelMitra&aksi=list" class="btn btn-secondary">Batal</a>
    </form>

    <?php 
        break;
        case 'edit':
            include '../sikermaPNP/koneksi.php';
            $id_edit = $_GET['id_edit'];
            $query_edit = mysqli_query($koneksi, "SELECT * FROM tb_mitra WHERE id_mitra = '$id_edit'");
            $data_edit = mysqli_fetch_array($query_edit);
    ?>

    <h2>Edit Data Mitra</h2>
    <form action="superAdmin/proses_mitra.php?proses=update" method="POST">
        <input type="hidden" name="id_mitra" value="<?= $data_edit['id_mitra'] ?>">
        <div class="form-group">
            <label for="instansi_mitra">Instansi</label>
            <input type="text" class="form-control" name="instansi_mitra" value="<?= $data_edit['instansi_mitra'] ?>"
                required>
        </div>
        <div class="form-group">
            <label for="email_mitra">Email</label>
            <input type="email" class="form-control" name="email_mitra" value="<?= $data_edit['email_mitra'] ?>"
                required>
        </div>
        <div class="form-group">
            <label for="notelp_mitra">No Telepon</label>
            <input type="text" class="form-control" name="notelp_mitra" value="<?= $data_edit['notelp_mitra'] ?>"
                required>
        </div>
        <div class="form-group">
            <label for="provinsi">Provinsi</label>
            <input type="text" class="form-control" name="provinsi" value="<?= $data_edit['provinsi'] ?>" required>
        </div>
        <div class="form-group">
            <label for="kota">Kota</label>
            <input type="text" class="form-control" name="kota" value="<?= $data_edit['kota'] ?>" required>
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" class="form-control" name="website" value="<?= $data_edit['website'] ?>">
        </div>
        <div class="form-group">
            <label for="alamat_mitra">Alamat</label>
            <textarea class="form-control" name="alamat_mitra" rows="3"
                required><?= $data_edit['alamat_mitra'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-success" name="submit">Update</button>
        <a href="?page=tabelMitra&aksi=list" class="btn btn-secondary">Batal</a>
    </form>

    <?php 
        break;
        endswitch;
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>