<?php
session_start();
include('config/dbcon.php');
include('functions/myfunction.php');
//================Update Order Status
// if(isset($_POST['update_status_orders'])){
//     $orders_id = $_POST['orders_id'];
//     $orders_status = $_POST['orders_status'];

//     // Update the base table (ordersdetails) instead of the view
//     $query = "UPDATE ordersview SET orders_status = '$orders_status' WHERE orders_id = '$orders_id' ";
//     $query_run = mysqli_query($con, $query);

//     redirect("view_orders.php?orders_id=".$orders_id, "Order Status updated successfully");
// }

if (isset($_POST['update_status_orders'])) {
    $orders_id = $_POST['orders_id'];
    $orders_status = $_POST['orders_status'];

    // Update the base table (ordersdetails)
    $update_query = "UPDATE ordersview SET orders_status = '$orders_status' WHERE orders_id = '$orders_id' ";
    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        // Retrieve orders_userid from ordersview
        $get_orders_userid_query = "SELECT orders_usesrid FROM ordersview WHERE orders_id = '$orders_id'";
        $get_orders_userid_run = mysqli_query($con, $get_orders_userid_query);

        if ($get_orders_userid_run && mysqli_num_rows($get_orders_userid_run) > 0) {
            $orders_userid_row = mysqli_fetch_assoc($get_orders_userid_run);
            $notification_userid = $orders_userid_row['orders_usesrid'];

            // Insert into the notification table based on the updated status
            if ($orders_status == 1) {
                $notification_title = 'Order Status Updated';
                $notification_body = 'The order status has been updated to Processing.';
                $notification_title_khmer = 'ការបញ្ជាទិញបានជោគជ័យ';
                $notification_body_khmer = 'ហាងយើងខ្ញុំនឹងដឹកជញ្ជូនទៅអ្នកក្នុងពេល​​​១ទៅ២ថ្ងៃខាងមុខ';
                $notification_orderid = $orders_id;

                $insert_notification_query = "INSERT INTO notification (
                    notification_title, 
                    notification_body, 
                    notification_userid, 
                    notification_title_khmer, 
                    notification_body_khmer, 
                    notification_orderid
                ) VALUES (
                    '$notification_title', 
                    '$notification_body', 
                    '$notification_userid', 
                    '$notification_title_khmer', 
                    '$notification_body_khmer', 
                    '$notification_orderid'
                )";
                $insert_notification_run = mysqli_query($con, $insert_notification_query);
            } elseif ($orders_status == 2) {
                $notification_title = 'Order Canceled';
                $notification_body = 'Unfortunately, your order has been canceled.';
                $notification_title_khmer = 'បានបោះបង់ការបញ្ជាទិញ';
                $notification_body_khmer = 'សូមអភ័យទោសពេលនេះការបញ្ជាទិញរបស់អ្នកត្រូវបានបោះបង់។';
                $notification_orderid = $orders_id;

                $insert_notification_query = "INSERT INTO notification (
                    notification_title, 
                    notification_body, 
                    notification_userid, 
                    notification_title_khmer, 
                    notification_body_khmer, 
                    notification_orderid
                ) VALUES (
                    '$notification_title', 
                    '$notification_body', 
                    '$notification_userid', 
                    '$notification_title_khmer', 
                    '$notification_body_khmer', 
                    '$notification_orderid'
                )";
                $insert_notification_run = mysqli_query($con, $insert_notification_query);
            }

            if ($insert_notification_run) {
                redirect("view_orders.php?orders_id=" . $orders_id, "Order Status and Notification updated successfully");
            } else {
                redirect("view_orders.php?orders_id=" . $orders_id, "Error updating Notification");
            }
        } else {
            redirect("view_orders.php?orders_id=" . $orders_id, "Error retrieving orders_userid");
        }
    } else {
        redirect("view_orders.php?orders_id=" . $orders_id, "Error updating Order Status");
    }
}



