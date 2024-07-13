<?php

require_once 'database/bones_db.php';

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
