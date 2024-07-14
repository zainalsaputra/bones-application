<?php
require_once '../../../config/index.php';

$id = $_GET['id'];
$sql = "DELETE FROM tulang WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: ../../../view/admin/tulang.php?delete_success=true");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
