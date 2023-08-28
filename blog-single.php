<?php include('header.php')?>

  <main id="main">
  <?php 
  if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])) 
  {
    $idd = $_REQUEST["id"];
    $setResult = mysqli_query($conn, "SELECT categories.category as catname,  blogs.*
            FROM blogs
            INNER JOIN categories
            ON categories.id=blogs.category where blogs.id ='$idd' ");
    if(mysqli_affected_rows($conn)===1) 
    {
      $rowww = mysqli_fetch_assoc($setResult);
    
    }
  
  ?>
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.php">Home</a></li>
          <li><a href="blog.php">Blog</a></li>
        </ol>
      <h2><?php echo $rowww['title'] ?></h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry entry-single">

              <div class="entry-img">
                <img src="admin/blogUpload/<?php echo $rowww['image'] ?>" width="900px" height="700px" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="blog-single.php"><?php echo $rowww['title'] ?></a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.php">admin</a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.php"><time datetime="2020-01-01"><?php echo date("M j y" , strtotime($rowww['created_at'])) ?></time></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.php"><?php echo $rowww['catname'] ?></a></li>
                </ul>
              </div>

              <div class="entry-content">
                <?php echo htmlspecialchars_decode($rowww['descreption']) ?>
              </div>
            </article><!-- End blog entry -->

           </div><!-- End blog entries list -->

          <?php include('blog_sidebar.php') ?>
          <!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Single Section -->

  </main><!-- End #main -->
  <?php include('footer.php')?>
  <?php
  
  }
  else
  {
    header("location: blog.php");
  }
  ?>