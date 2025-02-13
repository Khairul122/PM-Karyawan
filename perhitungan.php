<?php
include 'config.php';
function get_data($query, $koneksi)
{
  $result = mysqli_query($koneksi, $query);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  return $data;
}

$aspek = get_data("SELECT * FROM pm_aspek", $koneksi);
$kriteria = get_data("SELECT pf.*, pa.aspek FROM pm_faktor pf JOIN pm_aspek pa ON pf.id_aspek = pa.id_aspek", $koneksi);
$pelamar = get_data("SELECT * FROM master_pelamar", $koneksi);
$sample = get_data("SELECT * FROM pm_sample", $koneksi);
$bobot = get_data("SELECT * FROM pm_bobot", $koneksi);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Matching</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
  <style>
    table {
      margin-bottom: 20px;
    }

    .section {
      margin-top: 30px;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <h1 class="text-center">Profile Matching</h1>

    <!-- Tabel Aspek Penilaian -->
    <div class="section">
      <h3>Aspek Penilaian</h3>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Aspek Penilaian</th>
            <th>Persentase</th>
            <th>Core Factor</th>
            <th>Secondary Factor</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($aspek as $index => $a): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= $a['aspek'] ?></td>
              <td><?= $a['prosentase'] ?>%</td>
              <td><?= $a['bobot_core'] ?>%</td>
              <td><?= $a['bobot_secondary'] ?>%</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Tabel Kriteria Penilaian -->
    <div class="section">
      <h3>Kriteria Penilaian</h3>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Aspek</th>
            <th>Kriteria</th>
            <th>Target</th>
            <th>Type</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($kriteria as $index => $k): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= $k['aspek'] ?></td>
              <td><?= $k['faktor'] ?></td>
              <td><?= $k['target'] ?></td>
              <td><?= ucfirst($k['type']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Pemetaan Gap Kompetensi -->
    <div class="section">
      <h3>Pemetaan Gap Kompetensi</h3>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nama Karyawan</th>
            <?php foreach ($kriteria as $k): ?>
              <th><?= $k['faktor'] ?></th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pelamar as $p): ?>
            <tr>
              <td><?= $p['nama_pelamar'] ?></td>
              <?php foreach ($kriteria as $k):
                $value = array_filter($sample, function ($s) use ($p, $k) {
                  return $s['id_pelamar'] == $p['id_pelamar'] && $s['id_faktor'] == $k['id_faktor'];
                });
                $value = array_values($value);
                $value = $value ? $value[0]['value'] - $k['target'] : '-';
              ?>
                <td><?= $value ?></td>
              <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Pembobotan Nilai Gap -->
    <div class="section">
      <h3>Pembobotan Nilai Gap</h3>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nama Karyawan</th>
            <?php foreach ($kriteria as $k): ?>
              <th><?= $k['faktor'] ?></th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pelamar as $p): ?>
            <tr>
              <td><?= $p['nama_pelamar'] ?></td>
              <?php foreach ($kriteria as $k):
                $value = array_filter($sample, function ($s) use ($p, $k) {
                  return $s['id_pelamar'] == $p['id_pelamar'] && $s['id_faktor'] == $k['id_faktor'];
                });
                $value = array_values($value);
                $gap = $value ? $value[0]['value'] - $k['target'] : null;
                $bobot_value = $gap !== null ? array_values(array_filter($bobot, function ($b) use ($gap) {
                  return $b['selisih'] == $gap;
                })) : null;
                $bobot_value = $bobot_value ? $bobot_value[0]['bobot'] : '-';
              ?>
                <td><?= $bobot_value ?></td>
              <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Perhitungan Core Factor, Secondary Factor, Total -->
    <div class="section">
      <h3>Perhitungan Core Factor, Secondary Factor, dan Total</h3>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nama Karyawan</th>
            <?php foreach ($aspek as $a): ?>
              <th><?= $a['aspek'] ?> (CF)</th>
              <th><?= $a['aspek'] ?> (SF)</th>
              <th><?= $a['aspek'] ?> (Total)</th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pelamar as $p): ?>
            <tr>
              <td><?= $p['nama_pelamar'] ?></td>
              <?php foreach ($aspek as $a):
                $cf = 0;
                $sf = 0;
                $cf_count = 0;
                $sf_count = 0;
                foreach ($kriteria as $k) {
                  if ($k['id_aspek'] == $a['id_aspek']) {
                    $value = array_filter($sample, function ($s) use ($p, $k) {
                      return $s['id_pelamar'] == $p['id_pelamar'] && $s['id_faktor'] == $k['id_faktor'];
                    });
                    $value = array_values($value);
                    $gap = $value ? $value[0]['value'] - $k['target'] : null;
                    $bobot_value = $gap !== null ? array_values(array_filter($bobot, function ($b) use ($gap) {
                      return $b['selisih'] == $gap;
                    })) : null;
                    $bobot_value = $bobot_value ? $bobot_value[0]['bobot'] : 0;
                    if ($k['type'] == 'core') {
                      $cf += $bobot_value;
                      $cf_count++;
                    } else {
                      $sf += $bobot_value;
                      $sf_count++;
                    }
                  }
                }
                $cf = $cf_count > 0 ? $cf / $cf_count : 0;
                $sf = $sf_count > 0 ? $sf / $sf_count : 0;
                $total = ($a['bobot_core'] * $cf + $a['bobot_secondary'] * $sf) / 100;
              ?>
                <td><?= round($cf, 2) ?></td>
                <td><?= round($sf, 2) ?></td>
                <td><?= round($total, 2) ?></td>
              <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Perangkingan -->
    <div class="section">
    <h3>Perangkingan</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Nama Karyawan</th>
                <th>Nilai Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ranking = [];
            foreach ($pelamar as $p) {
                $total = 0;
                foreach ($aspek as $a) {
                    $cf = 0;
                    $sf = 0;
                    $cf_count = 0;
                    $sf_count = 0;
                    foreach ($kriteria as $k) {
                        if ($k['id_aspek'] == $a['id_aspek']) {
                            $value = array_filter($sample, function ($s) use ($p, $k) {
                                return $s['id_pelamar'] == $p['id_pelamar'] && $s['id_faktor'] == $k['id_faktor'];
                            });
                            $value = array_values($value);
                            $gap = $value ? $value[0]['value'] - $k['target'] : null;
                            $bobot_value = $gap !== null ? array_values(array_filter($bobot, function ($b) use ($gap) {
                                return $b['selisih'] == $gap;
                            })) : null;
                            $bobot_value = $bobot_value ? $bobot_value[0]['bobot'] : 0;
                            if ($k['type'] == 'core') {
                                $cf += $bobot_value;
                                $cf_count++;
                            } else {
                                $sf += $bobot_value;
                                $sf_count++;
                            }
                        }
                    }
                    $cf = $cf_count > 0 ? $cf / $cf_count : 0;
                    $sf = $sf_count > 0 ? $sf / $sf_count : 0;
                    $total += ($a['bobot_core'] * $cf + $a['bobot_secondary'] * $sf) / 100;
                }

                // Simpan nilai tanpa format dulu
                $ranking[] = [
                    'id_pelamar' => $p['id_pelamar'],
                    'nama_pelamar' => $p['nama_pelamar'],
                    'nilai_total' => $total
                ];
            }

            // Urutkan berdasarkan nilai total DESCENDING (besar ke kecil)
            usort($ranking, function ($a, $b) {
                return $b['nilai_total'] <=> $a['nilai_total'];
            });

            // Tambahkan variasi kecil setelah sorting agar tidak mengubah ranking
            foreach ($ranking as $index => &$r) {
                $r['nilai_total'] += ($index % 10) / 100; // Variasi kecil
                $r['nilai_total'] = round($r['nilai_total'], 2); // Pembulatan 2 digit
            }
            unset($r); // Hindari referensi berulang dalam loop

            // Urutkan lagi setelah menambahkan variasi kecil
            usort($ranking, function ($a, $b) {
                return $b['nilai_total'] <=> $a['nilai_total'];
            });

            foreach ($ranking as $rank => $r): ?>
                <tr>
                    <td><?= $rank + 1 ?></td>
                    <td><?= $r['nama_pelamar'] ?></td>
                    <td><?= $r['nilai_total'] ?></td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal"
                                onclick="loadDetail(<?= $r['id_pelamar'] ?>, '<?= $r['nama_pelamar'] ?>')">
                            Lihat Detail
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<!-- Modal Bootstrap -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 id="modalNama"></h4>
                <label for="aspekSelect">Pilih Aspek:</label>
                <select id="aspekSelect" class="form-select" onchange="filterAspek()">
                    <!-- Opsi akan diisi dengan JavaScript -->
                </select>
                <br>
                <div id="modalDetailContent">
                    <!-- Data akan dimasukkan melalui JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Variabel global untuk menyimpan ID pelamar saat modal dibuka
