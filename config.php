<?php
$db = mysqli_connect("localhost", "root", "", "penerimaan");
if ($host) {
  echo "Koneksi berhasil";
} else {
  echo "Koneksi gagal!" . mysqli_connect_error();
  die();
}
