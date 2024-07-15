<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kuis Pilihan Ganda</title>
    <link rel="stylesheet" href="../../../assets/css/kuis.css">
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h1>eProduct</h1>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="tulang.php">Tulang</a></li>
                <li><a href="sendi.php">Sendi</a></li>
                <li><a href="otot.php">Otot</a></li>
                <li><a href="penyakit.php">Penyakit</a></li>
                <li class="active"><a href="kuis.php">Kuis</a></li>
            </ul>
        </div>
        <div class="main-content">
            <header>
                <h2>Buat Kuis Pilihan Ganda</h2>
            </header>
            <div class="form-container">
                <form method="POST" action="../../controller/admin/kuis-proses.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="question">Soal:</label>
                        <textarea id="question" name="question" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="option1">Opsi A:</label>
                        <input type="text" id="option1" name="option1" required>
                    </div>
                    <div class="form-group">
                        <label for="option2">Opsi B:</label>
                        <input type="text" id="option2" name="option2" required>
                    </div>
                    <div class="form-group">
                        <label for="option3">Opsi C:</label>
                        <input type="text" id="option3" name="option3" required>
                    </div>
                    <div class="form-group">
                        <label for="option4">Opsi D:</label>
                        <input type="text" id="option4" name="option4" required>
                    </div>
                    <div class="form-group">
                        <label for="correct">Jawaban Benar:</label>
                        <select id="correct" name="correct" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="explanation">Penjelasan:</label>
                        <textarea id="explanation" name="explanation" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Gambar:</label>
                        <input type="file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Simpan Kuis">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>