<?php
require_once '../../../config/index.php';
require_once '../../../config/session.php';

// Memeriksa apakah parameter GET id tersedia
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    // SQL untuk mengambil data tulang berdasarkan ID
    $sql = "SELECT * FROM courses WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $tanggal = $row['date'];
        $description = $row['description'];
        $image = $row['image'];
    } else {
        echo "Data tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Module</title>
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
                <h2>Edit Module</h2>
            </header>
            <div class="form-container">
                <form method="POST" action="../../../controller/admin/page/module/update.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($tanggal); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($description); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Gambar</label>
                        <?php if (!empty($image)) : ?>
                            <div>
                                <img src="../../../../assets/img/uploads/<?php echo $image; ?>" alt="Current Image" width="200">
                            </div>
                        <?php endif; ?>
                        <input type="file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>