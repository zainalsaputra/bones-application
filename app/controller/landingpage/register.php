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

$query = "SELECT username, email FROM users";

$sql = mysqli_query($conn, $query);
$result = $sql->fetch_assoc();

if (mysqli_num_rows($sql) > 0) {
    echo "<script>alert('Username sudah tersedia!'); document.location.href= '../../view/landingpage/login.php'</script>";
} else {
    $query = "INSERT INTO users (name, username, email, password) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssss', $name, $username, $email, $password);
    $stmt->execute();
    echo "<script>alert('Akun telah terdaftar, silahkan login kembali!'); document.location.href= '../../../index.php'</script>";
}
