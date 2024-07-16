<?php
require_once '../../../../config/index.php';
require_once '../../../../config/session.php';

$id = $_GET['id'];
$queryImage = "SELECT image FROM courses WHERE id='$id'";


if ($conn->query($queryImage)) {
    $query = $conn->query($queryImage);
    $select = $query->fetch_assoc();
    $dirImage = "../../../../../assets/img/uploads/" . $select['image'];
    try {
        $sql = "DELETE FROM courses WHERE id='$id'";
        $conn->query($sql);
    } catch (Exception $ex) {
        echo "<script>alert('" . $ex->getMessage() . "')</script>";
        header("Location: ../../../../view/admin/module.php?delete_success=false");
        return;
    }
    if (file_exists($dirImage)) {
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
