<?php 
//=======header=====
ob_start();
include("admin_header.php");
include("admin_sidebar.php");
if(isset($_SESSION['admin_user_token']) && !empty($_SESSION['admin_user_token'])) 
{   include("../dbconn.php");
    $username = $_SESSION['username'];
    $token = $_SESSION['user_token'];
    $adminToken = $_SESSION['admin_user_token'];
    $adminresult = mysqli_query($conn, "SELECT id,username,email,city, mobile,created_at,pick from users where token='$token'");
    $row = mysqli_fetch_assoc($adminresult);


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
            <h1 class="m-0">All Users</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <table class="table">
                <thead>
                    <td>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Joined ON</th>
                        <th>Action</th>
                    </td>
                </thead>
                <tbody>
                    
                    
                    <?php 
                    
                    if(isset($_REQUEST['token']) && !empty($_REQUEST['token']))
                    {
                        $token = $_REQUEST['token'];
                        $status = ($_REQUEST['status']==='active') ? 'inActive' : 'active';

                        mysqli_query($conn,"Update users set status='$status' where token='$token'");
                        if(mysqli_affected_rows($conn))
                        {
                            setcookie("success","User status Updated",time()+3);
                            header("location:admin_users.php");
                        }
                        else
                        {
                            setcookie("error","Unable to update ststus",time()+3);
                            header("location:admin_users.php");
                        }
                    }
                    ?>
                <?php 
                    
                    $uresult = mysqli_query($conn ,"SELECT * from users order by created_at DESC");
                    if(mysqli_num_rows($uresult)>0)
                    {
                    $sr = 1;
                    while($urow=mysqli_fetch_assoc($uresult))
                    {
                        ?>
                        <tr>
                            <td><?php echo $sr; ?></td>
                            <td><?php echo $urow["username"] ?></td>
                            <td><?php echo $urow["email"] ?></td>
                            <td><?php echo $urow["mobile"] ?></td>
                            <td><?php echo $urow["city"] ?></td>
                            <td><?php echo $urow["status"] ?></td>
                            <td><?php echo $urow["created_at"] ?></td>
                            <td>
                                <?php 
                                if($urow['status'] ==='active')
                                {
                                    ?>
                                   <a href="admin_users.php?token=<?php echo $urow['token'];?>&status=<?php echo $urow['status']; ?>"><button class="bt btn-danger"> InActive</button></a>
                                    <?php 
                                }
                                else
                                {
                                    ?>
                                    <a href="admin_users.php?token=<?php echo $urow['token'];?>&status=<?php echo $urow['status']; ?>"><button class="btn btn-success"> Active</button></a>
                                    <?php 
                                }
                                ?>
                            </td>
                            
                        </tr>
                        <?php 
                        $sr++;
                    }
                    }
                    ?>
                </tbody>
            </table>
        </div>
      </div>
    </section>
</div>
<?php 
include("admin_footer.php");
}
else
{
    header("location: ../login.php");
}
ob_end_flush();
?>