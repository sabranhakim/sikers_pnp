<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<!-- Content -->
<?php
    $aksi = isset($_GET["aksi"]) ? $_GET["aksi"] : 'list';

    switch ($aksi) :
        case 'list':
?>
<h2>Data Users</h2>
<a href="?page=tabelUsers&aksi=input" class="btn btn-primary mb-3 mt-3"><i class="bi bi-plus-circle"></i> New</a>
<div class="table-responsive col-12">
    <table id="tabel-users" class="table table-bordered table-striped border-left-warning">
        <thead>
            <tr>
                <th>No</th>
                <th>Usernamee</th>
                <th>Email</th>
                <th>Password</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php 
                include ("../sikermaPNP/koneksi.php");

                $ambil = mysqli_query($koneksi,"SELECT * FROM tb_users");
                $no = 1;
                while($data_users = mysqli_fetch_array($ambil)) {
            ?>
            <tr>
                <td><?= $no ?></td> 
                <td><?= $data_users['username'] ?></td>
                <td><?= $data_users['email'] ?></td>
                <td><?= $data_users['password'] ?></td>
                <td><?= $data_users['level'] ?></td>
                <td class="text-nowrap">
                    <!-- Button to Open Edit Modal -->
                    <a href="?page=tabelUsers&aksi=edit&id_edit=<?= $data_users['id'] ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                    <!-- Button to Delete -->
                    <a href="/superAdmin/proses_users.php?proses=delete&id_hapus=<?= $data_users['id'] ?>"
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

<h2>Tambah User</h2>
<form action="superAdmin/proses_users.php?proses=insert" method="POST">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="level">Level</label>
        <select class="form-control" id="level" name="level" required>
            <option value="">-- Pilih Level --</option>
            <option value="superAdmin">Super Admin</option>
            <option value="admin">Admin</option>
            <option value="jurusan">Jurusan</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
    <a href="?page=tabelUsers&aksi=list" class="btn btn-secondary">Batal</a>
</form>

<?php 
    break;
    case 'edit':
        include '../sikermaPNP/koneksi.php';
        $id_edit = $_GET['id_edit'];
        $query_edit = mysqli_query($koneksi, "SELECT * FROM tb_users WHERE id = '$id_edit'");
        $data_edit = mysqli_fetch_array($query_edit);
?>

<h2>Edit User</h2>
<form action="superAdmin/proses_users.php?proses=update" method="POST">
    <input type="hidden" name="id" value="<?= $data_edit['id'] ?>">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?= $data_edit['username'] ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $data_edit['email'] ?>" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" value="<?= $data_edit['password'] ?>" required>
    </div>
    <div class="form-group">
        <label for="level">Level</label>
        <select class="form-control" id="level" name="level" required>
            <option value="superAdmin" <?= ($data_edit['level'] == 'superAdmin') ? 'selected' : '' ?>>Super Admin</option>
            <option value="admin" <?= ($data_edit['level'] == 'admin') ? 'selected' : '' ?>>Admin</option>
            <option value="jurusan" <?= ($data_edit['level'] == 'jurusan') ? 'selected' : '' ?>>Jurusan</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success" name="submit">Update</button>
    <a href="?page=tabelUsers&aksi=list" class="btn btn-secondary">Batal</a>
</form>

<?php 
    break;
    endswitch;
?>