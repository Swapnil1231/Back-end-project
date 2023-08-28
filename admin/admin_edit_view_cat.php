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
        if(isset($_REQUEST['id']) && !empty($_REQUEST['id']))
        {
            $catId = $_REQUEST['id'];
    
            $catData = mysqli_query($conn,"SELECT category From categories where id='$catId'");
            mysqli_affected_rows($conn);
            $catRow = mysqli_fetch_assoc($catData);
        }

    function filturedata($data)
    {
        return addslashes(strip_tags(trim($data)));
    }
        
    if(isset($_POST['update']))
    {
        $err=[];
        $cat = isset($_POST['category']) ? filturedata($_POST['category']) : '';
        $id = isset($_POST['category']) ? filturedata($_POST['category']) : '';

        if(empty($cat))
        {
            $err['cat'] ="Category is required";
        }
        else
        {
            mysqli_query($conn,"update categories set category='$cat'where id='$catId'");
            if(mysqli_affected_rows($conn)===1)
            {
                setcookie('success','Category Updated Successfully',time()+3);
                header("location: admin_view_cat.php");
            }
            else
            {
                setcookie('error','Unable to Updated',time()+3);
                header("location: admin_view_cat.php");
            }
        }
    }
?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Category</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <form action="" method="post">
        <div class="mb-3">
            <label for="" >Edit Category</label>
            <input type="text" value="<?php echo $catRow['category'] ?>" class="form-control" name="category" >
            <small class="text-danger"><?php if(isset($err)) echo $err['cat'];?></small>
        </div>
        <div class="mb-3">
        <input type="submit" value="Update" class="btn btn-success" name="update" >
        </div>
      </form>
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