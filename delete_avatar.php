<?php 

include("header.php");
if(isset($_SESSION['user_token']) && !empty($_SESSION['user_token']))
{
    if(isset($_COOKIE['success']))
    {
        echo $_COOKIE['success'];
    }
    if(isset($_COOKIE['error']))
    {
        echo $_COOKIE['error'];
    }

    $username = $_SESSION['username'];
    $token = $_SESSION['user_token'];
    $result = mysqli_query($conn, "select username,mobile,city,pick from users where token = '$token'");
    if(mysqli_num_rows($result))
    {
        $row = mysqli_fetch_assoc($result);
        if($row['pick'] !== "")
        {
            $delete =mysqli_query($conn,"UPDATE users SET pick = NULL WHERE token ='$token'");
            if(mysqli_affected_rows($conn))
            {
               
                setcookie("success","Profile deleted successfully",time()+3);
                header("location: home.php");
            }
            else
            {
                setcookie("error","Something went wrong",time()+3);
                header("location: home.php");
            }
        
        }
        else
        {
            header("location:upload.php");
        }
    }
    else
    {
        echo "data is here";
    }
}
else
{
    header("location: login.php");
}

?>