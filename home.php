<?php 
include("header.php");
if(isset($_SESSION['user_token']) && !empty($_SESSION['user_token']))
{
    $username = $_SESSION['username']; 
    $token = $_SESSION['user_token'];
    $result = mysqli_query($conn, "select username,mobile,city,pick from users where token = '$token'");
    $row = mysqli_fetch_assoc($result);
    
    ?>
   
    <div class="container py-4">
    <p class="texe-secondary "> Welcome <span class="display-4"> <?php echo ucwords($username);?></span> </p>
    
    
    <?php 
    if($row['pick'] !== "")
    {
      ?>
     
        <div class="container">
            <div class="row">
                <div class="col-md-6 dis">
                    <div class="col mb-2">
                        <img src="uploaded/<?php echo $row['pick']?>" height="300" width="300" alt="">
                    </div>
                    <div class="col">
                       <a href="delete_avatar.php"><button class="btn btn-danger" name="delete_avatar">Delete Avatar  </button></a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }



 
    ?>
    
    <?php 
    
    $result = mysqli_query($conn, "SELECT id,username,email,mobile,city,created_at FROM users where token ='$token'");
    if(mysqli_num_rows($result)===1)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            
            ?>
           <div class="mb-4"> 
           <table class="table">
                <tbody class="">
                    
                    <tr>
                        <th>ID : </th>
                        <td><?=$row['id']?></td>
                    </tr>
                    <tr>
                        <th>NAME : </th>
                        <td><?=$row['username']?></td>
                    </tr>
                    <tr>
                        <th>EMAIL : </th>
                        <td><?=$row['email']?></td>
                    </tr>
                    <tr>
                        <th>MOBILE : </th>
                        <td><?=$row['mobile']?></td>
                    </tr>
                    <tr>
                        <th>CITY : </th>
                        <td><?=$row['city']?></td>
                    </tr>
                    <tr>
                        <th>JOINED ON : </th>
                        <td><?=$row['created_at']?></td>
                    </tr>
                    
                </tbody>
            </table>
           </div>
            
            <?php 
        }
    }
    ?>
   
    
    </div>
   
    <?php
    include("Footer.php");
}
else
{
    header("Location: login.php");
}
?>