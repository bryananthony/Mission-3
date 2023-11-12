<?php
session_start();
require_once('class/cerita.php');
$cerita = new Cerita();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan'])) {
    if (isset($_POST['simpan'])) {
        // Tombol "Simpan" telah diklik
        $idusers_pembuat_awal = $_SESSION['idusers'];
        $judul = $_POST['judul'];
        $isi_paragraf = $_POST['paragraf'];

        // Panggil metode untuk membuat judul cerita baru dan menyimpan paragraf
        if ($cerita->buatCeritaDanSimpanParagraf($idusers_pembuat_awal, $judul, $isi_paragraf)) {
            // Berhasil menyimpan, lakukan tindakan lain jika diperlukan
            // Anda bisa mengarahkan pengguna ke halaman lain atau menampilkan pesan sukses di sini
            echo "Cerita telah berhasil disimpan!";
        } else {
            // Gagal menyimpan, tindakan jika diperlukan
            echo "Gagal menyimpan cerita.";
        }
    }
}

?>
