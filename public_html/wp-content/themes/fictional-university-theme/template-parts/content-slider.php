<!--  HelpFile: 934-traditionalSearch.php
Related Files: front-page.php
<div class="hero-slider">
-->

<!--
<div class="hero-slider">

    <?php

      $whereQueryforFindLayers =array (
          'key' => 'related_slider',
          'compare' => 'LIKE',
          'value' =>  '"164"'  //Slide For Front Page
      );


       $whereQuery = array(
              'posts_per_page' => -1,    //-1 means gives all posts with following coditions.
              'post_type' => 'SliderLayer', // 'SliderLayer',
              //'meta_key' => 'related_slides',  // for custom field event_date.
              //'orderby' =>'meta_value_num',   //'orderby' =>'post_date',title,rand,meta_value
              'order'=>'ASC',  //ASC,DESC
              'meta_query' => array($whereQueryforFindLayers)
          );
          $SlideNames = new WP_Query($whereQuery);
          //print_r($SlideNames) ;
          while ($SlideNames->have_posts()){
            $SlideNames->the_post();
             $layerimage= get_field("page_banner_background_image");


          ?>

          <div class="hero-slider__slide" style="background-image: url(<?php echo $layerimage['sizes']['pageBanner'] ; ?>);">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center"><?php the_title();?></h2>
                <p class="t-center"><?php echo  get_field("page_banner_subtitle");?></p>
                <p class="t-center no-margin"><a href="<?php echo get_field("link_for_learn_more");?>" class="btn btn--blue"><?php echo get_field("caption_learnmore");?></a></p>
              </div>
            </div>
          </div>
          <?php
                    }
          wp_reset_postdata();
    ?>
</div>
-->

<?php
    $args =array('sliderId'=> '164');  //slider: 164 and 165
    dynamicSlider($args);  // in functions.php
?>



FileName: template-parts/content-slider.php
