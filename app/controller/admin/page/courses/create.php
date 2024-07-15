<?php
require_once '../../../../config/index.php';

$name = $_POST['name'];
$tanggal = $_POST['tanggal'];
$description = $_POST['description'];

// $image = $_FILES['image']['name'];
// $target = "../../../../assets/img/uploads/" . basename($image);

// if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
//     $sql = "INSERT INTO courses (name, tanggal, image, description) VALUES ('$name', '$tanggal', '$target', '$description')";
//     if ($conn->query($sql) === TRUE) {
//         header("Location: ../../../view/admin/courses.php?success=true");
//         exit();
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// } else {
//     echo "Failed to upload image";
// }

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = basename($_FILES['image']['name']);
    $target_dir = "../../../../../assets/img/uploads/";
    $target_file = $target_dir . $image;
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        die("Gagal mengunggah gambar.");
    }
}
$stmt = $conn->prepare("INSERT INTO courses (name, tanggal, image, description) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $tanggal, $image, $description);
if ($stmt->execute()) {
    header("Location: ../../../../view/admin/courses.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