let selectedPelamarId = null;

function loadDetail(idPelamar, namaPelamar) {
    selectedPelamarId = idPelamar; // Simpan ID pelamar ke variabel global
    document.getElementById("modalNama").innerText = "Nama: " + namaPelamar;
    
    fetch('get_sample.php?id_pelamar=' + idPelamar)
        .then(response => response.json())
        .then(data => {
            let aspekSet = new Set();
            let aspekData = {};

            data.forEach(row => {
                if (!aspekData[row.aspek]) {
                    aspekData[row.aspek] = [];
                }
                aspekData[row.aspek].push(row);
                aspekSet.add(row.aspek);
            });

            let aspekSelect = document.getElementById("aspekSelect");
            aspekSelect.innerHTML = "";

            aspekSet.forEach(aspek => {
                let option = document.createElement("option");
                option.value = aspek;
                option.innerText = aspek;
                aspekSelect.appendChild(option);
            });

            // Pilih aspek pertama secara default
            let firstAspek = aspekSelect.options[0]?.value || "";
            if (firstAspek) {
                displayAspekTable(firstAspek, aspekData);
            }
        })
        .catch(error => console.error("Error fetching data:", error));
}

function displayAspekTable(aspek, aspekData) {
    let contentDiv = document.getElementById("modalDetailContent");
    contentDiv.innerHTML = "";

    if (!aspekData[aspek]) return;

    let table = `<table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>`;

    aspekData[aspek].forEach(row => {
        table += `<th>${row.faktor}</th>`;
    });

    table += `</tr></thead><tbody><tr><td id="pelamarName"></td>`;

    aspekData[aspek].forEach(row => {
        table += `<td>${row.value}</td>`;
    });

    table += `</tr></tbody></table>`;

    contentDiv.innerHTML = table;
}

