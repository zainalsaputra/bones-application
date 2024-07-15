<?php
require_once '../../../../config/index.php';

// Mengambil nilai dari form
$question = $_POST['question'];
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$option3 = $_POST['option3'];
$option4 = $_POST['option4'];
$correct = $_POST['correct'];
$explanation = $_POST['explanation'];
$course_name = $_POST['course_name'];

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
$stmt = $conn->prepare("INSERT INTO quiz (question, option1, option2, option3, option4, correct, explanation, image, course_name) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $question, $option1, $option2, $option3, $option4, $correct, $explanation, $image, $course_name);

// Eksekusi statement
if ($stmt->execute()) {
    // Redirect ke halaman quiz.php setelah berhasil disimpan
    header("Location: ../../../../view/admin/quiz.php");
} else {
    // Tampilkan pesan kesalahan jika terjadi
    echo "Error: " . $stmt->error;
}

// Menutup statement dan koneksi database
$stmt->close();
$conn->close();
