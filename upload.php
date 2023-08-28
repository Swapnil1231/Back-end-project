<?php 
 include("header.php");

if(isset($_POST['delete_pick']))
{
  header("location: delete_avatar.php");
}


if(isset($_SESSION['user_token']) && !empty($_SESSION['user_token'])) {
    $token = $_SESSION['user_token'];
    $username = $_SESSION['username']; 
    $result = mysqli_query($conn, "select username,mobile,city, pick from users where token = '$token'");
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


    if (isset($_POST['upload'])) 
    {
      
      $filename = $_FILES ['avatar'] ['name'];
      $filetype = $_FILES ['avatar'] ['type'];
      $tmp_name = $_FILES ['avatar'] ['tmp_name'];
      $filesize = $_FILES ['avatar'] ['size'];

      if(is_uploaded_file($tmp_name))
      {
        $allowedTypes = ["png","jpg","jpeg","gif","tiff"];
        $ext = pathinfo($filename,PATHINFO_EXTENSION);
        if(in_array($ext,$allowedTypes))
        {
          if($filesize <= 10000000)
          {
            if(file_exists("uploaded/".$filename))
            {
              $str = md5(substr(str_shuffle("qwertzuiopljhgfdsayxcvbnm"),10,20));
              $filename = $str."_".time()."_".$filename;
            }

            if(move_uploaded_file ($tmp_name,"uploaded/".$filename))
            {
              mysqli_query($conn,"update users set pick ='$filename' where token='$token'");
              if(mysqli_affected_rows($conn) ===1)
              {
                setcookie("success","<p class='text-success'>Uploaded successfully</p>",time()+3);
                header("Location: upload.php");
              }
              else
              {
                setcookie("error","<p class='text-danger'>No data found</p>",time()+3);
                header("Location: upload.php");
              }
            }
            else
            {
              "<p class='text-danger'> Error in uploading! Please try again latter!</p>";
            }
          }
          else
          {
            echo "<p class='text-danger'>File size should be less than or equal to 1MB</p>";
          }
        }
        else
        {
          echo "<p class='text-danger'>Invalid File Type </p>";
        }
      }
      else
      {
        echo "<p class='text-danger'>Please select the file! </p>";
      }
    }
    ?>
   
    <h2 class="text-secondary text-center mt-3">UPLOAD PROFILE</h2>
<div class="container">
<?php 
    if($row['pick'] !== "")
    {
    ?>
      <div class="container ">
          <div class="col  mb-5  mt-5 pr-4">
            <img src="uploaded/<?php echo $row['pick']?>"  height="300" width="300" alt="">
          </div>
      </div>
    <?php
    }
?>
<form action="" method="post" enctype="multipart/form-data">
  <div class="mb-4">
    <label for="username">Choose file :</label>
    
    <input type="file" name="avatar"  class="form-control" id="username">
    <small class="text-danger"></small>
  </div class="py-4">
    
  <button type="upload" name="upload" class="btn btn-danger">Upload <i class="fa fa-upload"></i> </button> 
  <div>
    <p class = "text-danger mb-5">NOTE: You can upload the image between  1MB</p>
  </div>
</form>
</div>

</body>
</html>

<?php
mysqli_close($conn);
    ?>


<?php
include("footer.php");
}
else
{
  header("Location: login.php");
}
?>

