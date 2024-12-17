<?php
include 'koneksi.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    // ================= LIST DATA =================
    case 'list':
        ?>
        <h2>Data Gambar Dokumen</h2>
        <a href="?pageDokumenKegiatanaksi=tambah" class="btn btn-primary">Tambah Gambar</a>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Dokumen</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM tb_dokumen_kegiatan");
                $no = 1;
                while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['dokumen_id']; ?></td>
                        <td><img src="../uploads/kegiatan/<?= $data['gambar']; ?>" width="100" /></td>
                        <td>
                            <a href="?aksi=edit&id=<?= $data['id']; ?>">Edit</a> | 
                            <a href="?aksi=hapus&id=<?= $data['id']; ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        break;

    // ================= TAMBAH DATA =================
    case 'tambah':
        if (isset($_POST['simpan'])) {
            $dokumen_id = $_POST['dokumen_id'];

            // Upload Gambar
            $gambar = $_FILES['gambar']['name'];
            $tmp = $_FILES['gambar']['tmp_name'];
            move_uploaded_file($tmp, "uploads/" . $gambar);

            $query = "INSERT INTO tb_dokumen_kegiatan (dokumen_id, gambar) 
                      VALUES ('$dokumen_id', '$gambar')";
            mysqli_query($koneksi, $query);
            header("Location: dokumen_kegiatan.php");
        }
        ?>
        <h2>Tambah Gambar Dokumen</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>ID Dokumen:</label>
            <input type="text" name="dokumen_id" required><br><br>

            <label>Gambar:</label>
            <input type="file" name="gambar" required><br><br>

            <button type="submit" name="simpan">Simpan</button>
            <a href="dokumen_kegiatan.php">Kembali</a>
        </form>
        <?php
        break;

    // ================= EDIT DATA =================
    case 'edit':
        $id = $_GET['id'];
        $result = mysqli_query($koneksi, "SELECT * FROM tb_dokumen_kegiatan WHERE id = '$id'");
        $data = mysqli_fetch_array($result);

        if (isset($_POST['update'])) {
            $dokumen_id = $_POST['dokumen_id'];

            // Cek apakah user upload gambar baru
            if (!empty($_FILES['gambar']['name'])) {
                $gambar = $_FILES['gambar']['name'];
                $tmp = $_FILES['gambar']['tmp_name'];
                move_uploaded_file($tmp, "uploads/" . $gambar);
            } else {
                $gambar = $data['gambar'];
            }

            mysqli_query($koneksi, "UPDATE tb_dokumen_kegiatan 
                                    SET dokumen_id = '$dokumen_id', gambar = '$gambar' 
                                    WHERE id = '$id'");
            header("Location: dokumen_kegiatan.php");
        }
        ?>
        <h2>Edit Gambar Dokumen</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>ID Dokumen:</label>
            <input type="text" name="dokumen_id" value="<?= $data['dokumen_id']; ?>" required><br><br>

            <label>Gambar:</label>
            <input type="file" name="gambar"><br>
            <img src="uploads/<?= $data['gambar']; ?>" width="100"><br><br>

            <button type="submit" name="update">Update</button>
            <a href="dokumen_kegiatan.php">Kembali</a>
        </form>
        <?php
        break;

    // ================= HAPUS DATA =================
    case 'hapus':
        $id = $_GET['id'];

        // Hapus file gambar
        $result = mysqli_query($koneksi, "SELECT gambar FROM tb_dokumen_kegiatan WHERE id = '$id'");
        $data = mysqli_fetch_array($result);
        unlink("uploads/" . $data['gambar']);

        // Hapus data dari database
        mysqli_query($koneksi, "DELETE FROM tb_dokumen_kegiatan WHERE id = '$id'");
        header("Location: dokumen_kegiatan.php");
        break;
}
?>
