<?php
include 'config.php';

// Jika tombol submit diklik
if (isset($_REQUEST['Simpan'])) {
  if (isset($_POST['aspek']) && $_POST['aspek'] != "") {
    $id_aspek = $_POST['aspek'];

    // Hapus data lama berdasarkan faktor dari aspek yang dipilih
    $queryFaktor = "SELECT id_faktor FROM pm_faktor WHERE id_aspek = $id_aspek";
    $resultFaktor = mysqli_query($koneksi, $queryFaktor);
    $id_faktor_list = [];
    while ($rowFaktor = mysqli_fetch_assoc($resultFaktor)) {
      $id_faktor_list[] = $rowFaktor['id_faktor'];
    }
    $id_faktor_imploded = implode(",", $id_faktor_list);

    $sql_truncate = mysqli_query($koneksi, "DELETE FROM pm_sample WHERE id_faktor IN ($id_faktor_imploded)");
    if (!$sql_truncate) {
      die("Error DELETE: " . mysqli_error($koneksi));
    }

    // Masukkan data baru ke dalam pm_sample
    $queryPelamar = "SELECT id_pelamar FROM master_pelamar";
    $resultPelamar = mysqli_query($koneksi, $queryPelamar);
    if (mysqli_num_rows($resultPelamar) > 0) {
      while ($rowPelamar = mysqli_fetch_assoc($resultPelamar)) {
        $id_pelamar = $rowPelamar['id_pelamar'];

        // Loop faktor yang sesuai dengan aspek
        $queryFaktor = "SELECT id_faktor FROM pm_faktor WHERE id_aspek = $id_aspek";
        $resultFaktor = mysqli_query($koneksi, $queryFaktor);
        while ($rowFaktor = mysqli_fetch_assoc($resultFaktor)) {
          $id_faktor = $rowFaktor['id_faktor'];
          $value = isset($_REQUEST[$id_pelamar . '_' . $id_faktor]) ? $_REQUEST[$id_pelamar . '_' . $id_faktor] : 0;

          // Insert data ke pm_sample tanpa menyebutkan kolom id_sample
          $queryInsert = "INSERT INTO pm_sample (id_pelamar, id_faktor, value) VALUES ('$id_pelamar', '$id_faktor', '$value')";
          $sqlInsert = mysqli_query($koneksi, $queryInsert);
          if (!$sqlInsert) {
            die("Error INSERT: " . mysqli_error($koneksi));
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
                    echo '<td>';
                    echo '<select class="custom-select d-block w-100" name="' . $rowPelamar['id_pelamar'] . '_' . $rowFaktorDetail['id_faktor'] . '">';
                    echo '<option value="1">1 - Kurang</option>';
                    echo '<option value="2">2 - Cukup</option>';
                    echo '<option value="3">3 - Baik</option>';
                    echo '<option value="4">4 - Sangat Baik</option>';
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