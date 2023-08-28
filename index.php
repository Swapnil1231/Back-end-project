<?php include('header.php');

if(isset($_SESSION['user_token']) && !empty($_SESSION['user_token'])) {
    ?>
  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
        <div class="carousel-inner" role="listbox">
        <center><h2 class="animate__animated animate__fadeInDown ">Welcome to <span>Swapnil Blogs</span></></center>
        <?php 
        $blog = mysqli_query($conn,"SELECT * FROM blogs order by id ASC");
        if(mysqli_num_rows($blog)>0)
        {
          while ($row=mysqli_fetch_assoc($blog))
          {
        ?>
        
          <div class="carousel-item active" style="background-image: url(admin/blogUpload/<?php echo $row['image'] ?>)">
            <div class="carousel-container">
              <div class="carousel-content">
               <h4> 
                <p class="animate__animated animate__fadeInUp"><?php echo $row['title'] ?></p></h4>
                <a href="blog-single.php?id=<?php echo $row['id'] ?>" class="btn-get-started animate__animated animate__fadeInUp ">Read More</a>
              </div>
            </div>
          </div>
        <?php 
          }
        }
        ?>
        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Featured Section ======= -->
    <section id="featured" class="featured">
      <div class="container">

        <div class="row animate__animated animate__fadeInUp mt-3">
          <div class="col-lg-4">
            <div class="icon-box">
              <i class="bi bi-card-checklist"></i>
              <h3><a href="">Lorem Ipsum</a></h3>
              <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>
          </div>
          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="icon-box">
              <i class="bi bi-bar-chart"></i>
              <h3><a href="">Dolor Sitema</a></h3>
              <p>Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
            </div>
          </div>
          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="icon-box">
              <i class="bi bi-binoculars"></i>
              <h3><a href="">Sed ut perspiciatis</a></h3>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Featured Section -->

    
    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container">

        <div class="section-title">
          <h2>Clients</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="clients-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Clients Section -->

  </main><!-- End #main -->
<?php

    ?>

  <?php
}
else
{
  header("location: login.php");
}
  include('footer.php');
  ?>