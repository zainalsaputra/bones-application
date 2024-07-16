<?php
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $servername = "localhost";
//     $dbusername = "root"; // Ganti sesuai username database Anda
//     $dbpassword = ""; // Ganti sesuai password database Anda
//     $dbname = "student_registration";

//     // Buat koneksi
//     $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

//     // Cek koneksi
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     // Ambil data dari form
//     $full_name = $_POST['full_name'];
//     $user = $_POST['username'];
//     $class = $_POST['class'];
//     $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

//     // Masukkan data ke database
//     $sql = "INSERT INTO students (full_name, username, class, password) VALUES ('$full_name', '$user', '$class', '$pass')";

//     if ($conn->query($sql) === TRUE) {
//         echo "<script>alert('New record created successfully');</script>";
//     } else {
//         echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
//     }

//     $conn->close();
// }
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../../../assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Student Registration Form</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="../../controller/landingpage/register.php" method="POST" style="margin-left: 45px;">
                <h1>Register</h1>
                <span>fill in your details below</span>
                <input type="text" name="name" placeholder="Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="text" name="username" placeholder="Username" required />
                <input type="password" name="password" placeholder="Password" required />
                <button type="submit">Register</button>
            </form>
        </div>
        <!-- <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us, please login with your personal info.</p>
                    <button class="ghost" id="signIn">Log In</button>
                </div>
            </div>
        </div> -->
        <div class="overlay-panel overlay-right" style="
        background:#ff416c;
        background: -webkit-linear-gradient(to right, #ff4b2b, #ff416c);
        background: linear-gradient(to right, #ff4b2b, #ff416c);
        background-position: 0 0;
        color: #fff;">
            <h1>Have a good day</h1>
            <p>Have a account?</p>
            <a href="login.php" style=" margin-top: -15px;"><button class="ghost" id="signIn" style="background-color: #b10101;">Log In</button></a>
        </div>
    </div>
</body>

</html>