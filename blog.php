<?php include('header.php')?>
  <main id="main">
  
      <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Blog</li>
        </ol>
        <h2>Blog</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">
          <?php 
            $uresult = mysqli_query($conn,"SELECT categories.category as catname,  blogs.*
            FROM blogs
            INNER JOIN categories
            ON categories.id=blogs.category where status='active'  order by id DESC");
            while($roww = mysqli_fetch_assoc($uresult))
            {
            
          ?>
            <article class="entry">

              <div class="entry-img">
                <img src="admin/blogUpload/<?php echo$roww['image'] ?>" height="700" width="900" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="blog-single.php?id=<?php echo$roww['id'] ?>"><?php echo$roww['title'] ?></a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.php?id=<?php echo$roww['id'] ?>">Admin</a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.php?id=<?php echo$roww['id'] ?>"><time datetime="2020-01-01"><?php echo date("M j Y",strtotime($roww['created_at'])) ?></time></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.php?id=<?php echo$roww['id'] ?>"><?php echo $roww['catname'] ?></a></li>
                </ul>
              </div>

              <div class="entry-content">
                <p><?php echo substr(strip_tags(htmlspecialchars_decode($roww['descreption'])), 0, 250) ?></p>
                <div class="read-more">
                  <a href="blog-single.php">Read More</a>
                </div>
              </div>

            </article><!-- End blog entry -->

            <?php 
            }
            ?>

            <div class="blog-pagination">
              <ul class="justify-content-center">
                <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
              </ul>
            </div>

          </div><!-- End blog entries list -->
          <?php include('blog_sidebar.php') ?>
          <!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->
  <?php include('footer.php')?>
      