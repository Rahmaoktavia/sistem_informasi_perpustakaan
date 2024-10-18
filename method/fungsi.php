<?php

function incrementId($last_id_transaksi)
{
    $last_number = (int)substr($last_id_transaksi, -6); // Ambil 6 digit terakhir
    $next_number = $last_number + 1;
    return $next_number;
}


