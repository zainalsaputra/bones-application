<?php
require_once '../../config/index.php';

session_start();
if (isset($_SESSION['admin'])) {
    header('location: ../../../index.php');
}
if (isset($_SESSION['user'])) {
    header('location: ../../../index.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../../../assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login Form Using HTML And CSS Only</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container log-in-container">
            <form action="../../controller/landingpage/login.php" method="POST">
                <h1>Login</h1>
                <span>or use your account</span>
                <input type="text" name="email" placeholder="Username or Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <a href="register.php">Dont't have account? Register now</a>
                <button type="submit" name="login">Log In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>HTML CSS Login Form</h1>
                    <p>This login form is created using pure HTML and CSS. For social icons, FontAwesome is used.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_GET["salah"])) {
    echo "<script>alert('cek kembali username/email atau password anda!')</script>";
}
if (isset($_GET["berhasil"])) {
    echo "<script>alert('Login berhasil!')</script>";
}
if (isset($_GET["terdaftar"])) {
    echo "<script>alert('Akun sudah terdaftar, silahkan login kembali!')</script>";
}
?>