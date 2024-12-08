<?php 
    if (isset($_GET['proses']) && $_GET['proses'] == 'insert') {
        include '../koneksi.php';
        if(isset($_POST['submit'])) {
            // Ambil data dari form
            $instansi_mitra = $_POST['instansi_mitra'];
            $email_mitra = $_POST['email_mitra'];
            $notelp_mitra = $_POST['notelp_mitra'];
            $provinsi = $_POST['provinsi'];
            $kota = $_POST['kota'];
            $website = $_POST['website'];
            $alamat_mitra = $_POST['alamat_mitra'];
        
            // Insert data ke database termasuk foto
            $stmt = $koneksi->prepare("INSERT INTO tb_mitra (instansi_mitra, email_mitra, notelp_mitra, provinsi, kota, website, alamat_mitra) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $instansi_mitra, $email_mitra, $notelp_mitra, $provinsi, $kota, $website, $alamat_mitra);

            if ($stmt->execute()) {
                echo "<script>window.location='../dashboard.php?page=tabelMitra'</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data');</script>";
            }
            $stmt->close();

        }                                         
    } else if (isset($_GET['proses']) && $_GET['proses'] == 'update') {
        include '../koneksi.php';
        if(isset($_POST['submit'])) {
            // Ambil data dari form
            
            $id_mitra = $_POST['id_mitra'];
            $instansi_mitra = $_POST['instansi_mitra'];
            $email_mitra = $_POST['email_mitra'];
            $notelp_mitra = $_POST['notelp_mitra'];
            $provinsi = $_POST['provinsi'];
            $kota = $_POST['kota'];
            $website = $_POST['website'];
            $alamat_mitra = $_POST['alamat_mitra'];

            // Insert data ke database termasuk foto
            $sql = mysqli_query($koneksi, "UPDATE tb_mitra SET

                    instansi_mitra            ='$_POST[instansi_mitra]', 
                    email_mitra             ='$_POST[email_mitra]',
                    notelp_mitra        ='$_POST[notelp_mitra]',
                    provinsi           ='$_POST[provinsi]',
                    kota           ='$_POST[kota]',
                    website   ='$_POST[website]', 
                    alamat_mitra            ='$alamat_mitra' WHERE id_mitra='$_POST[id_mitra]'");

            if ($sql) {
                echo "<script>window.location='../dashboard.php?page=tabelMitra'</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data');</script>";
            }

        }
    } elseif (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
        include '../koneksi.php';
        $hapus = mysqli_query($koneksi, "DELETE FROM tb_mitra WHERE id_mitra = '$_GET[id_hapus]'") ;
        if ($hapus) {
            echo "<script>alert('Berhasil menghapus data');</script>";
            echo "<script>window.location='../dashboard.php?page=tabelMitra'</script>";
        } else{
            echo "<script>alert('Gagal menghapus data');</script>";
        }
    }  
?>