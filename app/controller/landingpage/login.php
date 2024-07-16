<?php
require_once '../../config/index.php';

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT name, username, email, password, roles.level FROM users INER JOIN roles ON roles.id = role_id WHERE password='$password' AND username='$email' OR email='$email';";

$sql = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($sql);

$name = $result['name'];
$cekEmail = $result['email'];
$cekUsername = $result['username'];
$cekPassword = $result['password'];
$cekLevel = $result['level'];

if (($cekEmail == $email || $cekUsername == $email) && $cekPassword == $password && $cekLevel == 'admin') {
    $_SESSION['admin'] = $name;
    echo $_SESSION['admin'];
    header('location: ../../view/landingpage/login.php?berhasil');
    exit();
} elseif (($cekEmail == $email || $cekUsername == $email) && $cekPassword == $password && $cekLevel == 'user') {
    echo $_SESSION['user'] = $name;
    header('location: ../../view/landingpage/login.php?berhasil');
    exit();
} else {
    header('location: ../../view/landingpage/login.php?salah');
}
