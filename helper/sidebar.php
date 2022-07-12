<div class="sidebar sidebar-left mt-sm-30">
              <div class="widget">
                <h5 class="widget-title line-bottom">Search Posts</h5>
                <div class="search-form">
                  <form action="search">
                    <div class="input-group">
                      <input type="text" placeholder="Search Post by title" name="search" class="form-control search-input">
                      <span class="input-group-btn">
                      <button type="submit" name="search_submit"  class="btn search-button"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
              <div class="widget">
                <h5 class="widget-title line-bottom">Categories</h5>
                <div class="categories">
                  <ul class="list list-border angle-double-right">
                  <?php 

              $query = "select * from category_tbl order by cat_name asc";
                $run_query = mysqli_query($conn, $query);
                while ($row_cat= mysqli_fetch_assoc($run_query)) { ?>
              <li><a href="category?id=<?php echo $row_cat['cat_id']; ?>&<?php echo UrlConverter($row_cat['cat_name']); ?>"><?php echo $row_cat['cat_name']; ?> <span>(<?php
              $sql = "SELECT * FROM post_tbl WHERE post_category = :name";
                $stmt = $con->prepare($sql);
                $stmt->execute([
                    ':name' => $row_cat['cat_id']
                ]);
                $count = $stmt->rowCount();
                if($count == 0) {
                    echo "0";
                  }else{
                    echo $count;
                  }

              ?>)</span></span></a></li>
              <?php }?>
                  </ul>
                </div>
              </div>
              <div class="widget">
                <h5 class="widget-title line-bottom">Popular Posts</h5>
                <div class="latest-posts">
                <?php

            $select_post = "select * from post_tbl order by post_count desc limit 0, 5";

            $run_query = mysqli_query($conn, $select_post);
            while ($result = mysqli_fetch_assoc($run_query)) { ?>
                  <article class="post media-post clearfix pb-0 mb-10">
                    <a class="post-thumb" href="#"><img height='70' width='80' src="adminpanel/<?= $result['post_image'] ?>" alt=""></a>
                    <div class="post-right">
                      <h5 class="post-title mt-0"><a href="content?id=<?= $result['post_id']; ?>&<?= UrlConverter($result['post_title']); ?>"><?= $result['post_title']; ?></a></h5>
                      
                      <date style='color: navy; font-weight: 600px;'><?= $result['post_date']; ?></date>
                    </div>
                  </article>
                  <?php  } ?>
                  
                </div>
              </div>
              
            </div>