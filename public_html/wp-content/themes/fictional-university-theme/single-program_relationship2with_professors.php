
<?php
  //this file is used in single-program.php

          //$today = date('d/m/Y');
          //$today = date("F j, Y", strtotime(date()));
        //$today = date("F j, Y", (date('Ymd')));
        //$today = date("F j, Y");
        $today = date('Ymd');

          $whereQueryforcustomfield1_subjects =array(
                        'key'=>'related_programs',
                        'compare' => 'LIKE',
                        'value' =>'"' . get_the_ID() . '"'
                        //e.g id of the current page which is  program = biology etc
                        //serialized array=a:3:{i:"0";i:"12";i:"1";i:"120";i:"1200";}
                        //we concatenated get_the_ID() with dbl quotes because wordpress seraialize the array.
                      );


          $whereQuery = array(
              'posts_per_page' => -1,    //-1 means gives all posts with following coditions.
              'post_type' => 'professor',
              //'meta_key' => 'event_date',  //not required for custom field event_date.
              //'orderby' =>'meta_value_num',   //not required for 'orderby' =>'post_date',title,rand,meta_value
              'orderby' =>'title',   //'orderby' =>'post_date',title,rand,meta_value
              'order'=>'ASC',  //ASC,DESC
              'meta_query' => array($whereQueryforcustomfield1_subjects)
          );
          $relatedProfessors = new WP_Query($whereQuery);
//echo print_r($relatedProfessors);
          if($relatedProfessors->have_posts()) {
                  echo '<hr class="section-break">';
                  echo '<h2 class="headline headline--medium"> ' . get_the_title() . ' Professors</h2>';
                  echo '<ul class="professor-cards">';
                  while ($relatedProfessors->have_posts()){
                    $relatedProfessors->the_post(); ?>
                      <li class="professor-card__list-item">
                          <a class="professor-card" href="<?php the_permalink();?>">
                              <?php //the_title(); //print name of professor?>
                              <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape');?>">
                              <span class="professor-card__name"><?php the_title();?></span>

                          </a>
                      </li>
                    <?php
                  } //end of while loop
                  echo "</ul>";
          } // end of if have_posts

?>
<br>FileName: 'single-program_relationship2with_professors.php'

