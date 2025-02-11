<?php
require 'config.php'; // Pastikan koneksi database benar

header('Content-Type: application/json');

if (!isset($_GET['id_pelamar'])) {
    echo json_encode(["error" => "id_pelamar tidak ditemukan"]);
    exit;
}

$id_pelamar = intval($_GET['id_pelamar']);

$query = "SELECT pm_sample.value, pm_faktor.faktor, pm_aspek.aspek 
          FROM pm_sample 
          JOIN pm_faktor ON pm_sample.id_faktor = pm_faktor.id_faktor 
          JOIN pm_aspek ON pm_faktor.id_aspek = pm_aspek.id_aspek
          WHERE pm_sample.id_pelamar = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_pelamar);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
