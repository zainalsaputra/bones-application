<?php
$servername = "localhost";
$username = "root";  // Sesuaikan dengan username yang benar
$password = "";      // Sesuaikan dengan password yang benar
$dbname = "materi";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan ID dari parameter GET
$id = $_GET['id'];

// SQL untuk menghapus data berdasarkan ID
$sql = "DELETE FROM tulang WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    // Mengarahkan kembali ke halaman tulang dengan pesan sukses
    header("Location: tulang.php?delete_success=true");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
