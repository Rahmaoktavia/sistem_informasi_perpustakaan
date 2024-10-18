<?php 

    $host = "localhost";
    $username = "root";
    $password = "";
    $nama_database = "db_perpustakaan";

    $db = new mysqli($host, $username, $password, $nama_database);

    if ($db->connect_error) {
        die("Koneksi Gagal! ".$db->connect_error);
    }