<?php
function cari_nilai($sql)
{
  $host     = "localhost";
  $username = "root";
  $password = "";
  $database = "penerimaan";
  $koneksi  = mysqli_connect($host, $username, $password, $database);

  if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
  }

  $hasil = mysqli_query($koneksi, $sql);

  if ($hasil && mysqli_num_rows($hasil) > 0) {
    $r = mysqli_fetch_array($hasil);
    return isset($r["nilai"]) ? $r["nilai"] : null;
  } else {
    return null; // Mengembalikan null jika query gagal atau data tidak ditemukan
  }
}
