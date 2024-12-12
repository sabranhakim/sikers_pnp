<?php 
include '../koneksi.php';

// Proses Insert
if (isset($_GET['proses']) && $_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        // Ambil data dari form
        $deskripsi_kegiatan = $_POST['deskripsi_kegiatan'];

        // Handle upload file
        $nama_file = $_FILES['dokumentasi']['name'];
        $tmp_file = $_FILES['dokumentasi']['tmp_name'];
        $upload_dir = "../uploads/kegiatan/";
        $upload_file = $upload_dir . basename($nama_file);

        if (move_uploaded_file($tmp_file, $upload_file)) {
            // Insert data ke database
            $stmt = $koneksi->prepare("INSERT INTO tb_kegiatan (deskripsi_kegiatan, dokumentasi) VALUES (?, ?)");
            $stmt->bind_param("ss", $deskripsi_kegiatan, $nama_file);

            if ($stmt->execute()) {
                echo "<script>alert('Data berhasil disimpan');</script>";
                echo "<script>window.location='../dashboard.php?page=tabelKegiatan'</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Gagal mengupload dokumentasi');</script>";
        }
    }
} 

// Proses Update
else if (isset($_GET['proses']) && $_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        // Ambil data dari form
        $id_kegiatan = $_POST['id_kegiatan'];
        $deskripsi_kegiatan = $_POST['deskripsi_kegiatan'];

        // Handle upload file jika ada
        if ($_FILES['dokumentasi']['name']) {
            $nama_file = $_FILES['dokumentasi']['name'];
            $tmp_file = $_FILES['dokumentasi']['tmp_name'];
            $upload_dir = "../uploads/kegiatan/";
            $upload_file = $upload_dir . basename($nama_file);

            if (move_uploaded_file($tmp_file, $upload_file)) {
                // Update data dengan file baru
                $stmt = $koneksi->prepare("UPDATE tb_kegiatan SET deskripsi_kegiatan = ?, dokumentasi = ? WHERE id_kegiatan = ?");
                $stmt->bind_param("ssi", $deskripsi_kegiatan, $nama_file, $id_kegiatan);

                if ($stmt->execute()) {
                    echo "<script>alert('Data berhasil diperbarui');</script>";
                    echo "<script>window.location='../dashboard.php?page=tabelKegiatan'</script>";
                } else {
                    echo "<script>alert('Gagal memperbarui data');</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Gagal mengupload dokumentasi baru');</script>";
            }
        } else {
            // Update tanpa file baru
            $stmt = $koneksi->prepare("UPDATE tb_kegiatan SET deskripsi_kegiatan = ? WHERE id_kegiatan = ?");
            $stmt->bind_param("si", $deskripsi_kegiatan, $id_kegiatan);

            if ($stmt->execute()) {
                echo "<script>alert('Data berhasil diperbarui');</script>";
                echo "<script>window.location='../dashboard.php?page=tabelKegiatan'</script>";
            } else {
                echo "<script>alert('Gagal memperbarui data');</script>";
            }
            $stmt->close();
        }
    }
} 

// Proses Delete
elseif (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
    $id_hapus = $_GET['id_hapus'];
    $stmt = $koneksi->prepare("DELETE FROM tb_kegiatan WHERE id_kegiatan = ?");
    $stmt->bind_param("i", $id_hapus);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus');</script>";
        echo "<script>window.location='../dashboard.php?page=tabelKegiatan'</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
    $stmt->close();
}
?>
