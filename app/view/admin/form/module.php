<?php require_once '../../../config/session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Module</title>
    <link rel="stylesheet" href="../../../../assets/css/update.css">
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h1>eProduct</h1>
            <ul>
                <li><a href="index-admin.php">Dashboard</a></li>
                <li class="active"><a href="module.php">Module</a></li>
                <li><a href="../quiz.php">Quiz</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <header>
                <h2>Tambah Module</h2>
            </header>
            <div class="form-container">
                <form method="POST" action="../../../controller/admin/page/module/create.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea id="description" name="description" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Gambar</label>
                        <input type="file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Create">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>