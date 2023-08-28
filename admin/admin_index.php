
<?php include("admin_header.php"); ?>

  <!-- Main Sidebar Container -->
  <?php include("admin_sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php 
    $data = mysqli_query($conn,"SELECT count(id) as id from categories");
    if(mysqli_num_rows($data)>0)
    {
      $row=mysqli_fetch_assoc($data);
    }
    ?>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <h3><?php echo $row['id'] ?></h3>
              
                <p>Categories</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="admin_view_cat.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <?php
            $blogdata = mysqli_query($conn,"SELECT count(id) as id from blogs");
            if(mysqli_num_rows($blogdata)>0)
            $bdatarow = mysqli_fetch_assoc($blogdata)
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $bdatarow['id'] ?></h3>

                <p>Total Blogs</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="admin_view_blog.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <?php 
                $result_users = mysqli_query($conn,"select count(id) as id from users");
                if(mysqli_num_rows($result_users)>0)
                {
                  $totalusers = mysqli_fetch_assoc($result_users);
                  ?>
                  <h3><?php echo $totalusers['id']; ?></h3>
                  <?php
                }
                else
                {
                  echo "0";
                }

                ?>

                

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="admin_users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("admin_footer.php");?>