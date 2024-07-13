<?php
require_once 'app/config/index.php';

session_start();
session_destroy();
$conn->close();

header('location: index.php');
