<?php

$image = "../../../../assets/img/uploads/1-getallbooks.png";

if (file_exists($image)) {
    if (unlink($image)) {
        echo 'success ';
        return;
    } else {
        echo 'failed';
        return;
    }
} else {
    echo 'dont exist';
}
