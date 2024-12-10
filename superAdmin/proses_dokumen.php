<?php 
include '../koneksi.php';

// Proses Insert
if (isset($_GET['proses']) && $_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        // Ambil data dari form
        $no_dokumen = $_POST['no_dokumen'];
        $jenis_dokumen = $_POST['jenis_dokumen'];
        $jangka_waktu = $_POST['jangka_waktu'];
        $awal_kerjasama = $_POST['awal_kerjasama'];
        $akhir_kerjasama = $_POST['akhir_kerjasama'];
        $keterangan = $_POST['keterangan'];
        $bidang_usaha = $_POST['bidang_usaha'];
        $jurusan_terkait = $_POST['jurusan_terkait'];
        $topik_kerjasama = $_POST['topik_kerjasama'];
        $mitra_id = $_POST['mitra_id'];

        // Handle upload file
        $nama_file = $_FILES['link_dokumen']['name'];
        $tmp_file = $_FILES['link_dokumen']['tmp_name'];
        $upload_dir = "../uploads/documents";
        $upload_file = $upload_dir . basename($nama_file);

        if (move_uploaded_file($tmp_file, $upload_file)) {
            // Prepare and bind
            $stmt = $koneksi->prepare("INSERT INTO tb_dokumen (no_dokumen, jenis_dokumen, jangka_waktu, awal_kerjasama, akhir_kerjasama, keterangan, bidang_usaha, jurusan_terkait, topik_kerjasama, link_dokumen, mitra_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssssi", 
                $no_dokumen, 
                $jenis_dokumen, 
                $jangka_waktu, 
                $awal_kerjasama, 
                $akhir_kerjasama, 
                $keterangan, 
                $bidang_usaha, 
                $jurusan_terkait, 
                $topik_kerjasama, 
                $nama_file, 
                $mitra_id
            );

            if ($stmt->execute()) {
                echo "<script>window.location='../dashboard.php?page=tabelDokumen'</script>";
                echo "<script>alert('Data berhasil disimpan');</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Gagal mengupload dokumen');</script>";
        }
    }
} else if (isset($_GET['proses']) && $_GET['proses'] == 'update') {
    include '../koneksi.php';
    if (isset($_POST['submit'])) {
        // Ambil data dari form
        $id_dokumen = $_POST['id_dokumen']; // ID dokumen yang akan diupdate
        $no_dokumen = $_POST['no_dokumen'];
        $jenis_dokumen = $_POST['jenis_dokumen'];
        $jangka_waktu = $_POST['jangka_waktu'];
        $awal_kerjasama = $_POST['awal_kerjasama'];
        $akhir_kerjasama = $_POST['akhir_kerjasama'];
        $keterangan = $_POST['keterangan'];
        $bidang_usaha = $_POST['bidang_usaha'];
        $jurusan_terkait = $_POST['jurusan_terkait'];
        $topik_kerjasama = $_POST['topik_kerjasama'];
        $mitra_id = $_POST['mitra_id'];
    
        // Handle upload file jika ada
        if ($_FILES['link_dokumen']['name']) {
            $nama_file = $_FILES['link_dokumen']['name'];
            $tmp_file = $_FILES['link_dokumen']['tmp_name'];
            $upload_dir = "../uploads/documents";
            $upload_file = $upload_dir . basename($nama_file);
    
            if (move_uploaded_file($tmp_file, $upload_file)) {
                // Update data dengan file baru
                $stmt = $koneksi->prepare("UPDATE tb_dokumen SET 
                    no_dokumen = ?, 
                    jenis_dokumen = ?, 
                    jangka_waktu = ?, 
                    awal_kerjasama = ?, 
                    akhir_kerjasama = ?, 
                    keterangan = ?, 
                    bidang_usaha = ?, 
                    jurusan_terkait = ?, 
                    topik_kerjasama = ?, 
                    link_dokumen = ?, 
                    mitra_id = ? 
                    WHERE id_dokumen = ?");
                $stmt->bind_param("ssssssssssii", 
                    $no_dokumen, 
                    $jenis_dokumen, 
                    $jangka_waktu, 
                    $awal_kerjasama, 
                    $akhir_kerjasama, 
                    $keterangan, 
                    $bidang_usaha, 
                    $jurusan_terkait, 
                    $topik_kerjasama, 
                    $nama_file, 
                    $mitra_id, 
                    $id_dokumen);
    
                if ($stmt->execute()) {
                    echo "<script>window.location='../dashboard.php?page=tabelDokumen'</script>";
                    echo "<script>alert('Data berhasil diperbarui');</script>";
                } else {
                    echo "<script>alert('Gagal memperbarui data');</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Gagal mengupload dokumen baru');</script>";
            }
        } else {
            // Update tanpa file (jika tidak ada file baru)
            $stmt = $koneksi->prepare("UPDATE tb_dokumen SET 
                no_dokumen = ?, 
                jenis_dokumen = ?, 
                jangka_waktu = ?, 
                awal_kerjasama = ?, 
                akhir_kerjasama = ?, 
                keterangan = ?, 
                bidang_usaha = ?, 
                jurusan_terkait = ?, 
                topik_kerjasama = ?, 
                mitra_id = ? 
                WHERE id_dokumen = ?");
            $stmt->bind_param("sssssssssii", 
                $no_dokumen, 
                $jenis_dokumen, 
                $jangka_waktu, 
                $awal_kerjasama, 
                $akhir_kerjasama, 
                $keterangan, 
                $bidang_usaha, 
                $jurusan_terkait, 
                $topik_kerjasama, 
                $mitra_id, 
                $id_dokumen);
    
            if ($stmt->execute()) {
                echo "<script>window.location='../dashboard.php?page=tabelDokumen'</script>";
                echo "<script>alert('Data berhasil diperbarui');</script>";
            } else {
                echo "<script>alert('Gagal memperbarui data');</script>";
            }
            $stmt->close();
        }
    }
} elseif (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
    $id_hapus = $_GET['id_hapus'];
    $stmt = $koneksi->prepare("DELETE FROM tb_dokumen WHERE id_dokumen = ?");
    $stmt->bind_param("i", $id_hapus);

    if ($stmt->execute()) {
        echo "<script>alert('Berhasil menghapus data');</script>";
        echo "<script>window.location='../dashboard.php?page=tabelDokumen'</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
    $stmt->close();
}
?>