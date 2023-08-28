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
            <h1 class="m-0">View Blog</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <?php 
      if(isset($_REQUEST['id']) && isset($_REQUEST['status']))
      {
        $id = $_REQUEST['id'];
        $status = $_REQUEST['status'] === 'active' ? 'inactive':'active';
        $final = mysqli_query($conn,"UPDATE blogs set status='$status' where id='$id'");
        if(mysqli_affected_rows($conn)===1)
        {
            setcookie("success","Status Updated Successfully",time()+3);
            header("location: admin_view_blog.php");
        }
        else
        {
            setcookie("error","Unable to Update Status",time()+3);
            header("location: admin_view_blog.php");
        }
      }
    ?>
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
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </td>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $uresult = mysqli_query($conn ,"SELECT categories.category as catname,  blogs.*
                    FROM blogs
                    INNER JOIN categories
                    ON categories.id=blogs.category order by id DESC");
                    if(mysqli_num_rows($uresult)>0)
                    {
                    $sr = 1;
                        while($urow=mysqli_fetch_assoc($uresult))
                        {
                            ?>
                            <tr>
                                <td><?php  ?></td>
                                <td><?php echo $sr; ?></td>
                                <td><?php echo $urow["catname"] ?></td>
                                <td><?php echo $urow["title"] ?></td>
                                <td>
                                    <img src="blogUpload/<?php echo $urow["image"] ?>" height="100" width="80" alt="">
                                </td>
                                <td><?php echo $urow["created_at"] ?></td>
                                <td><?php echo $urow["status"] ?></td>
                                <td>
                                    <div class="row">
                                        <button class="btn <?php if($urow['status']==='active') echo 'btn-success'; if($urow['status'] ==='inactive') echo 'btn-danger' ?> col-4">
                                        <a href="admin_view_blog.php?id=<?php echo $urow['id'] ?> && status=<?php echo $urow['status'] ?>">
                                        <i class="fa <?php if($urow['status']==='active') echo 'fa-eye'; if($urow['status'] ==='inactive') echo 'fa-eye-slash' ?>" ></i>
                                        </button>

                                        <button class="btn btn-warning">
                                        <a href="admin_edit_blog.php?id=<?php echo $urow['id'] ?>col-4">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        </button>
                                        <button class="btn btn-danger">
                                        <a href="admin_delete_blog.php?id=<?php echo $urow['id'] ?>col-4">
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
                    else
                    {
                        ?>
                        <a href="admin_add_blog.php" ><h5><center class="text-danger">Please add a Bolgs</center></h5></a>
                        <?php
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