<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis</title>
    <link rel="stylesheet" href="../../../assets/css/styles.css">
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

        .quiz-image {
            max-width: 100px;
            max-height: 100px;
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
                <li class="active"><a href="module-1.php">Module 1</a></li>
                <li><a href="sendi.php">Module 2</a></li>
                <li><a href="otot.php">Module 3</a></li>
                <li><a href="penyakit.php">Module 4</a></li>
                <li><a href="quiz.php">Quiz</a></li>
            </ul>
        </div>
        <div class="main-content">
            <header>
                <h2>Kuis</h2>
                <div class="header-actions">
                    <img src="../../../assets/img/icon/home.png" alt="Header Image" class="header-image">
                    <a href="form/quiz.php" class="button">
                        <img src="../../../assets/img/icon/add.png" alt="Tambah Kuis">
                    </a>
                </div>
            </header>
            <div class="order-table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Module</th>
                            <th>Soal</th>
                            <th>Jawaban</th>
                            <th>Explanation</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="kuisTableBody">
                        <!-- Data Kuis dari Database -->
                        <?php
                        require_once '../../config/index.php';

                        $sql = "SELECT * FROM quiz INNER JOIN courses ON courses.id = quiz.course_id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                $question = isset($row['question']) ? $row['question'] : 'N/A';
                                $module = isset(($row['name'])) ? $row['name'] : '';
                                // $option1 = isset($row['option1']) ? $row['option1'] : '';
                                // $option2 = isset($row['option2']) ? $row['option2'] : '';
                                // $option3 = isset($row['option3']) ? $row['option3'] : '';
                                // $option4 = isset($row['option4']) ? $row['option4'] : '';
                                $correct = isset($row['correct']) ? $row['correct'] : '';
                                $explanation = isset($row['explanation']) ? $row['explanation'] : '';
                                $image = isset($row['image']) ? $row['image'] : '';

                                echo "<tr id='row_" . $row['id'] . "'>";
                                echo "<td class='number'>" . $no++ . "</td>";
                                echo "<td>";
                                echo htmlspecialchars($module, ENT_QUOTES) . "<br>";
                                echo "</td>";
                                echo "<td>" . htmlspecialchars($question, ENT_QUOTES) . "</td>";
                                echo "<td>";
                                echo htmlspecialchars($correct, ENT_QUOTES) . "<br>";
                                echo "<td>";
                                echo htmlspecialchars($explanation, ENT_QUOTES) . "<br>";
                                echo "</td>";
                                echo "<td>";
                                if ($image) {
                                    echo "<img src='../../../assets/img/uploads/" . htmlspecialchars($image, ENT_QUOTES) . "' alt='Gambar Kuis' class='quiz-image'>";
                                }
                                echo "</td>";
                                echo "<td>
                                        <div class='action-buttons'>
                                            <a href='update/quiz.php?id=" . $row['id'] . "'><img src='../../../assets/img/icon/edit.png' alt='Edit' style='width: 30px; height: 30px;'></a>
                                            <a href='../../controller/admin/page/module/delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this item?\");'><img src='../../../assets/img/icon/remove.png' alt='Hapus' style='width: 30px; height: 30px;'></a>
                                        </div>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Tidak ada data kuis</td></tr>";
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
                    const rows = document.querySelectorAll('#kuisTableBody tr');
                    rows.forEach((row, index) => {
                        row.querySelector('.number').textContent = index + 1;
                    });
                }
            }
        });
    </script>
</body>

</html>