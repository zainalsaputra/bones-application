<?php
require_once '../../../config/index.php';

$id = $_GET['id'];
$queryImage = "SELECT image FROM kuis WHERE id='$id'";

if ($conn->query($queryImage)) {
    $query = $conn->query($queryImage);
    $select = $query->fetch_assoc();
    $dirImage = "../../../../assets/img/uploads/" . $select['image'];
    if (file_exists($dirImage)) {
        $sql = "DELETE FROM kuis WHERE id='$id'";
        $conn->query($sql);
        if (unlink($dirImage)) {
            header("Location: ../../../view/admin/kuis.php?delete_success=true");
            return;
        } else {
            echo 'Failed to delete image on d';
        }
    } else {
        echo 'Source image don\'t exist';
    }
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
