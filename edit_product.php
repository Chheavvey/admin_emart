
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

                  <?php 
                  if(isset($_GET['items_id']))
                  {
                    $items_id =$_GET['items_id'];
                    $query = " SELECT * FROM items WHERE items_id = '$items_id' ";
                                $query_run = mysqli_query($con, $query);

                             if(mysqli_num_rows($query_run)>0)
                             {
                                $data = mysqli_fetch_array($query_run);
                            ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                    Edit Product
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
                                                            <option value="<?= $cate_items['categories_id']; ?>" <?=$data['items_cart']== $cate_items['categories_id']?'selected':'' ?>  ><?= $cate_items['categories_name'];?></option>
                                                                <?php
                                                            }
                                                        }else {
                                                            echo "No category";
                                                        }

                                                    ?>
                                                        <input type="hidden" name="items_id" value=" <?= $data['items_id']?>">

                                                    </select>
                                                </div>
                                                        <div class="form-group">
                                                            <label>Product Name</label>
                                                            <input type="text" required name="items_name" value="<?= $data['items_name'] ?>" class="form-control" placeholder="Enter product name" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Product Name VN</label>
                                                            <input type="text" required name="items_name_vn" value="<?= $data['items_name_vn']?>" class="form-control" placeholder="Enter product name vn" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea required name="items_desc" class="form-control"  rows="3" placeholder="Enter description" ><?= $data['items_desc']?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Description VN</label>
                                                            <textarea required name="items_desc_vn" value="<?= $cateitem['items_desc_vn']?>" class="form-control" rows="3" placeholder="Enter description vn" ><?= $data['items_desc_vn']?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Product Price</label>
                                                            <input type="text" required name="items_price" value="<?= $data['items_price']?>" class="form-control" required placeholder="Enter product price" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Product Discount</label>
                                                            <input type="text" name="items_discount" value="<?= $data['items_discount']?>" class="form-control" required placeholder="Enter product discount" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Product Count</label>
                                                            <input type="text" name="items_count" value="<?= $data['items_count']?>" class="form-control" required placeholder="Enter product count" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="">Upload Image</label>
                                                            <input type="hidden" name="old_image" value="<?= $data['items_image']?>">
                                                            <input type="file" name="items_image" class="form-control"  >
                                                            <label for="">Current Image</label>
                                                            <img src="uploads/items/<?= $data['items_image']?> " width="80px" height="80px" alt="Image">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label >Click to save</label> <br>
                                                            <button type="submit" name="edit_product" class="btn btn-primary btn-block" >Update</button>
                                                            </div>
                                                </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                         <?php
                        }
                   
                  }
                  else
                  {
                    echo "Id missing form url";
                  }
                  ?>
                 </div>
            </div>
        </div>
    </section>
</div>

<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>
