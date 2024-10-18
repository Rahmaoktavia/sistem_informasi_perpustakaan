<?php 

// Ambil ID anggota terakhir dari database
$query = "SELECT * FROM anggota ORDER BY id_anggota DESC LIMIT 1";
$result = $db->query($query);

if ($result->num_rows > 0) {
    $last_anggota = $result->fetch_assoc();
    $last_id = $last_anggota['id_anggota'] ?? '';

    // Tingkatkan ID
    $next_id = incrementId($last_id);
} else {
    // Jika tidak ada anggota, maka ID baru dimulai dari 1
    $next_id = 1;
}

// Format ID sesuai kebutuhan (contoh: PNP-000002)
$formatted_next_id = 'PNP-' . str_pad($next_id, 6, '0', STR_PAD_LEFT);

//menyimpan query select untuk memeriksa keberadaan nim
$check_query = "SELECT * FROM anggota WHERE nim='$nim'";
$check_result = $db->query($check_query);