

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="admin_index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Eterna </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php 
            if($row['pick'] !== "")
            {
              ?>
              <img src="../uploaded/<?php echo $row['pick'] ?>" alt="">
              <?php
            }
          ?>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['admin_username']?></a>
        </div>
      </div>

      <?php  

      function getData()
      {
        $arr = explode("/",$_SERVER['PHP_SELF']);
        return(end($arr));
      }
      ?>
   

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="admin_index.php" class="nav-link <?php if(getdata() === "admin_index.php") echo "active";?> ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link <?php if((getdata() === "admin_add_cat.php") || (getdata() === "admin_view_cat.php")) echo "active";?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin_add_cat.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin_view_cat.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Category</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link <?php if((getdata() === "admin_add_blog.php") || (getdata() === "admin_view_blog.php")) echo "active";?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Blogs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin_add_blog.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Blog</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin_view_blog.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Blogs</p>
                </a>
              </li>
            </ul>
          </li>
         
          
          <li class="nav-item">
            <a href="admin_users.php" class="nav-link <?php if(getdata() === "admin_users.php") echo "active";?>">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>