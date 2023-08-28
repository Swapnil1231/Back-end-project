<?php 
include("header.php");
if(isset($_POST['register']))
{
  header("Location: register.php");
}

if(isset($_SESSION['user_token']) && !empty($_SESSION['user_token'])) {
    $username = $_SESSION['username'];
    $token = $_SESSION['user_token'];
    $result = mysqli_query($conn, "select username,mobile,city,pick from users where token = '$token'");
    $row = mysqli_fetch_assoc($result);

    header("location: home.php?token='$token'");
    
}

 
function filturedata($data)
{
    return addslashes(strip_tags(trim($data)));
}


if (isset($_POST['login'])) {
    $email = isset($_POST['email']) ? filturedata($_POST["email"]) : "";
    $pass = isset($_POST['pass']) ? filturedata($_POST["pass"]) : "";
    $error = [];
    if(empty($email)) {
        $error['email'] = ' Email is required';
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
        $error['email'] ="Invalid email address format! Please enter a valid one.";
    } elseif(empty($email)) {
        $error['email'] = ' Email is required';
    } elseif(empty($pass)) {
        $error['pass'] = 'Password is required';
    }

    if(count($error) ===0) 
    {
      $result = mysqli_query($conn, "SELECT id, username,password,token,status,role from users Where email = '$email'") ;
      if(mysqli_num_rows($result) ===1) 
      {
        if($row = mysqli_fetch_assoc($result)) 
        {
          if(password_verify($pass, $row['password'])) 
          {
            if($row['status'] ==="active") 
            {
              $_SESSION['username']=  $row['username'];
              $_SESSION['user_token']=  $row['token'];
              
              if($row['role'] === "user")
              {
                header('location: home.php');
              }
              else if($row['role'] === "admin")
              {
                $_SESSION['admin_username']=  $row['username'];
                $_SESSION['admin_user_token']=  $row['id'];
                header("Location: admin/admin_index.php");
              }
            } 
            else
            {
              echo"Your account is Inactive! Please activate your account.";
            }
          } 
          else      
          {
            $error['pass'] = "Incorrect Password!";
          }
        }  
        else
        {
          $error['email']="<p style='color:red;'>something went wrong!</p>";
        }
      } 
      else
      {
        $error['email']="<p style='color:red;'>User does not exist!</p>";
      }

    }
  }      

 //name , email, pass, cpass , mobile, city , created, status ,IP, token
?>

<div class="container mb-4">
<form action="" method="post" class="form-border">
<h2 class="text-secondary text-center py-4">LOGIN</h2>
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
  <div class="mb-5">
    
  <input type="submit" name="login" value="Login" class="btn btn-danger">
  <input type="submit"  name="register" value="Register" class="btn btn-danger">

  </div>

  </form>
  </div>

  <?php 
  include("footer.php");
  ?>