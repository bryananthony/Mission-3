<?php
require_once('class/cerita.php');
require_once('class/paragraf.php');
session_start();

$cerita = new Cerita();
$paragraf = new Paragraf();

// Ambil parameter "id" dari URL
if (isset($_GET['id'])) {
    $ceritaId = $_GET['id'];
    $ceritaDetails = $cerita->getById($ceritaId);

    if ($ceritaDetails) {
        $judul_cerita = $ceritaDetails['judul'];
    } else {
        echo "Cerita tidak ditemukan.";
    }
} else {
    echo "Parameter 'id' tidak ditemukan.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan_paragraf'])) {
    // Tombol "Simpan Paragraf" telah diklik
    $idusers = $_SESSION['idusers'];
    $isi_paragraf = $_POST['isi_paragraf'];

    if (isset($ceritaId)) {
        // Panggil metode untuk menyimpan paragraf baru dengan ID cerita yang sesuai
        $paragraf->buatParagraf($idusers, $ceritaId, $isi_paragraf, date("Y-m-d H:i:s"));
    } else {
        echo "Cerita tidak ditemukan.";
    }
}

$paragraf_cerita = $paragraf->ambilParagraf($judul_cerita);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lihat Cerita</title>
</head>
<body>
    <h1><?php echo $judul_cerita; ?></h1>

    <?php
    foreach ($paragraf_cerita as $paragraf) {
        echo "<p>" . $paragraf . "</p>";
    }
    ?>

    <br> <br> <br>
    <form method="post" action="lihat_cerita.php?id=<?php echo $ceritaId; ?>">
        <label for="isi_paragraf">Tambah Paragraf</label><br><br>
        <textarea name="isi_paragraf" rows="4" cols="50" required></textarea> <br> <br>
        <input type="submit" name="simpan_paragraf" value="Simpan">
    </form>

    <p><a href="home.php">&lt;&lt; Kembali ke Halaman Awal</a></p>
</body>
</html>
