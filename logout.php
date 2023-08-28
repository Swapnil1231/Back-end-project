<?php 
session_start();
if(isset($_SESSION['user_token']) && !empty($_SESSION['user_token']))
{
    session_unset();
    session_destroy();
    header("Location: login.php");
}
else
{
    header("Location: login.php");
}
?>