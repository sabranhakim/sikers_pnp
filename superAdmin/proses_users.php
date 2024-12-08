<?php
    if (isset($_GET['proses']) && $_GET['proses'] == 'insert') {
        include '../koneksi.php';
        if (isset($_POST['submit'])) {
            // Ambil data dari form
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $level = $_POST['level'];

            // Insert data ke database tanpa hash pada password
            $stmt = $koneksi->prepare("INSERT INTO tb_users (username, email, password, level) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $password, $level);

            if ($stmt->execute()) {
                echo "<script>window.location='../dashboard.php?page=tabelUsers'</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data');</script>";
            }
            $stmt->close();
        }
    } else if (isset($_GET['proses']) && $_GET['proses'] == 'update') {
        include '../koneksi.php';
        if (isset($_POST['submit'])) {
            // Ambil data dari form
            $id = $_POST['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $level = $_POST['level'];

            // Jika password baru diinput, update dengan password baru
            if (!empty($password)) {
                // Update data dengan password baru
                $sql = $koneksi->prepare("UPDATE tb_users SET username = ?, email = ?, password = ?, level = ? WHERE id = ?");
                $sql->bind_param("ssssi", $username, $email, $password, $level, $id);
            } else {
                // Update data tanpa mengubah password
                $sql = $koneksi->prepare("UPDATE tb_users SET username = ?, email = ?, level = ? WHERE id = ?");
                $sql->bind_param("sssi", $username, $email, $level, $id);
            }

            if ($sql->execute()) {
                echo "<script>window.location='../dashboard.php?page=tabelUsers'</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data');</script>";
            }
            $sql->close();
        }
    } elseif (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
        include '../koneksi.php';
        $id_hapus = $_GET['id_hapus'];
        $hapus = mysqli_query($koneksi, "DELETE FROM tb_users WHERE id = '$id_hapus'");
        if ($hapus) {
            echo "<script>alert('Berhasil menghapus data');</script>";
            echo "<script>window.location='../dashboard.php?page=tabelUsers'</script>";
        } else {
            echo "<script>alert('Gagal menghapus data');</script>";
        }
    }
?>
