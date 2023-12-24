<?php 
include('config/dbcon.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');

?>

<div class="modal fade" id="CategoryModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data" >
      <div class="modal-body">
        <div class="form-group">
            <label for="">Category Name</label>
            <input type="text" name= "categories_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Category Name VN</label>
            <input type="text" name= "categories_name_vn" class="form-control">
        </div>
        <div class="form-group">
        <label for="">Category Image</label>
        <input type="file" name="categories_image" class="form-control">
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="categories" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-1">
                  <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Category</li>
                    </ol>
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
              

    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                            Categories
                                <a href="#" data-toggle="modal" data-target="#CategoryModel" class ="btn btn-primary btn-sm float-right">Add category</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th class="text-center">No</th>
                                  <th class="text-center">Categories Name</th>
                                  <th class="text-center">Categories Name VN</th>
                                  <th class="text-center">Edit</th>
                                  <th class="text-center">Delete</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                    $query = "SELECT * FROM categories";
                                    $query_run = mysqli_query($con, $query);
                                    if (mysqli_num_rows($query_run) > 0) 
                                    {
                                        $counter = 1;
                                        foreach ($query_run as $row) {

                                    ?>
                                <tr>
                                  <td class="text-center"><?php echo $counter++; ?></td>
                                  <td><?php echo $row['categories_name']; ?></td>
                                  <td><?php echo $row['categories_name_vn']; ?></td>
                                  <td class="text-center">
                                      <a href="category_edit.php?categories_id=<?= $row['categories_id']; ?>" class="btn btn-success">
                                          <i class="fas fa-edit"></i> Edit
                                      </a>
                                  </td>
                                  <td class="text-center">
                                      <button type="button" value="<?= $row['categories_id']; ?>" class="btn btn-danger delete_cate_btn">
                                          <i class="fas fa-trash"></i> Delete
                                      </button>
                                  </td>
                              </tr>

                                <?php
                                        }

                                    } else{
                                      echo "No record found";

                                    }

                                    ?>
                              </tbody>
                            </table>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>
<?php include('includes/script.php');?>
<script>
$(document).ready(function(){
    $(".delete_cate_btn").on("click", function(){
        if (confirm("Are you sure you want to remove this category?")) {
            var categories_id = $(this).val();           
            // Send an AJAX request to delete the user
            $.ajax({
                url: 'delete_user.php', // replace with the actual file handling the delete operation
                type: 'POST',
                data: { categories_id: categories_id },
                success: function(response){
                    // Handle the response (e.g., refresh the table)
                    console.log(response);
                    location.reload(true);
                },
                error: function(error){
                    console.error(error);
                }
            });
        }
    });
});
</script>
<?php include('includes/footer.php');?>