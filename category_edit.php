<?php 
session_start();
include('config/dbcon.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  <?php include('message.php'); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Category
                            </h4>
                            <a href="category.php" class ="btn btn-danger btn-sm float-right">Back</a>
                        </div>
                        <div class="card-body">
                        <form action="code.php" method="POST">
                            <?php
                            if(isset($_GET['categories_id']))
                             {
                                $categories_id =$_GET['categories_id'];
                                $query = " SELECT * FROM categories WHERE categories_id = '$categories_id' ";
                                $query_run = mysqli_query($con, $query);

                                foreach($query_run as $cate):

                                ?> 
                                <input type="hidden" name="categories_id" value=" <?= $cate['categories_id']?>">

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Category Name</label>
                                    <input type="text" name= "categories_name" value=" <?= $cate['categories_name']; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Category Name VN</label>
                                    <input type="text" name= "categories_name_vn" value=" <?= $cate['categories_name_vn']; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                <input type="hidden" name="old_image" value="<?= $cate['categories_image'];?> ">
                                    <label for="">Category Image</label>
                                    <input type="file" name="categories_image" class="form-control">
                                </div>
                                </div>
                                <div class="modal-footer">
                                <a href="category.php" class ="btn btn-secondary">Close</a>
                                <button type="submit" name="categories_update" class="btn btn-primary">Update</button>
                                </div>
                                <?php
                                endforeach ;
                            }
                            else {
                                echo "No Id Found";
                            }

                            ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



</div>
<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>