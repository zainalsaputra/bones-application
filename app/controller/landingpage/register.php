<?php
require_once '../../config/index.php';

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// $cekUsername = $pdo->prepare("SELECT * FROM users WHERE username = :username");
// $cekUsername->execute(['username' => $username]);
// if ($cekUsername->rowCount() > 0) {
//     echo "<script>alert('Username sudah tersedia!'); document.location.href= '../../view/landingpage/login.php'</script>";
// }

// $cekEmail = $conn->prepare("SELECT * FROM users WHERE email = :email");
// $cekEmail->execute(['email' => $email]);


$cekUsername = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
$cekEmail = mysqli_query($conn, "SELECT username, email FROM users WHERE email = '$email'");

if (mysqli_num_rows($cekUsername) > 0) {
    echo "<script>alert('Username sudah tersedia!'); document.location.href= '../../view/landingpage/register.php'</script>";
} elseif (mysqli_num_rows($cekEmail) > 0) {
    echo "<script>alert('Email sudah tersedia!'); document.location.href= '../../view/landingpage/register.php'</script>";
} else {
    $query = "INSERT INTO users (name, username, email, password) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssss', $name, $username, $email, $password);
    $stmt->execute();
    header('location: ../../view/landingpage/login.php?terdaftar');
}
