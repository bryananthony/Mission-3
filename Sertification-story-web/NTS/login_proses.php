<?php
require_once('class/users.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idusers = $_POST['idusers'];
    $password = $_POST['password'];

    $users = new Users();
    $idusers = $users->login($idusers, $password);

    if ($idusers) {
        session_start();
        $_SESSION['idusers'] = $idusers;
        header('Location: home.php');
        exit();
    } else {
        echo 'Login gagal. Silakan cek kembali ID Users dan kata sandi Anda.';
    }
}
?>
<!-- Tampilkan form login di sini -->
