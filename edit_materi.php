<?php
// Ambil data materi dari database berdasarkan ID untuk proses edit

// if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
//     $id = $_GET['id'];

//     try {
//         $conn = new PDO("mysql:host=localhost;dbname=nama_database", "username", "password");
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//         $sql = "SELECT * FROM materials WHERE id = :id";
//         $stmt = $conn->prepare($sql);
//         $stmt->bindParam(':id', $id);
//         $stmt->execute();

//         $result = $stmt->fetch(PDO::FETCH_ASSOC);
//         if (!$result) {
//             die("Materi tidak ditemukan.");
//         }

//         $title = $result['title'];
//         $image = $result['image'];
//         $content = $result['content'];

//     } catch(PDOException $e) {
//         echo "Error: " . $e->getMessage();
//     }

//     $conn = null;
// }

require_once 'connection.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM kuis WHERE id = $id");
$result = $query->fetch_assoc();

// foreach ($sql as $result) {
//     $title = $result['title'];
//     $image = $result['image'];
//     $content = $result['content'];
// }

?>
<!-- Form edit materi -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materi</title>
</head>

<body>
    <h2>Update Materi</h2>
    <form action="kuis-update-proses.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <label for="question">Question</label><br>
        <input type="text" id="question" name="question" value="<?php echo $result['question'] ?>" required><br><br>
        <label for="title">Option 1</label><br>
        <input type="text" id="option1" name="option1" value="<?php echo $result['option1'] ?>" required><br><br>
        <label for="title">Option 2</label><br>
        <input type="text" id="option2" name="option2" value="<?php echo $result['option2'] ?>" required><br><br>
        <label for="title">Option 3</label><br>
        <input type="text" id="option3" name="option3" value="<?php echo $result['option3'] ?>" required><br><br>
        <label for="title">Option 4</label><br>
        <input type="text" id="option4" name="option4" value="<?php echo $result['option4'] ?>" required><br><br>
        <label for="title">Correct Answer</label><br>
        <input type="text" id="correct" name="correct" value="<?php echo $result['correct'] ?>" required><br><br>
        <label for="image">Image</label><br>
        <img src="uploads/<?php echo $result['image'] ?>" width="200"><br>
        <input type="file" id="image" name="image" accept="image/*"><br><br>
        <label for="explanation">Explanation</label><br>
        <textarea id="explanation" name="explanation" rows="4" required><?php echo $result['explanation'] ?></textarea><br><br>

        <input type="submit" value="Update">
    </form>
</body>

</html>