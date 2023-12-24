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
      <form action="code.php" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Category Name</label>
            <input type="text" name= "categories_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Category Name VN</label>
            <input type="text" name= "categories_name_vn" class="form-control">
        </div>
        <!-- <div class="form-group">
        <label for="">Category Image</label>
        <input type="file" name="categories_image" class="form-control">
    </div> -->
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
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Products</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    <section class="content mt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-14">
                  <?php include('message.php'); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-3">
                            Products
                                <a href="add_product.php" class ="btn btn-primary btn-sm float-right">Add Product</a>
                            </h4>
                            <div class="row mb-1">
                                <div class="col-sm-3 offset-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="searchInput" placeholder="Enter name, email....">
                                          <span class="input-group-text">
                                              <i class="fas fa-search"></i>
                                          </span> 
                                    </div>
                              </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th class="text-center">No</th>
                                  <th class="text-center">Categories ID</th>
                                  <th class="text-center">Name</th>
                                  <th class="text-center">Name VN</th>
                                  <th class="text-center">Description</th>
                                  <th class="text-center">Description VN</th>
                                  <th class="text-center">Image</th>
                                  <th class="text-center">Count</th>
                                  <th class="text-center">Price</th>
                                  <th class="text-center">Discount</th>
                                  <th class="text-center">Edit</th>
                                  <th class="text-center">Remove</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                    $query = "SELECT i.*, c.categories_name
                                    FROM items i
                                    LEFT JOIN categories c ON i.items_cart = c.categories_id";
                                    $query_run = mysqli_query($con, $query);
                                    if (mysqli_num_rows($query_run) > 0) 
                                    {
                                        $counter = 1;
                                        foreach ($query_run as $row) {
                                    ?>
                                  <tr>
                                        <td class="text-center"><?php echo $counter ++;?></td>
                                        <td class="text-center"><?php echo $row['categories_name'];?></td>
                                        <td><?php echo $row['items_name'];?></td>
                                        <td><?php echo $row['items_name_vn'];?></td>
                                        <td class="description-cell">
                                          <?php
                                              $itemsDesc = $row['items_desc'];
                                              $shortDesc = (strlen($itemsDesc) > 20) ? substr($itemsDesc, 0, 25) . '...' : $itemsDesc;
                                              $fullDesc = $itemsDesc;
                                          ?>
                                          <span class="short-desc"><?php echo $shortDesc; ?></span>
                                          <?php if (strlen($itemsDesc) > 10): ?>
                                              <span class="full-desc" style="display:none;"><?php echo $fullDesc; ?></span>
                                              <a href="#" class="see-more-link">See More</a>
                                          <?php endif; ?>
                                        </td>
                                        <td class="description-cell">
                                            <?php
                                                $itemsDescVN = $row['items_desc_vn'];
                                                $shortDescVN = (strlen($itemsDescVN) > 20) ? substr($itemsDescVN, 0, 25) . '...' : $itemsDescVN;
                                                $fullDescVN = $itemsDescVN;
                                            ?>
                                            <span class="short-desc"><?php echo $shortDescVN; ?></span>
                                            <?php if (strlen($itemsDescVN) > 10): ?>
                                                <span class="full-desc" style="display:none;"><?php echo $fullDescVN; ?></span>
                                                <a href="#" class="see-more-link">See More</a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                          <img src="uploads/items/<?= $row['items_image'];?> " width="120px" height="120px"  alt="<?= $row['items_image'];?>">
                                           
                                        </td>
                                        
                                        <td class="text-center"><?php echo $row['items_count'];?></td>
                                        <td class="text-center"><?php echo $row['items_price'];?>$</td>
                                        <td class="text-center"><?php echo $row['items_discount'];?>%</td>
                                        <td class="text-center">
                                            <a href="edit_product.php?items_id=<?= $row['items_id']; ?>" class="btn btn-success">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" value="<?= $row['items_id']; ?>" class="btn btn-danger delete_product_btn">
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
$(document).ready(function () {
    $(".delete_product_btn").on("click", function (e) {
        e.preventDefault();
        var items_id = $(this).val();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'items_id': items_id,
                        'delete_product_btn': true
                    },
                    success: function (response) {
                        if (response == 200) {
                            swal("Success!", "Product deleted successfully!", "success")
                                .then(() => {
                                    location.reload(true);
                                });
                        } else if (response == 500) {
                            swal("Error!", "Something went wrong!", "error");
                        }
                    }
                });
            }
        });
    });
    // Function to highlight search text in table
    var searchInput = $("#searchInput");

    // Search functionality
    searchInput.on("keyup", function () {
        var searchText = $(this).val().toLowerCase();

        $("table tbody tr").each(function () {
            var row = $(this);

            // Iterate through each cell in the row
            row.find('td').each(function () {
                var cellText = $(this).text().toLowerCase();
                var match = cellText.includes(searchText);

                // Remove previous highlighting
                $(this).html($(this).html().replace(/<span class="highlight">|<\/span>/g, ''));

                if (match) {
                    // Add span with highlight class to the matching text
                    $(this).html(cellText.replace(new RegExp(searchText, 'gi'), function (match) {
                        return '<span class="highlight">' + match + '</span>';
                    }));
                }
            });

            // Toggle row visibility
            row.toggle(row.text().toLowerCase().indexOf(searchText) !== -1);
        });
    });

    // Add event listener for input change
    searchInput.on("input", function () {
        if ($(this).val() === '') {
            // Reload the page when the input is cleared
            location.reload();
        }
    });
});


</script>
<?php include('includes/footer.php');?>