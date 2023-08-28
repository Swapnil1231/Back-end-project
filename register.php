<?php 
include("header.php");

if(isset($_POST['login']))
{
  header("Location: login.php");
}

 if(isset($_COOKIE['success']))
 {
   echo "<center class='alert alert-success'>".$_COOKIE['success']."</center>";
 }
 if(isset($_COOKIE['error']))
 {
  echo "<center class='alert alert-danger'>".$_COOKIE['error']."</center>";
 }
 
 
function filturedata($data)
{
    return addslashes(strip_tags(trim($data)));
}


if (isset($_POST['register'])) {

    $name = isset($_POST['uname']) ? filturedata($_POST["uname"]) : "";
    $email = isset($_POST['email']) ? filturedata($_POST["email"]) : "";
    $pass = isset($_POST['pass']) ? filturedata($_POST["pass"]) : "";
    $cpass = isset($_POST['cpass']) ? filturedata($_POST["cpass"]) : "";
    $mobile = isset($_POST['mobile']) ? filturedata($_POST["mobile"]) : "";
    $city = isset($_POST['city']) ? filturedata($_POST["city"]) : "";
  
    //validations
    $error = [];
    if(empty($name)) {
        $error['uname'] = "Name is required";
    } elseif(strlen($name)<3) {
        $error['uname'] ="Name must be at least three characters long.";
    } elseif(! preg_match("/^[a-zA-z]*$/", $name)) {
        $error['uname'] ="Only letters are allowed in the username field!";
    } 

    elseif(empty($email)) {
      $error['email'] = ' Email is required';
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
        $error['email'] ="Invalid email address format! Please enter a valid one.";
    }elseif(empty($email)) {
        $error['email'] = ' Email is required';
    }
    
    elseif(empty($pass)) {
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
    }elseif(empty($mobile))
    {
      $error ['mobile'] = "Mobile number is required";
    }elseif(strlen($mobile)!== 10 )
    {
      $error ['mobile'] = "Enter correct mobile no ";
    }elseif(!preg_match('/^[0-9]{10}+$/', $mobile))
    {
        $error['mobile'] = "Enter valid mobile number";
    }
    elseif(empty($city))
    {
      $error ['city'] = "Must have to select the City";
    } 

    if(count($error) === 0 )
    {
      $token = md5(str_shuffle("qwertzuiopasdfghjklyxcvbnm".time().$mobile));
      $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
      $sql = "INSERT INTO users(username,email,password,mobile,city,token) VALUES('$name','$email','$hash_pass','$mobile','$city','$token')";
      $result = mysqli_query($conn,$sql);
      if(mysqli_affected_rows($conn) === 1 )
      {
        setcookie("success","Account is created successfully" , time()+3);
        header("Location: register.php");
      }
      else
      {
        setcookie("error","Unable to Create Account! Try again latter or Contack to Support team" , time()+3);
        header("Location: register.php");
      }
    }
  }
//
 //name , email, pass, cpass , mobile, city , created, status ,IP, token
?>
<h2 class="text-secondary text-center py-4">Registration</h2>
<div class="container">
<form action="" method="post">
  <div class="mb-4">
    <label for="username">Username:</label>
    <input type="text" name="uname" value="<?php if(!empty($name)) echo $name; ?>" class="form-control" id="username">
    <small class="text-danger"> <?php if(isset($error['uname'])) {echo $error['uname'];}?></small>
  </div>
  <div class="mb-4">
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php if(!empty($email)) echo $email; ?> "class="form-control" id="email">
    <small class="text-danger"> <?php if(isset($error['email'])) {echo $error['email'];}?></small>
  </div>
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
    <label for="mobile" >Mobile:</label>
    <input type="text" value="<?php if(!empty($mobile)) echo $mobile; ?>"  name="mobile" class="form-control" id="mobile">
    <small class="text-danger"> <?php if(isset($error['mobile'])) {echo $error['mobile'];}?></small>
  </div>
  <div class="mb-4">
    <label for="">City:</label>
    <select name="city" id="">
        <option value="" selected disabled>Select City</option>
        <option <?php if(isset($city)) if($city === 'PARBHANI') echo 'selected';?> value="PARBHANI" >PARBHANI</option>
        <option <?php if(isset($city)) if($city === 'GOA') echo 'selected';?> value="GOA">GOA</option>
        <option <?php if(isset($city)) if($city === 'BANGALOR') echo 'selected';?> value="BANGALOR">BANGALOR</option>
        <option <?php if(isset($city)) if($city === 'PUNE') echo 'selected';?> value="PUNE">PUNE</option>
        <option <?php if(isset($city)) if($city === 'MUMBAI') echo 'selected';?> value="MUMBAI">MUMBAI</option>
    </select>
    <small class="text-danger"> <?php if(isset($error['city'])) {echo $error['city'];}?></small>
  </div>
  <div class="mb-5">
  <button type="submit" name="register" class="btn btn-danger">Register</button>
  <button type="login" name="login" class="btn btn-danger">Login</button>
  </div>
</form>
</div>


<?php 
include("footer.php");
?>