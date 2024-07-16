<?php
session_start();
if (isset($_SESSION['admin'])) {
    header('location: app/view/admin/module.php');
    return;
}
if (isset($_SESSION['user'])) {
    header('location: app/view/user/index.php');
    return;
}

header('location: app/view/landingpage/index.php');
