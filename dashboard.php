<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIKers PNP - Dashboard</title>
    <link href="img/PNP.png" rel="icon">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <!-- buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap5.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<style>
    .navbar-nav {
        background-color: #de6e24;
        color: white;
        font-weight: bold;
        border-radius: 0;
        transition: background-color 0.3s ease;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        /* Full height */
        width: 250px;
        overflow-y: auto;
        /* Enable scrolling for sidebar content */
    }

    .nav-item:hover {
        background-color: #dc5902;
    }

    #content-wrapper {
        margin-left: 225px;
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion text-center" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-text mx-3">SIKers PNP</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pages
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php?page=home"">
                <i class=" bi bi-graph-up"></i>
                    <span>Statistik</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <?php 
                if ($_SESSION['level'] == 'superAdmin' || $_SESSION['level'] == 'admin') :
            ?>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php?page=tabelMitra"">
                <i class=" bi bi-people-fill"></i>
                    <span>Mitra</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php?page=tabelDokumen"">
                <i class=" bi bi-file-earmark-text-fill"></i>
                    <span>Dokumen</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php?page=tabelUsulan"">
                <i class=" fas fa-handshake"></i>
                    <span>Usulan Kerjasama</span></a>
            </li>

            <?php 
                endif;
            ?>

            <?php 
                if ($_SESSION['level'] == 'superAdmin') :
            ?>
            <!-- Heading -->
            <div class="sidebar-heading">
                Control Users
            </div>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php?page=tabelUsers"">
                <i class=" bi bi-person-circle"></i>
                    <span>Tabel User</span></a>
            </li>
            <?php 
                endif
            ?>

            <?php 
                if ($_SESSION['level'] == 'jurusan') :
            ?>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php?page=tabelDokumenJurusan"">
                <i class=" fas fa-handshake"></i>
                    <span>Dokumen</span></a>
            </li>
            <?php 
                endif
            ?>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group" style="padding-left: 25px;">
                            <h5>Selamat Datang di Dashboard SIKers</h5>
                        </div>

                    </form>
                    <a href="logout.php" style="padding-right: 50px; text-decoration: none; color:#dc5902;"
                        onclick="return confirm('Apakah anda ingin Logout?')"><i class="bi bi-box-arrow-in-left"></i>
                        Logout</a>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="breadcrumb col-12">
                        <h6 style="padding-right: 10px;">Hello <b><?= $_SESSION['username'] ?></b>, </h6>
                        <h6>Level anda <b><?= $_SESSION['level'] ?></b></h6>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Content Column -->
                        <div class="">
                            <?php
                            if ($_SESSION['level'] == 'superAdmin') {
                                $page = isset($_GET['page']) ? $_GET['page'] : 'home';

                                if ($page == 'home') include "chart.php";
                                if ($page == 'tabelMitra') include "superAdmin/mitra.php";
                                if ($page == 'tabelDokumen') include "superAdmin/dokumen.php";
                                if ($page == 'tabelUsulan') include "superAdmin/usulan.php";
                                if ($page == 'tabelUsers') include "superAdmin/users.php";
                                //if ($page == 'tabelKegiatan') include "superAdmin/kegiatan.php";
                            } else if ($_SESSION['level'] == 'admin') {
                                $page = isset($_GET['page']) ? $_GET['page'] : 'home';

                                if ($page == 'home') include "chart.php";
                                if ($page == 'tabelMitra') include "SuperAdmin/mitra.php";
                                if ($page == 'tabelDokumen') include "superAdmin/dokumen.php";
                                if ($page == 'tabelUsulan') include "superAdmin/usulan.php";
                                ///if ($page == 'tabelKegiatan') include "superAdmin/kegiatan.php";
                            } else if ($_SESSION['level'] == 'jurusan') {
                                $page = isset($_GET['page']) ? $_GET['page'] : 'home';

                                if ($page == 'home') include "chart.php";
                                if ($page == 'tabelDokumenJurusan') include "jurusan/dokumen_jurusan.php";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <!-- Data Tables -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/vfs_fonts.min.js"></script>

    <script>
        new DataTable("#tabel-mitra", {
            layout: {
                topStart: {
                    buttons: [
                        'copy',
                        'excel',
                        {
                            extend: 'pdf',
                            text: 'PDF',
                            filename: 'data-mitra.pdf',
                            title: 'Data Mitra',
                            orientation: 'landscape',
                            pageSize: 'A4',
                            exportOptions: {
                                columns: ['0, 1, 2, 3, 4, 5, 6, 7, 8']
                            }
                        }
                    ]
                }
            }
        });
        new DataTable("#tabel-dokumen", {
            layout: {
                topStart: {
                    buttons: [
                        'copy',
                        'excel',
                        {
                            extend: 'pdf',
                            text: 'PDF',
                            filename: 'data-dokumen.pdf',
                            title: 'Data Dokumen',
                            orientation: 'landscape',
                            pageSize: 'A4',
                            exportOptions: {
                                columns: ['1, 2, 3, 4, 5']
                            }
                        }
                    ]
                }
            }
        });
        new DataTable("#tabel-usulan", {
            layout: {
                topStart: {
                    buttons: [
                        'copy',
                        'excel',
                        {
                            extend: 'pdf',
                            text: 'PDF',
                            filename: 'data-usulan-kerjasama.pdf',
                            title: 'Data Usulan Kerjasama',
                            orientation: 'landscape',
                            pageSize: 'A4',
                            exportOptions: {
                                columns: ['1, 2, 3, 4, 5, 6, 8']
                            }
                        },
                        {
                            extend: 'print',
                            text: 'Print',
                            exportOptions: {
                                columns: ['1, 2, 3, 4, 5, 6, 8']
                            }
                        }
                    ]
                }
            }
        });
        new DataTable("#tabel-users");
        new DataTable("#tabel-dokumen-jurusan", {
            layout: {
                topStart: {
                    buttons: [
                        'copy',
                        'excel',
                        {
                            extend: 'pdf',
                            text: 'PDF',
                            filename: 'data-dokumen.pdf',
                            title: 'Data Dokumen',
                            orientation: 'landscape',
                            pageSize: 'A4',
                            exportOptions: {
                                columns: ['1, 2, 3, 4, 5, 6, 7, 8, 9, 10']
                            }
                        },
                        {
                            extend: 'print',
                            text: 'Print',
                            exportOptions: {
                                columns: ['1, 2, 3, 4, 5, 6, 7, 8, 9, 10']
                            }
                        }
                    ]
                }
            }
        });
    </script>
</body>

</html>