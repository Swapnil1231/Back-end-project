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
    $adminresult = mysqli_query($conn, "SELECT id,username,email,city, mobile,created_at,pick from users where token='$token'");
    $row = mysqli_fetch_assoc($adminresult);

    function filturedata($data)
    {
        return addslashes(strip_tags(trim($data)));
    }
    function filtureDesc($data)
    {
        return htmlspecialchars(addslashes((trim($data))));
    }
        
    if(isset($_POST['submit']))
    {
        $err=[];
        $category = isset($_POST['category']) ? filturedata($_POST['category']) : '';
        $title = isset($_POST['title']) ? filturedata($_POST['title']) : '';
        $desc = isset($_POST['desc']) ? filtureDesc($_POST['desc']) : '';

        //validation============

        if(empty($category))
        {
          $err['category'] = "Category is required";
        }

        if(empty($title))
        {
          $err['title'] = "Title is required";
        }
        else
        {
          if(strlen($title) < 10)
          {
            $err['title']="Title must be atleast of length: 10 characters.";
          }
        }

        if(empty($desc))
        {
          $err['desc'] = "Descreption is required";
        }
        else
        {
          if(strlen($desc) < 25)
          {
            $err['desc']="Title must be atleast of length: 25 characters.";
          }
        }
       

        if(is_uploaded_file($_FILES['image']['tmp_name']))
        {
          $filename = $_FILES['image']['name'];
          $filesize= $_FILES['image']['size'];
          $tmp_name = $_FILES['image']['tmp_name'];
          $filetype = $_FILES['image']['type'];

          $allowedTypes = ["png","jpg","jpeg","gif","webp","tiff"];
          $ext = pathinfo($filename,PATHINFO_EXTENSION);
          if(in_array($ext,$allowedTypes))
          {
            if($filesize <= 10000000)
            {
              if(file_exists("blogUpload/".$filename))
              {
                $str = md5(substr(str_shuffle("qwertzuiopljhgfdsayxcvbnm"),10,20));
                $filename = $str."_".time()."_".$filename;
              }

              if(!move_uploaded_file ($tmp_name,"blogUpload/".$filename))
              {
                $err['image'] = " Error in uploading! Please try again latter!";
              }
            }
            else
            {
              $err['image'] = "File size should be less than or equal to 1MB";
            }
          }
          else
          {
            $err['image'] = "Invalid File Type";
          }
        }
        else
        {
          $err ['image'] = "Please upload the image";
        }
        
        if(count($err) === 0)
        {
          $blogSql = mysqli_query($conn,"INSERT into blogs(category,title,descreption,image) values('$category','$title','$desc','$filename')");
          if(mysqli_affected_rows($conn))
          {
            setcookie("success","Blog Posted Successfully",time()+3);
            header("location: admin_add_blog.php");
          }
          else
          {
            setcookie("error","Anable to Post Blog",time()+3);
            header("location: admin_add_blog.php");
          }
        } 
    }
?>
<div class="content-wrapper">
<?php 
    if(isset($_COOKIE['success']))
    {
        ?>
        <div>
            <p class="alert alert-success"><?php echo $_COOKIE['success'] ?></p>
        </div>
        <?php 
    }
    if(isset($_COOKIE['error']))
    {
        ?>
        <div>
            <p class="alert alert-danger"><?php echo $_COOKIE['error'] ?></p>
        </div>
        <?php 
    }
?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Blogs</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="" >Select Category</label>
            <select name="category" class="form-control">
              <option value="" selected disabled> --Select Category-- </option>
              <?php 
              $catData = mysqli_query($conn,"select id,category from categories order by category ASC");
              if(mysqli_num_rows($catData)>0)
              {
                while ($catdata=mysqli_fetch_assoc($catData))
                {
                    ?>
                    <option <?php if(isset($_POST['category'])) if($catdata['id'] === $_POST['category']) echo "selected" ?> value="<?php echo $catdata['id'] ?>"><?php echo $catdata['category'] ?></option>
                    <?php 
                }
              }
              else
              {
                ?>
                <option value="">Categories Not Found, Please Add Categories</option>
                <?php
              }
              ?>
            </select>
            <small class="text-danger"><?php if(isset($err['category'])) echo $err['category']?></small>
        </div>

        <div class="mb-3">
            <label for="">Blog Title:</label><br/>
            <input type="text" class="form-control" name="title" value="<?php if(!empty($title)) echo $title ?>">
            <small class="text-danger"><?php if(isset($err['title'])) echo $err['title'];?></small>
        </div>

        <div class="mb-3">
            <label for="">Blog Descreption:</label><br/>
            <textarea name="desc" id="desc" class="form-control"><?php if(!empty($desc)) echo $desc ?></textarea>
            <small class="text-danger"><?php if(isset($err['desc'])) echo $err['desc'];?></small>
        </div>

        <div class="mb-3">
            <label for="">Blog Image:</label><br/>
            <input type="file" class="form-control" name="image">
            <small class="text-danger"><?php if(isset($err['image'])) echo $err['image'];?></small>
        </div>

        <div class="mb-3">
        <input type="submit" class="btn btn-success" value="Add Blog" name="submit" >
        </div>
      </form>
    </section>
</div>
<?php 
include("admin_footer.php");
}
else
{
    header("location: ../login.php");
}
ob_end_flush();
?>
<script>
  $(function () {
    // Summernote
    $('#desc').summernote()
  })
</script>
