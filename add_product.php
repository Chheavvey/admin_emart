
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
                             Add Products
                                <a href="product.php" class ="btn btn-danger btn-sm float-right">Back</a>
                            </h4>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data" >
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label>Select Category</label>
                                            <select name="categoris_id" class="form-select" >
                                            <option selected>Select Category</option>
                                                <?php
                                                $query = "SELECT * FROM categories";
                                                $query_run = mysqli_query($con, $query);
                                                if (mysqli_num_rows($query_run) > 0) {
                                                    foreach ($query_run as $cate_items) {
                                                        ?>
                                                    <option value="<?= $cate_items['categories_id']; ?>"><?= $cate_items['categories_name'];?></option>
                                                        <?php
                                                    }
                                                }else {
                                                    echo "No category";
                                                }

                                            ?>
                                            </select>
                                         </div>
                                                <div class="form-group">
                                                    <label>Product Name</label>
                                                    <input type="text" required name="items_name" class="form-control" placeholder="Enter product name" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Product Name VN</label>
                                                    <input type="text" required name="items_name_vn" class="form-control" placeholder="Enter product name vn" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea required name="items_desc" class="form-control"  rows="3" placeholder="Enter description" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Description VN</label>
                                                    <textarea required name="items_desc_vn" class="form-control" rows="3" placeholder="Enter description vn" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Product Price</label>
                                                        <input type="number" required name="items_price" class="form-control" min="0" placeholder="Enter product price">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Product Discount</label>
                                                        <input type="number" name="items_discount" class="form-control" min="0" placeholder="Enter product discount">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Product Count</label>
                                                        <input type="number" name="items_count" class="form-control" min="0" placeholder="Enter product count">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="">Upload Image</label>
                                                    <input type="file" required name="items_image" class="form-control"  >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                <div class="form-group">
                                                    <label >Click to save</label> <br>
                                                    <button type="submit" name="product_save" class="btn btn-primary btn-block" >Save</button>
                                                    </div>
                                            </div>
                                        </div>
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
