<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "penerimaan");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Jika tombol submit diklik
if (isset($_REQUEST['Simpan'])) {
    if (isset($_POST['aspek']) && $_POST['aspek'] != "") {
        $id_aspek = $_POST['aspek'];

        // Dapatkan daftar faktor untuk aspek yang dipilih
        $queryFaktor = "SELECT id_faktor FROM pm_faktor WHERE id_aspek = $id_aspek";
        $resultFaktor = mysqli_query($koneksi, $queryFaktor);
        $id_faktor_list = [];
        while ($rowFaktor = mysqli_fetch_assoc($resultFaktor)) {
            $id_faktor_list[] = $rowFaktor['id_faktor'];
        }

        // Masukkan atau update data baru ke dalam pm_sample
        $queryPelamar = "SELECT id_pelamar FROM master_pelamar";
        $resultPelamar = mysqli_query($koneksi, $queryPelamar);

        if (mysqli_num_rows($resultPelamar) > 0) {
            while ($rowPelamar = mysqli_fetch_assoc($resultPelamar)) {
                $id_pelamar = $rowPelamar['id_pelamar'];

                // Loop faktor yang sesuai dengan aspek
                foreach ($id_faktor_list as $id_faktor) {
                    $value = isset($_REQUEST[$id_pelamar . '_' . $id_faktor]) ? $_REQUEST[$id_pelamar . '_' . $id_faktor] : 0;

                    // Cek apakah data sudah ada
                    $queryCheck = "SELECT * FROM pm_sample WHERE id_pelamar = $id_pelamar AND id_faktor = $id_faktor";
                    $resultCheck = mysqli_query($koneksi, $queryCheck);

                    if (mysqli_num_rows($resultCheck) > 0) {
                        // Jika data sudah ada, lakukan update
                        $queryUpdate = "UPDATE pm_sample SET value = $value WHERE id_pelamar = $id_pelamar AND id_faktor = $id_faktor";
                        $sqlUpdate = mysqli_query($koneksi, $queryUpdate);
                        if (!$sqlUpdate) {
                            die("Error UPDATE: " . mysqli_error($koneksi));
                        }
                    } else {
                        // Jika data belum ada, lakukan insert
                        $queryInsert = "INSERT INTO pm_sample (id_pelamar, id_faktor, value) VALUES ($id_pelamar, $id_faktor, $value)";
                        $sqlInsert = mysqli_query($koneksi, $queryInsert);
                        if (!$sqlInsert) {
                            die("Error INSERT: " . mysqli_error($koneksi));
                        }
                    }
                }
            }
            echo "<script>alert('Data berhasil disimpan!');location='home.php?page=profile';</script>";
        } else {
            echo "<script>alert('Tidak ada data pelamar.');</script>";
        }
    } else {
        echo "<script>alert('Silakan pilih aspek terlebih dahulu.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Matching</title>
    <script src="js/jquery-1.12.4.min.js"></script>
</head>

<body>
    <form class="form-kecerdasan" method="post" action="" role="form">
        <div class="card mb-6 shadow-sm">
            <div class="card-header">
                <div class="col-6">
                    <label for="aspek">Pilih Aspek</label>
                    <select class="custom-select d-block w-50" id="aspek" name="aspek" required onchange="this.form.submit()">
                        <option value="">Pilih Aspek...</option>
                        <?php
                        // Query untuk mendapatkan aspek dari tabel pm_aspek
                        $queryAspek = "SELECT id_aspek, aspek FROM pm_aspek";
                        $resultAspek = mysqli_query($koneksi, $queryAspek);
                        while ($rowAspek = mysqli_fetch_assoc($resultAspek)) {
                            $selected = isset($_POST['aspek']) && $_POST['aspek'] == $rowAspek['id_aspek'] ? "selected" : "";
                            echo '<option value="' . $rowAspek['id_aspek'] . '" ' . $selected . '>' . $rowAspek['aspek'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Pelamar</th>
                                <?php
                                // Jika aspek dipilih, tampilkan faktor berdasarkan aspek
                                if (isset($_POST['aspek']) && $_POST['aspek'] != "") {
                                    $id_aspek = $_POST['aspek'];
                                    $queryFaktorHeader = "SELECT faktor FROM pm_faktor WHERE id_aspek = $id_aspek";
                                    $resultFaktorHeader = mysqli_query($koneksi, $queryFaktorHeader);
                                    while ($rowFaktorHeader = mysqli_fetch_assoc($resultFaktorHeader)) {
                                        echo '<th>' . $rowFaktorHeader['faktor'] . '</th>';
                                    }
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Jika aspek dipilih, tampilkan pelamar dan faktor dinamis
                            if (isset($_POST['aspek']) && $_POST['aspek'] != "") {
                                $queryPelamar = "SELECT id_pelamar, nama_pelamar FROM master_pelamar";
                                $resultPelamar = mysqli_query($koneksi, $queryPelamar);

                                while ($rowPelamar = mysqli_fetch_assoc($resultPelamar)) {
                                    echo '<tr>';
                                    echo '<td>' . $rowPelamar['nama_pelamar'] . '</td>';

                                    // Query untuk mendapatkan faktor berdasarkan aspek yang dipilih
                                    $queryFaktorDetail = "SELECT id_faktor FROM pm_faktor WHERE id_aspek = $id_aspek";
                                    $resultFaktorDetail = mysqli_query($koneksi, $queryFaktorDetail);

                                    while ($rowFaktorDetail = mysqli_fetch_assoc($resultFaktorDetail)) {
                                        $id_faktor = $rowFaktorDetail['id_faktor'];

                                        // Ambil nilai sebelumnya dari tabel pm_sample jika ada
                                        $queryValue = "SELECT value FROM pm_sample WHERE id_pelamar = " . $rowPelamar['id_pelamar'] . " AND id_faktor = $id_faktor";
                                        $resultValue = mysqli_query($koneksi, $queryValue);
                                        $rowValue = mysqli_fetch_assoc($resultValue);
                                        $selectedValue = isset($rowValue['value']) ? $rowValue['value'] : 1;

                                        echo '<td>';
                                        echo '<select class="custom-select d-block w-100" name="' . $rowPelamar['id_pelamar'] . '_' . $id_faktor . '">';
                                        echo '<option value="1" ' . ($selectedValue == 1 ? 'selected' : '') . '>1 - Kurang</option>';
                                        echo '<option value="2" ' . ($selectedValue == 2 ? 'selected' : '') . '>2 - Cukup</option>';
                                        echo '<option value="3" ' . ($selectedValue == 3 ? 'selected' : '') . '>3 - Baik</option>';
                                        echo '<option value="4" ' . ($selectedValue == 4 ? 'selected' : '') . '>4 - Sangat Baik</option>';
                                        echo '</select>';
                                        echo '</td>';
                                    }
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5">Silakan pilih aspek untuk menampilkan data.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php if (isset($_POST['aspek']) && $_POST['aspek'] != ""): ?>
                        <button class="btn btn-success" type="submit" id="Simpan" name="Simpan">Simpan</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
