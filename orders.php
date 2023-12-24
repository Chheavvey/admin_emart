<?php 
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

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
                <li class="breadcrumb-item active">New Orders</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    <section class="content mt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Orders</h4>
                        </div>
                        <!-- <div class="card-body"> -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Order ID</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Order Type</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Payment Method</th>
                                        <th class="text-center">Order Status</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT o.*, u.users_name, a.address_street, a.address_city
                                              FROM orders o 
                                              INNER JOIN users u ON o.orders_usesrid = u.users_id 
                                              LEFT JOIN address a ON o.orders_address = a.address_id
                                              WHERE o.orders_status ='0'";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        $counter = 1;
                                        foreach ($query_run as $row) {
                                    ?>
                                            <tr>
                                                <td class="text-center"><?php echo $counter++; ?></td>
                                                <td class="text-center">Order  #<?php echo $row['orders_id']; ?></td>
                                                <td class="text-center"><?php echo $row['users_name']; ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($row['address_street'] && $row['address_city']) {
                                                        echo $row['address_street'] . '  ' . $row['address_city'];
                                                    } else {
                                                        echo 'No address available';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center"><?php echo ($row['orders_type'] == 0) ? 'Delivery' : 'Receive'; ?></td>
                                                <td class="text-center"><?php echo $row['orders_totalprice']; ?> $</td>
                                                <td class="text-center"><?php echo ($row['orders_paymentmethod'] == 0) ? 'Cash' : 'Payment Card'; ?></td>
                                                <td class="text-center">
                                                    <a href="view_orders.php?orders_id=<?= $row['orders_id']; ?>" class="btn btn-primary">
                                                        <i class="fas fa-eye"></i> View Details
                                                    </a>
                                                </td>
                                                
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "No records found";
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

<?php include('includes/script.php'); ?>
