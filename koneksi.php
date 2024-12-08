<?php 

$koneksi=mysqli_connect(hostname:'localhost', username:'root', password:'', database: 'sikerma_pnp');

if (!$koneksi) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}
?>