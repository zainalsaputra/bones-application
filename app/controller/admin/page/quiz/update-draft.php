<?php
require_once '../../../../config/index.php';

$id = $_POST['id'];

// Mengambil nilai dari form
$question = $_POST['question'];
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$option3 = $_POST['option3'];
$option4 = $_POST['option4'];
$correct = $_POST['correct'];
$explanation = $_POST['explanation'];
$course_id = $_POST['module'];

// Menangani file gambar yang diunggah
$image = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = basename($_FILES['image']['name']);
    $target_dir = "../../../../../assets/img/uploads/";
    $target_file = $target_dir . $image;

    // Memindahkan file gambar yang diunggah ke direktori uploads
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        die("Gagal mengunggah gambar.");
    }
}

// Prepared statement untuk memasukkan data ke database
// $stmt = $conn->prepare("UPDATE quiz (question, option1, option2, option3, option4, correct, explanation, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
// $stmt->bind_param("ssssssss", $question, $option1, $option2, $option3, $option4, $correct, $explanation, $image);

// $stmt = $conn->prepare("UPDATE quiz SET quiz.question = ?, quiz.option1 = ?, quiz.option2 = ?, quiz.option3 = ?, quiz.option4 = ?, quiz.correct = ?, quiz.explanation = ?, quiz.image = ?, quiz.course_id= ?, INNER JOIN courses ON courses.id = quiz.course_id WHERE quiz.id = ?");

$query = "UPDATE quiz SET question = ?, option1 = ?, option2 = ?, option3 = ?, option4 = ?, correct = ?, explanation = ?, image = ?, course_id = ? WHERE id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("sssssssssi", $question, $option1, $option2, $option3, $option4, $correct, $explanation, $image, $course_id, $id);

// Eksekusi statement
if ($stmt->execute()) {
    // Redirect ke halaman quiz.php setelah berhasil disimpan
    header("Location: ../../../../view/admin/quiz.php");
} else {
    // Tampilkan pesan kesalahan jika terjadi
}

// $query = "UPDATE quiz SET question = 'new_question', option1 = 'new_option1', option2 = 'new_option2', option3 = 'new_option3', option4 = 'new_option4', correct = 'new_correct', explanation = 'new_explanation', image = 'new_image', course_id = 'new_course_id' WHERE id = '$id'";

// if ($conn) {
//     // Redirect ke halaman quiz.php setelah berhasil disimpan
//     header("Location: ../../../../view/admin/quiz.php");
// } else {
//     // Tampilkan pesan kesalahan jika terjadi
// }

// Menutup statement dan koneksi database
$stmt->close();
$conn->close();
