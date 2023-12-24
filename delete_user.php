<?php

include('config/dbcon.php');


if(isset($_POST['users_id'])){
    $users_id = $_POST['users_id'];

    // Perform the delete operation
    $delete_query = "DELETE FROM users WHERE users_id = '$users_id'";
    $delete_result = mysqli_query($con, $delete_query);

    if($delete_result){
        echo 200;
        
    } else {
        echo 500;
    }
} else {
    echo "Invalid request!";
    header("Location: regiser.php");


    
if(isset($_POST['categories_id'])){
    $cate_id = $_POST['categories_id'];

    // Perform the delete operation
    $delete_query = "DELETE FROM categories WHERE categories_id = '$cate_id'";
    $delete_result = mysqli_query($con, $delete_query);

    if($delete_result){
        echo "User removed successfully!";
        header("Location: regiser.php");
    } else {
        echo "Error removing user: " . mysqli_error($con);
    }
} else {
    echo "Invalid request!";
    header("Location: regiser.php");
}
}
?>