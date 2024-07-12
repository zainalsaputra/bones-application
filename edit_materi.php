<?php
// Ambil data materi dari database berdasarkan ID untuk proses edit

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=nama_database", "username", "password");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM materials WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            die("Materi tidak ditemukan.");
        }

        $title = $result['title'];
        $image = $result['image'];
        $content = $result['content'];

    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
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
    <h2>Edit Materi</h2>
    <form action="update_material.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="title">Judul:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $title; ?>" required><br><br>

        <label for="image">Gambar:</label><br>
        <img src="<?php echo $image; ?>" width="100"><br>
        <input type="file" id="image" name="image" accept="image/*"><br><br>

        <label for="content">Isi Materi:</label><br>
        <textarea id="content" name="content" rows="4" required><?php echo $content; ?></textarea><br><br>

        <input type="submit" value="Simpan Perubahan">
    </form>
</body>
</html>
