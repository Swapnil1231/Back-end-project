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

    if(isset($_REQUEST['id']) && !empty($_REQUEST['id']))
    {
        $Did = $_REQUEST['id'];

    }
 
        $username = $_SESSION['username'];
        $token = $_SESSION['user_token'];
        $adminToken = $_SESSION['admin_user_token'];
        $deldata = mysqli_query($conn,"select * from categories WHERE id = '$Did'");
        if (mysqli_num_rows($deldata) >0 )
        {
            if($row=mysqli_fetch_assoc($deldata))
            {
                $Ddata = mysqli_query($conn,"delete from categories where id = '$Did'");
                if(mysqli_affected_rows($conn) > 0)
                {
                setcookie("success" , "Category deleted successfully", time()+3);
                header("location: admin_view_cat.php");
                }
                else
                {
                 setcookie("error" , " Anable to deleted Category", time()+3);
                 header("location: admin_view_cat.php");
                }
            }
        } 
    

include("admin_footer.php");
}
else
{
    header("location: ../login.php");
}
ob_end_flush();
?>








