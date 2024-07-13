<?php
require_once '../../config/index.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $servername = "localhost";
    // $dbusername = "root"; // Ganti sesuai username database Anda
    // $dbpassword = ""; // Ganti sesuai password database Anda
    // $dbname = "register"; // Ganti dengan nama database Anda

    // // Buat koneksi
    // $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // // Cek koneksi
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek kredensial pengguna
    $sql = "SELECT * FROM students WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Ambil data pengguna
        $row = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Simpan informasi pengguna ke sesi
            $_SESSION['username'] = $row['username'];
            // Redirect ke halaman utama setelah login berhasil
            header('Location: index/index.php');
            exit();
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('No user found with this username.');</script>";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login Form Using HTML And CSS Only</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container log-in-container">
            <form action="login.php" method="POST">
                <h1>Login</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa fa-facebook fa-2x"></i></a>
                    <a href="#" class="social"><i class="fa fa-twitter fa-2x"></i></a>
                </div>
                <span>or use your account</span>
                <input type="text" name="username" placeholder="Username" required />
                <input type="password" name="password" placeholder="Password" required />
                <a href="#">Forgot your password?</a>
                <button type="submit">Log In</button>
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