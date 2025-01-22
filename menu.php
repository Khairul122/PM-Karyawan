<?php
if( !empty( $_SESSION['id_user'] ) ){
    include "koneksi.php";

    // Ambil level pengguna dari database
    $id_user = $_SESSION['id_user'];
    $query = "SELECT level FROM master_user WHERE id_user = '$id_user'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
    $level = $data['level']; // Ambil level dari hasil query
?>
<style>
</style>
<!-- Fixed navbar -->
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <?php if ($level == 2) { ?>
              <li class="nav-item">
                    <a class="nav-link" href="home.php">
                        <span class="fas fa-home" style="font-size:14px"></span>
                        Home <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=perhitungan">
                        <span class="fas fa-archive" style="font-size:14px"></span>
                        Hasil Perhitungan
                    </a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="home.php">
                        <span class="fas fa-home" style="font-size:14px"></span>
                        Home <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=pelamar">
                        <span class="fas fa-user-friends" style="font-size:14px"></span>
                        Data Karyawan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=aspek">
                        <span class="fas fa-file" style="font-size:14px"></span>
                        Aspek Penilaian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=kriteria">
                        <span class="fas fa-copy" style="font-size:14px"></span>
                        Kriteria Penilaian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=profile">
                        <span class="fas fa-sync-alt" style="font-size:14px"></span>
                        Proses Profile Matching
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=perhitungan">
                        <span class="fas fa-archive" style="font-size:14px"></span>
                        Hasil Perhitungan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=gantipassword">
                        <span class="fas fa-lock" style="font-size:14px "></span>
                        Ganti Password
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>
<?php
} else {
    header("Location: ./");
    die();
}
?>
