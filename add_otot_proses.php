<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "materi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$tanggal = $_POST['tanggal'];
$description = $_POST['description'];
$image = $_FILES['image']['name'];
$target = "uploads/" . basename($image);

if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    $sql = "INSERT INTO otot (name, tanggal, image, description) VALUES ('$name', '$tanggal', '$target', '$description')";
    if ($conn->query($sql) === TRUE) {
        header("Location: add-otot.html?success=true");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Failed to upload image";
}

$conn->close();
?>
