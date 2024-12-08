<?php 
   if (isset($_GET['proses']) && $_GET['proses'] == 'insert') {
    include '../koneksi.php';
    if (isset($_POST['submit'])) {
        // Ambil data dari form
        $nama_instansi = $_POST['nama_instansi'];
        $alamat = $_POST['alamat'];
        $nama_pejabat_penanda_tangan = $_POST['nama_pejabat_penanda_tangan'];
        $nama_jabatan = $_POST['nama_jabatan'];
        $no_kontak = $_POST['no_kontak'];
        $alamat_email = $_POST['alamat_email'];

        // Handle upload file
        $nama_file = $_FILES['upload_dokumen']['name'];
        $tmp_file = $_FILES['upload_dokumen']['tmp_name'];
        $upload_dir = "../uploads/usulan";
        $upload_file = $upload_dir . basename($nama_file);

        if (move_uploaded_file($tmp_file, $upload_file)) {
            // Insert data ke database
            $stmt = $koneksi->prepare("INSERT INTO tb_usulan (nama_instansi, alamat, nama_pejabat_penanda_tangan, nama_jabatan, no_kontak, alamat_email, upload_dokumen) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", 
            $nama_instansi, 
            $alamat, 
            $nama_pejabat_penanda_tangan, 
            $nama_jabatan, 
            $no_kontak, 
            $alamat_email,  
            $nama_file);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Data berhasil disimpan!');
                        document.location.href = '../index.php'; // Ganti dengan URL yang sesuai
                    </script>";

            } else {
                echo "<script>alert('Gagal menyimpan data');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Gagal mengupload Usulan');</script>";
        }
    }
} else if (isset($_GET['proses']) && $_GET['proses'] == 'update') {
    include '../koneksi.php';
    if (isset($_POST['submit'])) {
        // Ambil data dari form
        $id_usulan = $_POST['id_usulan'];
        $nama_instansi = $_POST['nama_instansi'];
        $alamat = $_POST['alamat'];
        $nama_pejabat_penanda_tangan = $_POST['nama_pejabat_penanda_tangan'];
        $nama_jabatan = $_POST['nama_jabatan'];
        $no_kontak = $_POST['no_kontak'];
        $alamat_email = $_POST['alamat_email'];

        // Handle upload file jika ada
        if ($_FILES['upload_dokumen']['name']) {
            $nama_file = $_FILES['upload_dokumen']['name'];
            $tmp_file = $_FILES['upload_dokumen']['tmp_name'];
            $upload_dir = "../uploads/usulan";
            $upload_file = $upload_dir . basename($nama_file);

            if (move_uploaded_file($tmp_file, $upload_file)) {
                // Update data dengan file baru
                $stmt = $koneksi->prepare("UPDATE tb_usulan SET 
                    nama_instansi = ?, 
                    alamat = ?, 
                    nama_pejabat_penanda_tangan = ?, 
                    nama_jabatan = ?, 
                    no_kontak = ?, 
                    alamat_email = ?, 
                    upload_dokumen = ? 
                    WHERE id_usulan = ?");
                $stmt->bind_param("sssssssi", 
                    $nama_instansi, 
                    $alamat, 
                    $nama_pejabat_penanda_tangan, 
                    $nama_jabatan, 
                    $no_kontak, 
                    $alamat_email, 
                    $nama_file, 
                    $id_usulan);

                if ($stmt->execute()) {
                    echo "<script>window.location='../index.php'</script>";
                } else {
                    echo "<script>alert('Gagal memperbarui data');</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Gagal mengupload dokumen baru');</script>";
            }
        } else {
            // Update tanpa file (jika tidak ada file baru)
            $stmt = $koneksi->prepare("UPDATE tb_usulan SET 
                nama_instansi = ?, 
                alamat = ?, 
                nama_pejabat_penanda_tangan = ?, 
                nama_jabatan = ?, 
                no_kontak = ?, 
                alamat_email = ? 
                WHERE id_usulan = ?");
            $stmt->bind_param("ssssssi", 
                $nama_instansi, 
                $alamat, 
                $nama_pejabat_penanda_tangan, 
                $nama_jabatan, 
                $no_kontak, 
                $alamat_email, 
                $id_usulan);

            if ($stmt->execute()) {
                echo "<script>window.location='../dashboard.php?page=tabelUsulan'</script>";
            } else {
                echo "<script>alert('Gagal memperbarui data');</script>";
            }
            $stmt->close();
        }
    }
} elseif (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
    include '../koneksi.php';
        $hapus = mysqli_query($koneksi, "DELETE FROM tb_usulan WHERE id_usulan = '$_GET[id_hapus]'") ;
        if ($hapus) {
            echo "<script>alert('Berhasil menghapus data');</script>";
            echo "<script>window.location='../dashboard.php?page=tabelUsulan'</script>";
        } else{
            echo "<script>alert('Gagal menghapus data');</script>";
        }
}  
?>
