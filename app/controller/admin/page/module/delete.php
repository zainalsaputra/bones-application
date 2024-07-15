<?php
require_once '../../../../config/index.php';

$id = $_GET['id'];
$queryImage = "SELECT image FROM courses WHERE id='$id'";


if ($conn->query($queryImage)) {
    $query = $conn->query($queryImage);
    $select = $query->fetch_assoc();
    $dirImage = "../../../../../assets/img/uploads/" . $select['image'];
    if (file_exists($dirImage)) {
        $sql = "DELETE FROM courses WHERE id='$id'";
        $try = $conn->query($sql);
        if (!$try) {
            echo 0;
        };
        // if (mysqli_report(MYSQLI_REPORT_ERROR)) {
        //     echo 0;
        //     return;
        // };
        if (unlink($dirImage)) {
            header("Location: ../../../../view/admin/module.php?delete_success=true");
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
