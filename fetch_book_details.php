<?php
include 'koneksi.php';

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM books 
              INNER JOIN categories ON books.category_id = categories.id_kategori 
              INNER JOIN pengarang ON books.pengarang_id = pengarang.id_pengarang 
              INNER JOIN penerbit ON books.penerbit_id = penerbit.id_penerbit 
              WHERE books.judul LIKE '%$search%'
              ORDER BY books.kode_buku";

    $result = $db->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Output book details HTML
        echo "
            <table class='table'>
                <!-- Add rows for each book detail -->
                <tr>
                    <td width='250'>Kode Buku</td>
                    <td width='550'>" . $row['kode_buku'] . "</td>
                    <td rowspan='9' class='image'>
                        <img src='berkas/resized_" . $row['sampul'] . "' alt='Sampul Buku'
                            style='width: 100%; max-width: 200px;' />
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </table>
        ";
    } else {
        echo '<p>No results found.</p>';
    }
} else {
    echo '<p>Search parameter not provided.</p>';
}
?>
