<?php
require_once '../../../../config/index.php';
require_once '../../../../config/session.php';

$id = $name = $tanggal = $description = $image = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $tanggal = $_POST['tanggal'];
    $description = $_POST['description'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../../../../../assets/img/uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = basename($_FILES["image"]["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "<script>history.back()</script>";
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed')</script>";
            return;
        }
    }

    if (!empty($image)) {
        $sql = "UPDATE courses SET name='$name', date='$tanggal', description='$description', image='$image' WHERE id='$id'";
    } else {
        $sql = "UPDATE courses SET name='$name', date='$tanggal', description='$description' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: ../../../../view/admin/module.php?edit_success=true");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$conn->close();
