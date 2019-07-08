
<?php
  //this file is used in single-program.php

          //$today = date('d/m/Y');
          //$today = date("F j, Y", strtotime(date()));
        //$today = date("F j, Y", (date('Ymd')));
        //$today = date("F j, Y");
        $today = date('Ymd');
          $whereQueryforcustomfield1_event =array(
                        'key'=>'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type'=>'numeric'
                      );
          $whereQueryforcustomfield2_program =array(
                        'key'=>'related_programs',
                        'compare' => 'LIKE',
                        'value' =>'"' . get_the_ID() . '"'
                        //e.g id of the current page which is  program = biology etc
                        //serialized array=a:3:{i:"0";i:"12";i:"1";i:"120";i:"1200";}
                        //we concatenated get_the_ID() with dbl quotes because wordpress seraialize the array.
                      );


          $whereQuery = array(
              'posts_per_page' => 2,    //-1 means gives all posts with following coditions.
              'post_type' => 'event',
              'meta_key' => 'event_date',  // for custom field event_date.
              'orderby' =>'meta_value_num',   //'orderby' =>'post_date',title,rand,meta_value
              'order'=>'ASC',  //ASC,DESC
              'meta_query' => array($whereQueryforcustomfield1_event,$whereQueryforcustomfield2_program)
          );
          $homepageEvents = new WP_Query($whereQuery);

          if($homepageEvents->have_posts()) {
                  echo '<hr class="section-break">';
                  echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' events</h2>';
                  while ($homepageEvents->have_posts()){
                    $homepageEvents->the_post();
                    echo  get_template_part( 'template-parts/content', 'event' );

                  } //end of while loop
          } // end of if have_posts
          wp_reset_postdata();
          $relatedCampuses = get_field('related_campus');
          if ($relatedCampuses) {
            echo '<hr class="section-break">';
            //e.g Math is available at these campuses
            echo '<h2 class="headline headline--medium">' . get_the_title() . ' is Available At These Campuses:</h2>';
            echo '<ul class="min-list link-list">';
            foreach ($relatedCampuses as $campus) {?>
              <li> <a href="<?php echo get_the_permalink($campus);?>"><?php echo get_the_title($campus);?></a></li>
            <?php
            }
             echo '</ul>';
          }

?>
<br>FileName: 'single-program_relationship1with_events.php'