//================ add product ================
if(isset($_POST['product_save'])){
    $categoris_id = $_POST['categoris_id'];
    $items_name = $_POST['items_name'];
    $items_name_vn = $_POST['items_name_vn'];
    $items_desc	 = $_POST['items_desc'];
    $items_desc_vn = $_POST['items_desc_vn'];
    $items_price = $_POST['items_price'];
    $items_discount	= $_POST['items_discount'];
    $items_count	= $_POST['items_count'];
    $items_image = $_FILES['items_image']['name'];

    $allow_extension = array('png','jpg','jpeg');
    $path = "uploads/items";
    $file_extension = pathinfo($items_image, PATHINFO_EXTENSION);
    $filename = time().'.'. $file_extension;


    if(!in_array($file_extension, $allow_extension)){
        $_SESSION['status'] = "You are allowed with only jpg,png,jpeg Image";
        header("Location: add_product.php");
        exit(0);


    }else{
        $query = "INSERT INTO items (items_cart, items_name, items_name_vn, items_desc, items_desc_vn, items_price, items_discount, items_count, items_image) 
          VALUES ('$categoris_id', '$items_name', '$items_name_vn', '$items_desc', '$items_desc_vn', '$items_price', '$items_discount', '$items_count', '$filename')";

        $query_run = mysqli_query($con, $query);

        if($query_run){
            move_uploaded_file($_FILES['items_image']['tmp_name'],$path.'/'.$filename);
             redirect("add_product.php","Product add successfully");
            exit(0);
        }else
        {
            redirect("add_product.php","Somting went wrong");
           exit(0);
        }
}


}
//================ edit product ================

if(isset($_POST['edit_product'])){
    $items_id=$_POST['items_id'];
    $categoris_id = $_POST['categoris_id'];
    $items_name = $_POST['items_name'];
    $items_name_vn = $_POST['items_name_vn'];
    $items_desc	 = $_POST['items_desc'];
    $items_desc_vn = $_POST['items_desc_vn'];
    $items_price = $_POST['items_price'];
    $items_discount	= $_POST['items_discount'];
    $items_count	= $_POST['items_count'];

    // $allow_extension = array('png','jpg','jpeg');
    $path = "uploads/items";
    $allow_extension = array('png','jpg','jpeg');
    $items_image = $_FILES['items_image']['name'];
    $old_image = $_POST['old_image'];

    if($items_image !='')
    {
    
        $update_filename = $_FILES['items_image']['name'];
        $image_ext = pathinfo($update_filename, PATHINFO_EXTENSION);
        $filename = time().'.'. $image_ext;
        if(!in_array($image_ext,$allow_extension)){
            redirect('add_product.php','You are allowed with only jpg,png,jpeg Image');
        }
        $update_filename = $filename;
    }
    else{
        $update_filename = $old_image;
    }
    $query = "UPDATE items SET  items_cart='$categoris_id' ,
                                items_name='$items_name' ,
                                items_name_vn='$items_name_vn' ,
                                items_desc='$items_desc' ,
                                items_desc_vn='$items_desc_vn' ,
                                items_price='$items_price' ,
                                items_discount='$items_discount' ,
                                items_count='$items_count' ,
                                items_image='$update_filename' 
                                WHERE items_id = '$items_id'";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
            if($items_image !='')
        {
            move_uploaded_file($_FILES['items_image']['tmp_name'],$path.'/'.$filename);
            if(file_exists('uploads/items'.$old_image)){
                unlink('uploads/items'.$old_image);
            }
        }
        redirect('edit_product.php?items_id='.$items_id,'Product update successfully');
    }
    else
    {
        redirect('edit_product.php?items_id='.$items_id,'Product update fail');

    }
    
    

}

//================ delete product ================

if (isset($_POST['delete_product_btn'])) {
    $items_id = mysqli_real_escape_string($con, $_POST['items_id']);
    
    $query = "SELECT * FROM items WHERE items_id ='$items_id' "; 
    $query_run = mysqli_query($con, $query);
    $query_data = mysqli_fetch_array($query_run);
    $items_image = $query_data['items_image'];

    $delete_query = "DELETE FROM items WHERE items_id = '$items_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if ($delete_query_run) {
        if (file_exists("uploads/items/" . $items_image)) {
            unlink("uploads/items/" . $items_image);
            echo 200; // Deletion successful
        } else {
            echo 500; // File not found
        }
    } else {
        echo 500; // Query execution failed
    }
}


