<?php 
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
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
              <li class="breadcrumb-item active">Registerd Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                  <div class="row">
                                      <div class="col-sm-3 offset-sm-9 mb-4 "> 
                                          <div class="input-group">
                                              <input type="text" class="form-control" id="searchInput" placeholder="Enter name, email....">
                                              <span class="input-group-text">
                                                  <i class="fas fa-search"></i>
                                              </span>
                                          </div>
                                      </div>
                                  </div>
                                <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped" >
                                <thead>
                                <tr> 
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="text-center">Phone Number</th>
                                    <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query = "SELECT * FROM users";
                                    $query_run = mysqli_query($con, $query);
                                    if (mysqli_num_rows($query_run) > 0) 
                                    {
                                        $counter = 1;
                                        foreach ($query_run as $row) {
                                    ?> 
                                    <tr>
                                        <td><?php echo $counter ++;?></td>
                                        <td><?php echo $row['users_name'];?></td>
                                        <td><?php echo $row['users_email'];?></td>
                                        <td class="text-center"><?php echo $row['users_phone'];?></td>
                                        <td class="text-center">
                                            <button type="button" value="<?php echo $row['users_id'];?>" class="btn btn-danger btn-sm deletebtn">Remove</button>

                                        </td>
                                    </tr>       
                                    <?php
                                        }

                                    } else{

                                    }

                                    ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/script.php');?>
<script>
$(document).ready(function () {
    $(".deletebtn").on("click", function (e) {
        e.preventDefault();
        var users_id = $(this).val();
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
                    url: "delete_user.php",
                    data: {
                        'users_id': users_id,
                        'deletebtn': true
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
    $("#searchInput").on("keyup", function () {
            var searchText = $(this).val().toLowerCase();

            $("table tbody tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
            });
        });

});
</script>

<?php include('includes/footer.php');?>