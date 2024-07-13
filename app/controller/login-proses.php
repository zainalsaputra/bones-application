<?php
require_once '../config/index.php';

// session_start();
// if (isset($_SESSION['admin'])) {
//     header('location: app/view/bau/index.php');
// } elseif (isset($_SESSION['pegawai'])) {
//     header('location: app/view/prodi/index.php');
// }

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username ='$username' AND password = '$password'";
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);
    $cekUsername = $result['username'];
    $cekPassword = $result['password'];
    $cekLevel = $result['level'];
    if ($cekUsername == $username && $cekPassword == $password && $cekLevel == 'admin') {
        $_SESSION['admin'] = $cekUsername;
        header('location: index.php');
    } elseif ($cekUsername == $username && $cekPassword == $password && $cekLevel == 'user') {
        $_SESSION['user'] = $cekUsername;
        header('location: index.php');
    } else {
        // header('location: ../view/landingpage/login.php?gagal');
        echo "<script>alert('cek kembali username atau password anda!'); document.location.href= '../view/landingpage/login.php'</script>";
    }
}
