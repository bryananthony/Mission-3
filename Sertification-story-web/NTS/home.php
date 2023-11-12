<?php
require_once('class/cerita.php');
session_start();

$cerita = new Cerita();

// Tentukan jumlah cerita yang ditampilkan per halaman
$ceritaPerHalaman = 3;

// Hitung jumlah cerita yang tersedia
$jumlahCerita = count($cerita->ambilDaftarCerita());

// Tentukan halaman saat ini
$halamanSaatIni = isset($_GET['page']) ? $_GET['page'] : 1;

// Hitung indeks awal dan akhir cerita yang akan ditampilkan
$indeksAwal = ($halamanSaatIni - 1) * $ceritaPerHalaman;
$indeksAkhir = $indeksAwal + $ceritaPerHalaman;

// Ambil daftar cerita berdasarkan halaman saat ini
if (isset($_POST['cari_cerita']) && isset($_POST['keyword'])) {
    // Tombol "Cari" telah diklik
    $keyword = $_POST['keyword'];
    $hasil_pencarian = $cerita->cariJudulCerita($keyword);
    $jumlahHalaman = 1; // Hanya ada satu halaman hasil pencarian
} else {
    // Tidak ada hasil pencarian, ambil semua cerita
    $daftar_cerita = array_slice($cerita->ambilDaftarCerita(), $indeksAwal, $ceritaPerHalaman);
    $jumlahHalaman = ceil($jumlahCerita / $ceritaPerHalaman);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th {
            background-color: lightgray;
        }

        .pagination {
            text-align: left;
            margin-top: 10px;
        }

        .pagination a {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ccc;
            margin: 0 4px;
        }
    </style>
</head>
<body>
    <form method="post" action="home.php">
        <label for="keyword">Cari Judul</label>
        <input type="text" name="keyword" id="keyword" required>
        <input type="submit" name="cari_cerita" value="Cari"> <br> <br>
    </form>
    <form method="post" action="buat_cerita.php">
        <input type="submit" name="buat_cerita" value="Buat Cerita Baru">
    </form>
    <h1>Daftar Cerita</h1>
    <table>
        <tr>
            <th>Judul</th>
            <th>Pembuat Awal</th>
            <th>Aksi</th>
        </tr>
        <!-- Loop untuk menampilkan daftar cerita -->
        <?php
        if (isset($hasil_pencarian)) {
            foreach ($hasil_pencarian as $cerita) {
                echo "<tr>";
                echo "<td>" . $cerita['judul'] . "</td>";
                echo "<td>" . $cerita['pembuat_awal'] . "</td>";
                echo "<td><a href='lihat_cerita.php?id=" . $cerita['idcerita'] . "'>Lihat Cerita</a></td>";
                echo "</tr>";
            }
        } elseif (isset($daftar_cerita)) {
            foreach ($daftar_cerita as $cerita) {
                echo "<tr>";
                echo "<td>" . $cerita['judul'] . "</td>";
                echo "<td>" . $cerita['pembuat_awal'] . "</td>";
                echo "<td><a href='lihat_cerita.php?id=" . $cerita['idcerita'] . "'>Lihat Cerita</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada hasil yang sesuai.</td></tr>";
        }
        ?>
        <!-- Akhir loop -->
    </table>
    <!-- Tampilkan paginasi hanya jika ada lebih dari satu halaman -->
    <?php
    if ($jumlahHalaman > 1) {
        echo "<div class='pagination'>";
        for ($i = 1; $i <= $jumlahHalaman; $i++) {
            echo "<a href='home.php?page=$i'>$i</a>";
        }
        echo "</div>";
    }
    ?>
</body>
</html>
