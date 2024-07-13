<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sendi</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .notification {
            display: none;
            background-color: #f44336;
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
        .header-image {
            width: 30px;
            height: auto;
            margin-right: 20px;
        }
        .button img {
            width: 30px;
            height: auto;
            margin-right: 20px;
            margin-top: 9px;
        }
        .description {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .more-link {
            color: blue;
            cursor: pointer;
        }
        .action-buttons img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h1>eProduct</h1>
            <ul>
                <li><a href="index-admin.php">Dashboard</a></li>
                <li><a href="tulang.php">Tulang</a></li>
                <li class="active"><a href="sendi.php">Sendi</a></li>
                <li><a href="otot.php">Otot</a></li>
                <li><a href="penyakit.php">Penyakit</a></li>
                <li><a href="kuis.php">Kuis</a></li>
            </ul>
        </div>
        <div class="main-content">
            <header>
                <h2>Sendi</h2>
                <div class="header-actions">
                    <img src="asset/home.png" alt="Header Image" class="header-image">
                    <a href="add-sendi.html" class="button">
                        <img src="asset/add.png" alt="Tambah Sendi">
                    </a>
                </div>
            </header>
            <div class="order-table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sendi</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="sendiTableBody">
                        <!-- Data Sendi dari Database -->
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "materi";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Koneksi gagal: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM sendi";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $no = 1;
                            while($row = $result->fetch_assoc()) {
                                $description = $row['description'];
                                $description_parts = explode('.', $description);
                                $short_description = implode('.', array_slice($description_parts, 0, 10)) . '.';
                                $has_more = count($description_parts) > 10;

                                $tanggal = !empty($row['tanggal']) ? date('d-m-Y', strtotime($row['tanggal'])) : 'N/A';

                                echo "<tr id='row_" . $row['id'] . "'>";
                                echo "<td class='number'>" . $no++ . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td><img src='" . $row['image'] . "' width='100'></td>";
                                echo "<td class='description' data-full-description='" . htmlspecialchars($row['description'], ENT_QUOTES) . "'>" . $short_description;
                                if ($has_more) {
                                    echo "<span class='more-link' style='color:blue;cursor:pointer;'>...read more</span>";
                                }
                                echo "</td>";
                                echo "<td>" . $tanggal . "</td>";
                                echo "<td>
                                        <div class='action-buttons'>
                                            <a href='edit-sendi.php?id=" . $row['id'] . "'><img src='asset/edit.png' alt='Edit' style='width: 30px; height: 30px;'></a>
                                            <a href='delete_sendi.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this item?\");'><img src='asset/remove.png' alt='Hapus' style='width: 30px; height: 30px;'></a>
                                        </div>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Tidak ada data sendi</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="notification" id="notification">Materi telah dihapus!</div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            if (window.location.search.includes('delete_success=true')) {
                const notification = document.getElementById('notification');
                notification.classList.add('show');
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 3000);

                // Remove the deleted row
                const urlParams = new URLSearchParams(window.location.search);
                const id = urlParams.get('id');
                if (id) {
                    const row = document.getElementById('row_' + id);
                    if (row) {
                        row.remove();
                    }
                    // Renumber rows
                    const rows = document.querySelectorAll('#sendiTableBody tr');
                    rows.forEach((row, index) => {
                        row.querySelector('.number').textContent = index + 1;
                    });
                }
            }

            document.querySelectorAll('.more-link').forEach(link => {
                link.addEventListener('click', () => {
                    const descriptionCell = link.parentElement;
                    const fullDescription = descriptionCell.getAttribute('data-full-description');
                    descriptionCell.innerHTML = fullDescription;
                });
            });
        });
    </script>
</body>
</html>
