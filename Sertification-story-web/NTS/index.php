<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login_proses.php" method="post">
        <label for="idusers">ID Pengguna:</label>
        <input type="text" name="idusers" id="idusers" required><br><br>

        <label for="password">Kata Sandi:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Login">
    </form>
    
    <p>Belum memiliki akun? <a href="registrasi.php">Daftar di sini</a></p>
</body>
</html>
