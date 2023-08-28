<?php 
//=======header=====
ob_start();
include("admin_header.php");
include("admin_sidebar.php");

    if(isset($_REQUEST['id']) && !empty($_REQUEST['id']))
    {
        $Did = $_REQUEST['id'];
        $deldata = mysqli_query($conn,"select * from blogs WHERE id = '$Did'");
        if (mysqli_num_rows($deldata) >0 )
        {
            if($row=mysqli_fetch_assoc($deldata))
            {
                $Ddata = mysqli_query($conn,"delete from blogs where id = '$Did'");
                if(mysqli_affected_rows($conn)  === 1)
                {
                setcookie("success" , "Category deleted successfully", time()+3);
                header("location: admin_view_blog.php");
                }
                else
                {
                 setcookie("error" , " Anable to deleted Category", time()+3);
                 header("location: admin_view_blog.php");
                }
            }
        } 

    }
        
    

include("admin_footer.php");

ob_end_flush();
?>








