<?php

if(isset($_REQUEST['token']) && !empty($_REQUEST['token']))
{
  $token = $_REQUEST['token'];
  
  include('dbconn.php');
  $result =mysqli_query ($conn,"SELECT username,status FROM users where token='$token' ");
  if(mysqli_num_rows($result) === 1)
  {
    if($row =mysqli_fetch_assoc($result))
    {
      if($row['status']==='inactive')
      {
        mysqli_query($conn, "UPDATE users SET status='active' WHERE token='$token'");
        if(mysqli_affected_rows($conn))
        {
          echo "Your account is activated successfully<br><br>welcome ".$row['username']."<br><br>please <a href='login.php'>Login</a>";
        }
        else
        {
          echo"Something went wrong please try again later.";
        }
      }
      else
      {
        echo "Dear ".$row['username']."<br><br>Your account is allready activeted. please <a href='login.php'>Login</a> your account";
      }  
    }
    else
    {
      echo "Invalid Token";
    }
  }
  else
  {
    echo 'No user found';
  }
 

  mysqli_close($conn);
}
else
{
  include("header.php");
  echo "<h1 style='margin: 300px; padding-left : 200px' >You don't have a permission to access this page</h1>";

}


?>
