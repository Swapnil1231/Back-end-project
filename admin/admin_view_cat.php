<?php 
//=======header=====
ob_start();
include("admin_header.php");
include("admin_sidebar.php");

    
?>
<div class="content-wrapper">
                    <?php 
                        if(isset($_COOKIE['success']))
                        {
                            ?>
                            <div>
                                <p class="alert alert-success"><?php echo $_COOKIE['success'] ?></p>
                            </div>
                            <?php 
                        }
                        if(isset($_COOKIE['error']))
                        {
                            ?>
                            <div>
                                <p class="alert alert-danger"><?php echo $_COOKIE['error'] ?></p>
                            </div>
                            <?php 
                        }
                    ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">View Categories</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <?php 
                $query = mysqli_query($conn,"select * from categories");
                if(mysqli_num_rows($query) > 0)
                {
                    $resRow = mysqli_fetch_assoc($query);
                    if($resRow['category'] !== 0)
                    {

                    
            ?>
            <table class="table">
                <thead>
                    <td>
                        <th>Id</th>
                        <th>Categories</th>
                        <th>Action</th>
                    </td>
                </thead>
                <tbody>
                <?php 
                    
                    $uresult = mysqli_query($conn ,"SELECT * from categories");
                    if(mysqli_num_rows($uresult)>0)
                    {
                    $sr = 1;
                    while($urow=mysqli_fetch_assoc($uresult))
                    {
                        ?>
                        <tr>
                            <td><?php  ?></td>
                            <td><?php echo $sr; ?></td>
                            <td><?php echo $urow["category"] ?></td>
                            <td>
                                <div>
                                    <button class="btn btn-warning">
                                    <a href="admin_edit_view_cat.php?id=<?php echo $urow['id'] ?>">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    </button>
                                    <button class="btn btn-danger">
                                    <a href="admin_delete_view_cat.php?id=<?php echo $urow['id'] ?>">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php 
                        $sr++;
                    }
                    }
                    ?>
                </tbody>
            </table>
            <?php 
                    }
                }
                else
                {
                    ?>
                    <h6> No category available Please<a href="admin_add_cat.php"> Add</a>category </h6>
                    <?php
                }
            ?>
        </div>
      </div>
    </section>
</div>


  


<?php 
include("admin_footer.php");

ob_end_flush();
?>