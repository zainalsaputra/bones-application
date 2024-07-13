<?php
$servername = "localhost";
$username = "root";  // Sesuaikan dengan username yang benar
$password = "";      // Sesuaikan dengan password yang benar
$dbname = "materi";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mendefinisikan variabel dengan nilai default
$id = $name = $tanggal = $description = $image = "";

// Memeriksa apakah parameter GET id tersedia
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL untuk mengambil data otot berdasarkan ID
    $sql = "SELECT * FROM otot WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $tanggal = $row['tanggal'];
        $description = $row['description'];
        $image = $row['image'];
    } else {
        echo "Data tidak ditemukan.";
    }
}

// Memeriksa apakah form edit telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $tanggal = $_POST['tanggal'];
    $description = $_POST['description'];

    // Mengunggah gambar jika ada file yang diunggah
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }

    // SQL untuk melakukan update data
    if (!empty($image)) {
        $sql = "UPDATE otot SET name='$name', tanggal='$tanggal', description='$description', image='$image' WHERE id='$id'";
    } else {
        $sql = "UPDATE otot SET name='$name', tanggal='$tanggal', description='$description' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        // Mengarahkan kembali ke halaman otot dengan pesan sukses
        header("Location: otot.php?edit_success=true");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Menutup koneksi
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit otot</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h1>eProduct</h1>
            <ul>
                <li><a href="index-admin.php">Dashboard</a></li>
                <li><a href="tulang.php">Tulang</a></li>
                <li><a href="sendi.php">Sendi</a></li>
                <li class="active"><a href="otot.php">Otot</a></li>
                <li><a href="penyakit.php">Penyakit</a></li>
                <li><a href="kuis.php">Kuis</a></li>
            </ul>
        </div>
        <div class="main-content">
            <header>
                <h2>Edit Materi Otot</h2>
            </header>
            <div class="form-container">
                <form method="POST" action="edit-otot.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        <label for="name">Judul:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($tanggal); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi:</label>
                        <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($description); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Gambar:</label>
                        <?php if (!empty($image)) : ?>
                            <div>
                                <img src="<?php echo $image; ?>" alt="Current Image" width="100">
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
