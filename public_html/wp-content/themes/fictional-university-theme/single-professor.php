<?php
get_header();

while (have_posts() ) {
the_post();

  pageBanner();
?>

<div class="container container--narrow page-section">
        <!----Hide-Display--Breadcumb area for post type professors. as they dont have archive- ---------------->
        <!--
        <div class="metabox metabox--position-up metabox--with-home-link">
          <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event');?>"><i class="fa fa-home" aria-hidden="true"></i> Events Home </a> <span class="metabox__main"><?php the_title();?>   </span></p>
        </div>
      -->

  <div class="generic-content">
      <div class="row group">
          <div class="one-third"><?php the_post_thumbnail('professorPortrait');?></div>
              <div class="two-thirds">
                  <?php
                      $likeCount = new WP_Query(array(
                        'post_type' => 'like',
                        'meta_query' => array(
                            array(
                              'key' =>'liked_professor_id',
                              'compare' => '=',
                              'value' => get_the_ID()
                            )
                        )
                      ));


                      $existStatus = 'no'; // a parameter for css
                      $idOf_LikePost = 0;


                      if(is_user_logged_in()){
                            //without if userlogedin, get_current_user_id will return 0 which in return make the author validation false.
                          $existQuery = new WP_Query(array(
                            'author' => get_current_user_id(), // id of the current user.
                            'post_type' => 'like',
                            'meta_query' => array(
                                array(
                                  'key' =>'liked_professor_id',
                                  'compare' => '=',
                                  'value' => get_the_ID()
                                )
                            )
                          ));

                          if ($existQuery->found_posts) {
                            $existStatus = 'yes'; // a parameter for css
                            $idOf_LikePost= $existQuery->posts[0]->ID;
                          }
                      }
                      //echo print_r($existQuery);
                        //echo print_r($existQuery->found_posts);
                  ?>
                  <!--<span class="like-box"> we need to pass parameter to css ? /jquery.$existQuery->posts[0]->ID = like post id;
                    data-like="<?php echo $existQuery->posts[0]->ID;  ?>"
                  -->
                    <span class="like-box" data-like="<?php echo $idOf_LikePost; ?>" data-professor="<?php the_ID();?>" data-exists="<?php echo $existStatus;?>">
                      <i class="fa fa-heart-o" aria-hidden="true"></i>
                      <i class="fa fa-heart" aria-hidden ="true"></i> <!-- these will create ovlerlaping box and heart.-->
                      <span class="like-count"><?php echo $likeCount->found_posts;?></span>
                      <!-- heart ,count and box get aligned.-->
                  </span>
                  <?php the_content();?>

              </div>
      </div>
  </div>
  <?php
       $programs = get_field('related_programs');
      if($programs){
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
          echo '<ul class="link-list min-list">';
          foreach ($programs as $program){
            ?>
              <li><a href="<?php echo get_the_permalink($program);?>"><?php echo  get_the_title($program);?></a></li>
            <?php

          } //end of foreach
          echo '</ul>';
      }//end of if program
  ?>


</div>

<?php }
get_footer();
?>
Filename: single-professor.php for custom posts type professor.