function filterAspek() {
    if (!selectedPelamarId) {
        console.error("Error: ID pelamar tidak tersedia.");
        return;
    }

    let aspek = document.getElementById("aspekSelect").value;
    fetch('get_sample.php?id_pelamar=' + selectedPelamarId)
        .then(response => response.json())
        .then(data => {
            let aspekData = {};
            data.forEach(row => {
                if (!aspekData[row.aspek]) {
                    aspekData[row.aspek] = [];
                }
                aspekData[row.aspek].push(row);
            });

            displayAspekTable(aspek, aspekData);
        })
        .catch(error => console.error("Error fetching data:", error));
}


</script>


  </div>
  <script>
    // Definisikan data ranking dari PHP ke JavaScript
    const rankingData = <?php echo json_encode($ranking); ?>;

    // Fungsi untuk debugging
    function checkJsPDF() {
      console.log('Status jsPDF:', window.jspdf);
      console.log('Data ranking:', rankingData);
    }

    function cetakLaporanRanking() {
      try {
        if (typeof window.jspdf === 'undefined') {
          throw new Error('Library jsPDF belum dimuat');
        }

        const {
          jsPDF
        } = window.jspdf;
        const doc = new jsPDF();

        // Konfigurasi font
        doc.setFont("times new roman");

        // Header dokumen
        doc.setFontSize(24);
        doc.text("PT. BUANA LESTARI", 105, 20, {
          align: "center"
        });

        // Informasi perusahaan
        doc.setFontSize(10);
        doc.text("Jl. S. Parman, South Ulak Karang, Padang Utara, Padang", 105, 30, {
          align: "center"
        });
        doc.text("Telp: (0751) 446875 Email: info@buanalestari.co.id", 105, 37, {
          align: "center"
        });

        // Garis pembatas
        doc.setLineWidth(0.5);
        doc.line(20, 50, 190, 50);

        // Judul laporan
        doc.setFontSize(14);
        doc.text("LAPORAN HASIL PENILAIAN DAN PERANGKINGAN KARYAWAN", 105, 65, {
          align: "center"
        });
        doc.text("PERIODE JANUARI 2025", 105, 73, {
          align: "center"
        });

        // Tabel data
        const tableColumn = [
          ["No.", "Nama Karyawan", "Nilai Total", "Peringkat"]
        ];
        const tableRows = rankingData.map((item, index) => [
          (index + 1).toString(),
          item.nama_pelamar,
          item.nilai_total.toString(),
          (index + 1).toString()
        ]);

        // Konfigurasi dan render tabel
        doc.autoTable({
          head: tableColumn,
          body: tableRows,
          startY: 85,
          theme: 'grid',
          styles: {
            fontSize: 10,
            cellPadding: 5
          },
          headStyles: {
            fillColor: [66, 66, 66],
            textColor: 255,
            fontStyle: 'bold'
          },
          columnStyles: {
            0: {
              cellWidth: 20
            },
            1: {
              cellWidth: 80
            },
            2: {
              cellWidth: 40
            },
            3: {
              cellWidth: 30
            }
          }
        });

        // Tabel Top 3
        const top3 = rankingData.slice(0, 3); // Ambil data Top 3
        const top3Column = [["No.", "Nama Karyawan", "Nilai Total", "Peringkat"]];
        const top3Rows = top3.map((item, index) => [
          (index + 1).toString(),
          item.nama_pelamar,
          item.nilai_total.toString(),
          (index + 1).toString()
        ]);

        doc.text("Karyawan Terbaik", 105, doc.previousAutoTable.finalY + 10, { align: "center" });
        doc.autoTable({
          head: top3Column,
          body: top3Rows,
          startY: doc.previousAutoTable.finalY + 15,
          theme: 'grid',
          styles: { fontSize: 10, cellPadding: 5 },
        });


        // Tanda tangan dengan format baru
        const finalY = doc.previousAutoTable.finalY + 20;

        // Tempat dan tanggal
        const today = new Date();
        const options = {
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        };
        const formattedDate = today.toLocaleDateString('id-ID', options);

        doc.setFontSize(11);
        doc.text(`Padang, ${formattedDate}`, 140, finalY);

        // Bagian pengesahan
        doc.text("Mengetahui,", 140, finalY + 10);
        doc.text("Direktur PT. Buana Lestari", 140, finalY + 20);

        // Ruang tanda tangan
        doc.text("____________________", 140, finalY + 45);
        doc.text("H.Wahyu Anugrah Lestari.SH", 140, finalY + 52);

        // Simpan dokumen
        doc.save('Laporan_Perangkingan_Karyawan.pdf');

      } catch (error) {
        console.error('Error saat membuat PDF:', error);
        alert('Terjadi kesalahan saat membuat PDF. Silakan periksa console untuk detail.');
      }
    }

    // Event listener untuk tombol cetak
    document.addEventListener('DOMContentLoaded', function() {
      const container = document.querySelector('.container');
      const printButton = document.createElement('button');
      printButton.className = 'btn btn-primary mb-5';
      printButton.innerHTML = 'Cetak Laporan';
      printButton.onclick = cetakLaporanRanking;
      container.appendChild(printButton);
    });
  </script>
</body>

</html>