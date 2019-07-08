
<?php
  //this file is used in single-program.php

          //$today = date('d/m/Y');
          //$today = date("F j, Y", strtotime(date()));
        //$today = date("F j, Y", (date('Ymd')));
        //$today = date("F j, Y");
        $today = date('Ymd');

          $whereQueryforcustomfield1_campus =array(
                        'key'=>'related_campus',
                        'compare' => 'LIKE',
                        'value' =>'"' . get_the_ID() . '"'
                        //e.g id of the current campus page we are viewing
                        //serialized array=a:3:{i:"0";i:"12";i:"1";i:"120";i:"1200";}
                        //we concatenated get_the_ID() with dbl quotes because wordpress seraialize the array.
                      );


          $whereQuery = array(
              'posts_per_page' => -1,    //-1 means gives all posts with following coditions.
              'post_type' => 'program',
              //'meta_key' => 'event_date',  //not required for custom field event_date.
              //'orderby' =>'meta_value_num',   //not required for 'orderby' =>'post_date',title,rand,meta_value
              'orderby' =>'title',   //'orderby' =>'post_date',title,rand,meta_value
              'order'=>'ASC',  //ASC,DESC
              'meta_query' => array($whereQueryforcustomfield1_campus)
          );
          $relatedcampuses = new WP_Query($whereQuery);

          if($relatedcampuses->have_posts()) {
                  echo '<hr class="section-break">';
                  echo '<h2 class="headline headline--medium"> Programs Available At This Campus</h2>';
                  echo '<ul class="min-list link-list">';
                  while ($relatedcampuses->have_posts()){
                    $relatedcampuses->the_post(); ?>
                      <li >
                          <a  href="<?php the_permalink();?>">
                              <?php //the_title(); //print name of Program?>
                              <?php the_title();?>
                          </a>
                      </li>
                    <?php
                  } //end of while loop
                  echo "</ul>";
          } // end of if have_posts

?>
<br>FileName: 'single-campus_relationship1with_programs.php'

