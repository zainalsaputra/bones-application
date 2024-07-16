<?php
require_once '../../../config/index.php';
require_once '../../../config/session.php';

// Memeriksa apakah parameter GET id tersedia
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    // SQL untuk mengambil data tulang berdasarkan ID
    $sql = "SELECT quiz.question, quiz.option1, quiz.option2, quiz.option3, quiz.option4, quiz.correct, quiz.explanation, quiz.image, courses.name FROM quiz INNER JOIN courses ON courses.id = quiz.course_id WHERE quiz.id='$id'";
    $query = $conn->query($sql);

    $result = $query->fetch_assoc();
    $id = $_GET['id'];
    $question = $result['question'];
    $option1 = $result['option1'];
    $option2 = $result['option2'];
    $option3 = $result['option3'];
    $option4 = $result['option4'];
    $correct = $result['correct'];
    $explanation = $result['explanation'];
    $image = $result['image'];
    // $question = $result['question'];
}

$selectQuery = mysqli_query($conn, "SELECT id, name FROM courses");

$query = mysqli_query($conn, "SELECT quiz.id, quiz.question, quiz.option1, quiz.option2, quiz.option3, quiz.option4, quiz.correct, quiz.explanation, quiz.image, courses.name FROM quiz INNER JOIN courses ON courses.id = quiz.course_id WHERE quiz.id = $id");

$result = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kuis Pilihan Ganda</title>
    <link rel="stylesheet" href="../../../../assets/css/kuis.css">
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h1>eProduct</h1>
            <ul>
                <li><a href="index-admin.php">Dashboard</a></li>
                <li><a href="../module.php">Module</a></li>
                <li class="active"><a href="quiz.php">Quiz</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <header>
                <h2>Buat Kuis Pilihan Ganda</h2>
            </header>
            <div class="form-container">
                <form method="POST" action="../../../controller/admin/page/quiz/update.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="module">Module</label>

                        <input name="id" type="hidden" value="<?php echo $id ?>">

                        <select id=" module" name="module" required>
                            <?php foreach ($selectQuery as $module) : ?>
                                <option value="<?php echo $module['id'] ?>"><?php echo $module['name'] ?></option>
                            <?php endforeach ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="question">Soal</label>
                        <textarea id="question" name="question" rows="3" required><?php echo $question ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="option1">Opsi A</label>
                        <input type="text" id="option1" name="option1" value="<?php echo $option1 ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="option2">Opsi B</label>
                        <input type="text" id="option2" name="option2" value="<?php echo $option2 ?>" required>
                    </div>
                    <div class=" form-group">
                        <label for="option3">Opsi C</label>
                        <input type="text" id="option3" name="option3" value="<?php echo $option3 ?>" required>
                    </div>
                    <div class=" form-group">
                        <label for="option4">Opsi D</label>
                        <input type="text" id="option4" name="option4" value="<?php echo $option4 ?>" required>
                    </div>
                    <div class=" form-group">
                        <label for="correct">Jawaban Benar</label>
                        <select id="correct" name="correct" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="explanation">Penjelasan</label>
                        <textarea id="explanation" name="explanation" rows="3" required><?php echo $explanation ?></textarea>
                    </div>
                    <div class=" form-group">
                        <label for="image">Image</label>
                        <img src="../../../../assets/img/uploads/<?php echo $image ?>" width="200"><br>
                        <input type="file" id="image" name="image" value="<?php echo $image ?>>
                    </div>
                    <div class=" form-group">
                        <input type="submit" value="Simpan Kuis">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>