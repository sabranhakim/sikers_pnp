<?php 
if (isset($_GET['proses']) && $_GET['proses'] == 'insert') {
    include '../koneksi.php';
    if (isset($_POST['submit'])) {
        // Ambil data dari form
        $no_dokumen = $_POST['no_dokumen'];
        $instansi_mitra = $_POST['instansi_mitra'];
        $jenis_dokumen = $_POST['jenis_dokumen'];
        $jangka_waktu = $_POST['jangka_waktu'];
        $awal_kerjasama = $_POST['awal_kerjasama'];
        $akhir_kerjasama = $_POST['akhir_kerjasama'];
        $keterangan = $_POST['keterangan'];
        $bidang_usaha = $_POST['bidang_usaha'];
        $jurusan_terkait = $_POST['jurusan_terkait'];
        $topik_kerjasama = $_POST['topik_kerjasama'];
        
        // Handle upload file
        $nama_file = $_FILES['link_dokumen']['name'];
        $tmp_file = $_FILES['link_dokumen']['tmp_name'];
        $upload_dir = "../uploads/documents";
        $upload_file = $upload_dir . basename($nama_file);

        if (move_uploaded_file($tmp_file, $upload_file)) {
            // Insert data ke database
            $stmt = $koneksi->prepare("INSERT INTO tb_dokumen (no_dokumen, instansi_mitra, jenis_dokumen, jangka_waktu, awal_kerjasama, akhir_kerjasama, keterangan, bidang_usaha, jurusan_terkait, topik_kerjasama, link_dokumen) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssssss", 
            $no_dokumen, 
            $instansi_mitra, 
            $jenis_dokumen, 
            $jangka_waktu, 
            $awal_kerjasama, 
            $akhir_kerjasama, 
            $keterangan, 
            $bidang_usaha, 
            $jurusan_terkait, 
            $topik_kerjasama, 
            $nama_file);

            if ($stmt->execute()) {
                echo "<script>window.location='../dashboard.php?page=tabelDokumen'</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Gagal mengupload dokumen');</script>";
        }
    }
} elseif (isset($_GET['proses']) && $_GET['proses'] == 'update') {
    include '../koneksi.php';
    if (isset($_POST['submit'])) {
        // Ambil data dari form
        $id_dokumen = $_POST['id_dokumen'];
        $no_dokumen = $_POST['no_dokumen'];
        $instansi_mitra = $_POST['instansi_mitra'];
        $jenis_dokumen = $_POST['jenis_dokumen'];
        $jangka_waktu = $_POST['jangka_waktu'];
        $awal_kerjasama = $_POST['awal_kerjasama'];
        $akhir_kerjasama = $_POST['akhir_kerjasama'];
        $keterangan = $_POST['keterangan'];
        $bidang_usaha = $_POST['bidang_usaha'];
        $jurusan_terkait = $_POST['jurusan_terkait'];
        $topik_kerjasama = $_POST['topik_kerjasama'];

        // Handle update file jika ada
        if (!empty($_FILES['link_dokumen']['name'])) {
            $nama_file = $_FILES['link_dokumen']['name'];
            $tmp_file = $_FILES['link_dokumen']['tmp_name'];
            $upload_dir = "../uploads/";
            $upload_file = $upload_dir . basename($nama_file);

            if (move_uploaded_file($tmp_file, $upload_file)) {
                $file_update = ", link_dokumen = '$nama_file'";
            } else {
                echo "<script>alert('Gagal mengupload dokumen');</script>";
                exit;
            }
        } else {
            $file_update = "";
        }

        // Update data ke database
        $sql = "UPDATE tb_dokumen SET 
                no_dokumen = '$no_dokumen',
                instansi_mitra = '$instansi_mitra',
                jenis_dokumen = '$jenis_dokumen',
                jangka_waktu = '$jangka_waktu',
                awal_kerjasama = '$awal_kerjasama',
                akhir_kerjasama = '$akhir_kerjasama',
                keterangan = '$keterangan',
                bidang_usaha = '$bidang_usaha',
                jurusan_terkait = '$jurusan_terkait',
                topik_kerjasama = '$topik_kerjasama'
                $file_update
                WHERE id_dokumen = '$id_dokumen'";
        
        if (mysqli_query($koneksi, $sql)) {
            echo "<script>window.location='../dashboard.php?page=tabelDokumen'</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data');</script>";
        }
    }
} elseif (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
    include '../koneksi.php';
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_dokumen WHERE id_dokumen = '$_GET[id_hapus]'") ;
    if ($hapus) {
        echo "<script>alert('Berhasil menghapus data');</script>";
        echo "<script>window.location='../dashboard.php?page=tabelDokumen'</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}  
?>
