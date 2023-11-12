<?php
require_once('class/users.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idusers = $_POST['idusers'];
    $nama = $_POST['nama']; // Tambahkan input nama
    $password = $_POST['password'];

    $user = new Users();
    if ($user->register($idusers, $nama, $password)) {
        header('Location: index.php'); // Redirect ke halaman login setelah registrasi berhasil
        exit();
    } else {
        echo 'Registrasi gagal. Id yang diregistrasi sama. Silakan coba lagi.';
    }
}

?>
<!-- Tampilkan form registrasi di sini -->
