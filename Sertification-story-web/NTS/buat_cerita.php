<?php
require_once('class/cerita.php');
require_once('class/paragraf.php');
session_start();

$cerita = new Cerita();
$paragraf = new Paragraf();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan'])) {
    // Tombol "Simpan" telah diklik
    $idusers_pembuat_awal = $_SESSION['idusers'];
    $judul = $_POST['judul'];
    $isi_paragraf = $_POST['paragraf'];

    // Panggil metode untuk membuat judul cerita baru
    $cerita->buatCeritaBaru($idusers_pembuat_awal, $judul);

    // Set sesi judul cerita yang baru dibuat
    $_SESSION['judul_cerita'] = $judul;

    // Panggil metode untuk menyimpan paragraf baru
    $paragraf->buatParagraf($idusers_pembuat_awal, $cerita->getLastInsertId(), $isi_paragraf, date("Y-m-d H:i:s"));

    echo "Cerita dan paragraf berhasil disimpan.";
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Buat Cerita Baru</title>
    <style>
        .paragraf-input {
            width: 50%;
            height: 200px; 
        }
        .label-paragraf {
            vertical-align: top; /* Untuk membuat label sejajar dengan bagian atas textarea */
            display: inline-block;
            width: 80px; 

        }
        .label-judul {
            vertical-align: top; /* Untuk membuat label sejajar dengan bagian atas textarea */
            display: inline-block;
            width: 80px;
        }
        .tombol-simpan {
            vertical-align: top; /* Untuk membuat label sejajar dengan bagian atas textarea */
            display: inline-block;
            margin-left: 85px;/
        }

        .kembali {
            vertical-align: top; /* Untuk membuat label sejajar dengan bagian atas textarea */
            display: inline-block;
            margin-left: 85px;/
        }

    </style>
</head>
<body>
    <h1>Buat Cerita Baru</h1>
    <form method="post" action="buat_cerita.php">
        <label for="judul" class="label-judul">Judul Cerita</label>
        <input type="text" name="judul" id="judul" required> <br><br>
        
        <label for="paragraf" class="label-paragraf">Paragraf</label>
        <textarea class="paragraf-input" name="paragraf" id="paragraf" required></textarea> <br>
        
        <input type="submit" class="tombol-simpan" name="simpan" value="Simpan">
    </form>

    <p class="kembali"><a href="home.php">&lt;&lt; Kembali ke Halaman Awal</a></p>
</body>
</html>
