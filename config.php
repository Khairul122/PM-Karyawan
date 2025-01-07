<?php
$db = mysqli_connect("localhost", "root", "", "penerimaan");
if ($host) {
} else {
  echo "Koneksi gagal!" . mysqli_connect_error();
  die();
}
