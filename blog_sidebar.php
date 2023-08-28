<div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title">Categories</h3>
              <?php 
              $cat = mysqli_query($conn,"SELECT categories.category,categories.id,count(*) as count from categories
              INNER JOIN blogs ON categories.id = blogs.category  where blogs.status ='active'  GROUP by categories.id");
              if(mysqli_num_rows($cat)>0)
              {
                
              ?>
              <div class="sidebar-item categories">
                <?php 
                while($catrow = mysqli_fetch_assoc($cat))
                {
                  
                ?>
                <ul>
                  <li><a href="cat_page.php?id=<?php echo$catrow['id']?>"><?php echo $catrow['category'] ?> <span>(<?php echo $catrow['count'] ?>)</span></a></li>
                </ul>
                <?php 
                }
                ?>
              </div><!-- End sidebar categories-->
              <?php 
                }
              ?>
              <h3 class="sidebar-title">Recent Posts</h3>
              <?php
                $side = mysqli_query($conn,"SELECT id,image,created_at,title FROM blogs where status='active'");
                if(mysqli_affected_rows($conn)===1);
                {
                    while ($srow=mysqli_fetch_assoc($side))
                    {

                    
              ?>
              <div class="sidebar-item recent-posts">
                <div class="post-item clearfix">
                  <img src="admin/blogUpload/<?php echo $srow['image'] ?>" alt="">
                  <h4><a href="blog-single.php?id=<?php echo $srow['id'] ?>"><?php echo $srow['title'] ?></a></h4>
                  <time datetime="2020-01-01"><?php echo date("M j Y",strtotime($srow['created_at'])) ?></time>
                </div>
              </div><!-- End sidebar recent posts-->
              <?php 
                    }
                }
              ?>
            </div><!-- End sidebar -->
            
          </div>