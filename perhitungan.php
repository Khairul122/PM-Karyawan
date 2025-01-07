<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "penerimaan");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function get_data($query, $koneksi) {
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
                <th>Nama Pelamar</th>
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
                <th>Nama Pelamar</th>
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
                <th>Nama Pelamar</th>
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
                <th>Nama Pelamar</th>
                <th>Nilai Total</th>
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
                $ranking[] = [
                    'nama_pelamar' => $p['nama_pelamar'],
                    'nilai_total' => round($total, 2)
                ];
            }

            usort($ranking, function ($a, $b) {
                return $b['nilai_total'] <=> $a['nilai_total'];
            });

            foreach ($ranking as $rank => $r): ?>
                <tr>
                    <td><?= $rank + 1 ?></td>
                    <td><?= $r['nama_pelamar'] ?></td>
                    <td><?= $r['nilai_total'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