// =============== categories ===============
if(isset($_POST['categories'])){
    $categories_name = $_POST['categories_name'];
    $categories_name_vn = $_POST['categories_name_vn'];
    $categories_image = $_FILES['categories_image']['name'];

    $allow_extension = array('svg');
    $path = "uploads/categories";
    $image_ext = pathinfo($categories_image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    if(!in_array($image_ext, $allow_extension)){
        redirect("category.php" , "You are allowed with only file svg");
    }else{
        $categories_query = " INSERT INTO categories (categories_name,categories_name_vn,categories_image) VALUES ('$categories_name','$categories_name_vn','$filename')";
    $categories_result = mysqli_query($con, $categories_query);

    if ($categories_result) {
        move_uploaded_file($_FILES['categories_image']['tmp_name'], $path.'/'.$filename );
        redirect("category.php","Category add successfully");
       
    } else {
        redirect("category.php","Something went wrong");
    }
    }

    
}
// =============== categories edit ===============

if(isset($_POST['categories_update'])){
    $categories_id = $_POST['categories_id'];
    $categories_name = $_POST['categories_name'];
    $categories_name_vn = $_POST['categories_name_vn'];

    $path = "uploads/categories";
    $allow_extension = array('svg');
    $categories_image = $_FILES['categories_image']['name'];
    $old_image = $_POST['old_image'];

    if($categories_image !='')
    {
    
        $update_filename = $_FILES['categories_image']['name'];
        $image_ext = pathinfo($update_filename, PATHINFO_EXTENSION);
        $filename = time().'.'. $image_ext;
        if(!in_array($image_ext,$allow_extension)){
            redirect('category.php','You are allowed with only file svg');
        }
        $update_filename = $filename;
    }
    else{
        $update_filename = $old_image;
    }

    $query = "UPDATE categories SET categories_name ='$categories_name' , categories_name_vn = '$categories_name_vn' , categories_image ='$update_filename' 
    WHERE categories_id = '$categories_id' ";
    $categories_result = mysqli_query($con, $query);
    if($categories_result)
    {
            if($categories_image !='')
        {
            move_uploaded_file($_FILES['categories_image']['tmp_name'],$path.'/'.$filename);
            if(file_exists('uploads/categories'.$old_image)){
                unlink('uploads/categories'.$old_image);
            }
        }
        redirect('category_edit.php?categories_id='.$categories_id,'Category Update Successfully');
    }
    else
    {
        redirect('category_edit.php?categories_id='.$categories_id,'Category Updating Failed');

    }



    // if ($categories_result) {
    //     // $_SESSION['status'] = "Category Update Successfully";
    //     // header("Location: category.php");
    //     redirect('category_edit.php?categories_id='.$categories_id,'Category Update Successfully');
    // } else {
    //     // $_SESSION['status'] = "Category Updating Failed";
    //     // header("Location: category.php");
    //     redirect('category_edit.php?categories_id='.$categories_id,'Category Updating Failed');

    // }

}
// =============== categories edit ===============
if(isset($_POST['delete_cate_btn'])){
    $cate_id = $_POST['delete_cate_id'];
    $query = " DELETE FROM categories WHERE categories_id = '$cate_id' ";
    $categories_result = mysqli_query($con, $query);



    if ($categories_result) {
        $_SESSION['status'] = "Category Delete Successfully";
        header("Location: category.php");
    } else {
        $_SESSION['status'] = "Category Deleted Failed";
        header("Location: category.php");
    }

}



// remove data

if(isset($_POST['DeleteUsersbtn'])){
    $userid = $_POST['delete_id'];
    $query = "DELETE FROM users WHERE users_id = '$userid' ";
    $query_run = mysqli_query($con, $query);
    if($query_run){
        $_SESSION['status' ] = "User Delete Successfully";
        header("Location  : regiser.php");

    }else{
        $_SESSION['status' ] = "User Delete Failed";
        header("Location  : regiser.php");
    }
}
?>