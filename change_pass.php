<?php 
include("header.php");
if(isset($_SESSION['user_token']) && !empty($_SESSION['user_token'])) {
    $token = $_SESSION['user_token'];
    $username = $_SESSION['username'];
    $result = mysqli_query($conn, "select password, pick from users where token = '$token'");
    $row = mysqli_fetch_assoc($result);

 if(isset($_COOKIE['success']))
 {
   echo $_COOKIE['success'];
 }
 if(isset($_COOKIE['error']))
 {
   echo $_COOKIE['error'];
 }
 
 
function filturedata($data)
{
    return addslashes(strip_tags(trim($data)));
}


if (isset($_POST['update'])) {

  
    $pass = isset($_POST['pass']) ? filturedata($_POST["pass"]) : "";
    $cpass = isset($_POST['cpass']) ? filturedata($_POST["cpass"]) : "";
    $opass = isset($_POST['opass']) ? filturedata($_POST["opass"]) : "";
   
  
    //validations
    $error = [];
    
    
    if(empty($pass)) {
        $error['pass'] = 'Password is required';
    }
    elseif (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $pass)) {
      $error['pass'] = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
     }
    elseif(empty($cpass))
    {
      $error ['cpass'] = "Confirm password is required";
    }elseif($cpass !== $pass)
    {
      $error ['cpass'] = "Your passwords does not match. Try again!";
    }

    if(empty($opass))
    {
      if(!password_verify($opass,$row['password']))
      {
        $error ["oPass"] ="Old Password doesn't matched.";
      }
    }
    if(count($error) === 0 )
    {
      
      $hash_pass = password_hash($pass, PASSWORD_DEFAULT);

      $sql = "Update users set password ='$hash_pass' where token ='$token'";
      $result = mysqli_query($conn,$sql);
      
      if(mysqli_affected_rows($conn) === 1 )
      {
        
          setcookie("success","Change  password  successfully..." , time()+3);
          header("Location: regist.php");
        
      }
      else
      {
        die("<p style='color:#ff0000;'>Error in inserting user details into");
      }
    }
    else
    {
      echo "<script type='text/javascript'>alert('Please enter valid data');window.location";
    }
    

}
    ?>

   
    <h2 class="text-secondary text-center mt-1 py-4">CHANGE PASSEORD</h2>
<div class="container">
<form action="" method="post">
<?php 
if(!empty($row['pick']))
{
  ?>
<img src="uploaded/<?php echo $row['pick']?>"  height="300" width="300" alt="">
  <?php
}
?>

  <div class="mb-4">
    <label for="password" >Password:</label>
    <input type="password" name="pass" value="<?php if(!empty($pass)) echo $pass;?>" class="form-control" id="password">
    <small class="text-danger"> <?php if(isset($error['pass'])) {echo $error['pass'];}?></small>
  </div>
  <div class="mb-4">
    <label for=""   >Confirm Password:</label>
    <input type="password" value="<?php if(!empty($cpass)) echo $cpass;?>"  name="cpass" class="form-control" id="cpass">
    <small class="text-danger"> <?php if(isset($error['cpass'])) {echo $error['cpass'];}?></small>
  </div>
  <div class="mb-4">
    <label for="old password" >Old Password:</label>
    <input type="password" value="<?php if(!empty($opass)) echo $opass; ?>"  name="opass" class="form-control" id="opass">
    <small class="text-danger"> <?php if(isset($error['opass'])) {echo $error['opass'];}?></small>
  </div>
  
  
  <button  name="update" class="btn btn-danger mb-4">Change Password  </button>
</form>
</div>

<?php
include("footer.php");
}
else
{
  header("Location: login.php");
}
?>

