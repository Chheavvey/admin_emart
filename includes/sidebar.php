<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/dist/img/logo.png" class="img-circle elevation-1" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php" class="d-block">E-mart</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Dashboard Link -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard 
              </p>
            </a>
          </li>

          <!-- Collection Group -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Collection
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- Category Link -->
              <li class="nav-item">
                <a href="category.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <!-- Products Link -->
              <li class="nav-item">
                <a href="product.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>  
            </ul>
          </li>

          <!-- Orders Group -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- New Orders Link -->
              <li class="nav-item">
                <a href="orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Orders</p>
                  <span class="right badge badge-danger">New</span>
                </a>
              </li>
              <!-- Completed Orders Link -->
              <li class="nav-item">
                <a href="completed_orders.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="cancel_order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cancel Orders</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Setting Section Header -->
          <li class="nav-item nav-header">Setting</li>

          <!-- Admin Profile Link -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-user-circle"></i>
              <p>
                Admin Profile
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>

          <!-- Register User Link -->
          <li class="nav-item">
            <a href="regiser.php" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Register User
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
