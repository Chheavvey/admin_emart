<?php 
session_start();
include('config/dbcon.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('functions/myfunction.php')

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
              <li class="breadcrumb-item active">View Orders</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <section class="content mt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <?php include('message.php'); ?>
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="mb-3">
                                View Orders
                            </h4>
                            <a href="cancel_order.php" class ="btn btn-danger btn-sm float-right">Back</a>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_GET['orders_id'])) {
                                $orders_id = $_GET['orders_id'];
                                $query = "SELECT ov.*, u.*
                                        FROM ordersview ov
                                        LEFT JOIN users u ON ov.orders_usesrid = u.users_id
                                        WHERE ov.orders_id = '$orders_id'";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    $data = mysqli_fetch_array($query_run);
                                    ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Delivery Details</h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12 mb-2">
                                                    <label class="fw-bold">Name</label>
                                                    <div class="border p-2">
                                                        <?= $data['users_name'] ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label class="fw-bold">Email</label>
                                                    <div class="border p-2">
                                                        <?= $data['users_email'] ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label class="fw-bold">Phone</label>
                                                    <div class="border p-2">
                                                        <?= $data['users_phone'] ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label class="fw-bold">Delivery type</label>
                                                    <div class="border p-2">
                                                        <?php
                                                        if ($data['orders_type'] == 0) {
                                                            echo 'Delivery';
                                                        } elseif ($data['orders_type'] == 1) {
                                                            echo 'Receive';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php if ($data['orders_type'] == 0): ?>
                                                    <div class="col-md-12 mb-2">
                                                        <label class="fw-bold">Address</label>
                                                        <div class="border p-2">
                                                            <?= $data['address_street'] . '  ' . $data['address_city'] ?>
                                                        </div>
                                                    </div> 
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php
                                } else {
                                    echo "No records found";
                                }
                            } else {
                                echo "Id missing from URL";
                            }
                            ?>    
                                <div class="col-md-6">
                                <h4>Order Details</h4>
                                <hr>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                           
                                                $query = "SELECT od.*, i.items_image, i.items_name
                                                            FROM ordersdetailsview od
                                                            INNER JOIN items i ON od.items_id = i.items_id
                                                            WHERE od.orders_id = '$orders_id'";
                                                $query_run = mysqli_query($con, $query);

                                                if (mysqli_num_rows($query_run) > 0) {
                                                    foreach ($query_run as $orders) {
                                                        ?>
                                                        <tr>
                                                            <td class="align-middle">
                                                                <img src="uploads/items/<?= $orders['items_image'] ?>" width="80px" height="80px" alt="">
                                                                <?= $orders['items_name'] ?>
                                                            </td>
                                                            <!-- Include Price and Quantity columns based on your database structure -->
                                                            <td class="align-middle"><?= $orders['totalitemsdiscount'] ?> $</td>
                                                            <td class="align-middle"><?= $orders['countitems'] ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    echo "No record found";
                                                }
                                            
                                            ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div class="col-md-9 mb-3">
                                        <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Coupon Discount
                                                <span class="fw-bold"><?= $orders['orders_coupondiscount'] ?> %</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Delivery
                                                <span class="fw-bold"><?= $orders['orders_pricedelivery'] ?> $</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Total Price
                                                <span class="fw-bold"><?= $orders['orders_totalprice'] ?> $</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <label class="fw-bold">Status</label>
                                        <?php
                                            $status = $orders['orders_status'];

                                            if ($status == 0) {
                                                $statusText = 'Under Process';
                                                $statusClass = 'text-white bg-primary';
                                            } elseif ($status == 1) {
                                                $statusText = 'Orders Completed';
                                                $statusClass = 'text-white bg-success';
                                            } elseif ($status == 2) {
                                                $statusText = 'Cancelled Orders';
                                                $statusClass = 'text-white bg-danger';
                                            } else {
                                                $statusText = 'Unknown Status';
                                                $statusClass = 'text-muted bg-light';
                                            }
                                            ?>
                                        <p class="p-3 mb-3 text-center border<?php echo $statusClass; ?>"><?php echo $statusText; ?></p>     
                                  </div> 
                             </div>
                          </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>