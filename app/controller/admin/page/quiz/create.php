<?php
require_once '../../../../config/index.php';
require_once '../../../../config/session.php';

$question = $_POST['question'];
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$option3 = $_POST['option3'];
$option4 = $_POST['option4'];
$correct = $_POST['correct'];
$explanation = $_POST['explanation'];
$module_id = $_POST['module'];

$image = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = basename($_FILES['image']['name']);
    $target_dir = "../../../../../assets/img/uploads/";
    $target_file = $target_dir . $image;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        die("Gagal mengunggah gambar.");
    }
}

$stmt = $conn->prepare("INSERT INTO quiz (question, option1, option2, option3, option4, correct, explanation, image, course_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $question, $option1, $option2, $option3, $option4, $correct, $explanation, $image, $module_id);

if ($stmt->execute()) {

    header("Location: ../../../../view/admin/quiz.php");
} else {

    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
