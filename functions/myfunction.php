<?php 

// include('../config/dbcon.php');


function redirect($page, $message) {
    $_SESSION['status'] = $message;
    header("Location: $page");
    exit();
}
?>