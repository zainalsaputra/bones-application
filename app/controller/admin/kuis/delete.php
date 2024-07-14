<?php
require_once '../../../config/index.php';

// Mendapatkan ID dari parameter GET
$id = $_GET['id'];

// SQL untuk menghapus data berdasarkan ID
$sql = "DELETE FROM kuis WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    // Mengarahkan kembali ke halaman otot dengan pesan sukses
    header("Location: ../../../view/admin/kuis.php?delete_success=true");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

// Menutup koneksi
$conn->close();
