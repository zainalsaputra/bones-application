<?php
require_once '../../../../config/index.php';
require_once '../../../../config/session.php';

$name = $_POST['name'];
$tanggal = $_POST['tanggal'];
$description = $_POST['description'];

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = basename($_FILES['image']['name']);
    $target_dir = "../../../../../assets/img/uploads/";
    $target_file = $target_dir . $image;
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        die("Gagal mengunggah gambar.");
    }
}
$stmt = $conn->prepare("INSERT INTO courses (name, date, image, description) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $tanggal, $image, $description);
if ($stmt->execute()) {
    header("Location: ../../../../view/admin/module.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
