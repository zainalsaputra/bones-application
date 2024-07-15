<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tulang</title>
    <link rel="stylesheet" href="../../../../assets/css/kuis.css">
    <style>
        .notification {
            display: none;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            border-radius: 5px;
        }

        .notification.show {
            display: block;
        }

        .button img {
            width: 30px;
            /* Sesuaikan ukuran gambar header */
            height: auto;
            margin-right: 20px;
            margin-top: 9px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-content">
            <header>
                <h2>Tambah Tulang</h2>
                <a href="tulang.php" class="button">
                    <img src="../../../../assets/img/icon/home.png" alt="Kembali ke Tulang">
                </a>
            </header>
            <div class="form-container">
                <form action="../../../controller/admin/tulang/create.php" method="POST" enctype="multipart/form-data">
                    <label for="name">Nama Tulang:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="tanggal">Tanggal:</label>
                    <input type="date" id="tanggal" name="tanggal" required>

                    <label for="description">Deskripsi:</label>
                    <textarea id="description" name="description" required></textarea>

                    <label for="image">Gambar:</label>
                    <input type="file" id="image" name="image" required>

                    <input type="submit" value="Submit">
                </form>
            </div>
            <div class="notification" id="notification">Materi telah ditambahkan!</div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            if (window.location.search.includes('success=true')) {
                const notification = document.getElementById('notification');
                notification.classList.add('show');
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 3000);
            }
        });
    </script>
</body>

</html>