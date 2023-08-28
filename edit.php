<?php 
include("header.php");
if(isset($_SESSION['user_token']) && !empty($_SESSION['user_token'])) {
    include('dbconn.php');
    $token = $_SESSION['user_token'];
    $username = $_SESSION['username'];
    $result = mysqli_query($conn, "select username,mobile,city,pick from users where token = '$token'");
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

        $name = isset($_POST['uname']) ? filturedata($_POST["uname"]) : "";
        $mobile = isset($_POST['mobile']) ? filturedata($_POST["mobile"]) : "";
        $city = isset($_POST['city']) ? filturedata($_POST["city"]) : "";
        $error = [];
        if(empty($name)) 
        {
            $error['uname'] = "Name is required";
        } 
        elseif(strlen($name)<3) 
        {
            $error['uname'] ="Name must be at least three characters long.";
        } 
        elseif(! preg_match("/^[a-zA-z]*$/", $name)) 
        {
            $error['uname'] ="Only letters are allowed in the username field!";
        } 
        elseif(empty($mobile))
        {
          $error ['mobile'] = "Mobile number is required";
        }
        elseif(strlen($mobile)!== 10 )
        {
          $error ['mobile'] = "Enter correct mobile no ";
        }
        elseif(!preg_match('/^[0-9]{10}+$/', $mobile))
        {
            $error['mobile'] = "Enter valid mobile number";
        }
        elseif(empty($city))
        {
          $error ['city'] = "Must have to select the City";
        } 
        else
        {
            mysqli_query($conn, "update users set username = '$name', mobile='$mobile',city='$city' where token='$token'");
            if(mysqli_affected_rows($conn)) 
            {
                setcookie("success", "<p class='alert alert-success text-center'>Data updated successfully</p>", time()+3);
                header("Location: edit.php");
            } 
            else
            {
                setcookie("error", "<p class='alert alert-danger text-center'>Unable to updated data! fill the appropriate information</p>", time()+3);
                header("Location: edit.php");
            }
       }    

    }
    ?>
   
    <h2 class="text-secondary text-center pt-3">EDIT PROFILE</h2>
    
<div class="container py-5">
<?php 
    if($row['pick'] !== "")
    {
      ?>
      <img src="uploaded/<?php echo $row['pick']?>" height="300" width="300" alt="">
    <?php
    }
    ?>
<form action="" method="post">
  <div class="mb-4">
    <label for="username">Username:</label>
    <input type="text" name="uname" value="<?php echo (isset($name)) ? $name : $row['username']; ?>" class="form-control" id="username">
    <small class="text-danger"> <?php if(isset($error['uname'])) {echo $error['uname'];}?></small>
  </div>
  
  <div class="mb-4">
    <label for="mobile" >Mobile:</label>
    <input type="text" value="<?php echo (isset($mobile)) ? $mobile : $row['mobile']; ?>"  name="mobile" class="form-control" id="mobile">
    <small class="text-danger"> <?php if(isset($error['mobile'])) {echo $error['mobile'];}?></small>
  </div>
  <div class="mb-4">
    <label for="">City:</label>
    <select name="city" id="">
        <option value="" selected disabled>Select City</option>
        <option <?php if(isset($city)) {
            if($city === ' PARBHANI') {
                echo 'selected';
            }
        } if($row['city'] === 'PARBHANI') {
            echo 'selected';
        } ?> value="PARBHANI" >PARBHANI</option>
        <option <?php if(isset($city)) {
            if($city === 'GOA') {
                echo 'selected';
            }
        } if($row['city'] === 'GOA') {
            echo 'selected';
        } ?> value="GOA">GOA</option>
        <option <?php if(isset($city)) {
            if($city === 'BANGALOR') {
                echo 'selected';
            }
        }if($row['city'] === 'BANGALOR') {
            echo 'selected';
        } ?> value="BANGALOR">BANGALOR</option>
       <option <?php if(isset($city)) {
            if($city === 'PUNE') {
                echo 'selected';
            }
        }if($row['city'] === 'PUNE') {
            echo 'selected';
        } ?> value="PUNE">PUNE</option>
        <option <?php if(isset($city)) {
            if($city === 'MUMBAI') {
                echo 'selected';
            }
        }if($row['city'] === 'MUMBAI') {
            echo 'selected';
        } ?> value="MUMBaI">MUMBAI</option>
    </select>
    <small class="text-danger"> <?php if(isset($error['city'])) {
        echo $error['city'];
    }?></small>
  </div>
    <div class="py-4">
        <button type="update" name="update" class="btn btn-danger">EDIT <i class="fa fa-edit"></i></button>
    </div>
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

