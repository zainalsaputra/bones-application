<?php
require_once '../../../../config/index.php';
require_once '../../../../config/session.php';

$image = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct = $_POST['correct'];
    $explanation = $_POST['explanation'];
    $course_id = $_POST['module'];

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
        $query = "UPDATE quiz SET question = ?, option1 = ?, option2 = ?, option3 = ?, option4 = ?, correct = ?, explanation = ?, image = ?, course_id = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssssi", $question, $option1, $option2, $option3, $option4, $correct, $explanation, $image, $course_id, $id);
    } else {
        $query = "UPDATE quiz SET question = ?, option1 = ?, option2 = ?, option3 = ?, option4 = ?, correct = ?, explanation = ?, course_id = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssssi", $question, $option1, $option2, $option3, $option4, $correct, $explanation, $course_id, $id);
    }

    if ($stmt->execute()) {
        header("Location: ../../../../view/admin/quiz.php?edit_success=true");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
