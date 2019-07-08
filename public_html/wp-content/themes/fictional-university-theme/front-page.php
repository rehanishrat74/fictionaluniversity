<?php
get_header(); ?>

 <div class="page-banner">

  <div class="page-banner__bg-image" style="background-image: url(<?php echo  get_theme_file_uri('/images/library-hero.jpg'); ?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h1 class="headline headline--large">Welcome!!!!!!</h1>
      <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
      <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
      <a href="<?php echo get_post_type_archive_link('program'); ?>" class="btn btn--large btn--blue">Find Your Major</a>
    </div>
  </div>

  <div class="full-width-split group">
    <div class="full-width-split__one">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>
        <?php

          //$today = date('d/m/Y');
          //$today = date("F j, Y", strtotime(date()));
        //$today = date("F j, Y", (date('Ymd')));
        //$today = date("F j, Y");
        $today = date('Ymd');
          $whereQueryforcustomfield1 =array(
                        'key'=>'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type'=>'numeric'
                      );

          $whereQuery = array(
              'posts_per_page' => 2,    //-1 means gives all posts with following coditions.
              'post_type' => 'event',
              'meta_key' => 'event_date',  // for custom field event_date.
              'orderby' =>'meta_value_num',   //'orderby' =>'post_date',title,rand,meta_value
              'order'=>'ASC',  //ASC,DESC
              'meta_query' => array($whereQueryforcustomfield1)
          );
          $homepageEvents = new WP_Query($whereQuery);
          while ($homepageEvents->have_posts()){
            $homepageEvents->the_post();
            echo get_template_part( 'template-parts/content','event');
            /*example : get_template_part( 'template-parts/content',get_post_type());
            Filename becomes content-event by wordpress
            */

          }
        ?>

<!--        <div class="event-summary">
          <a class="event-summary__date t-center" href="#">
            <span class="event-summary__month">Apr</span>
            <span class="event-summary__day">02</span>
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="#">Quad Picnic Party</a></h5>
            <p>Live music, a taco truck and more can found in our third annual quad picnic day. <a href="#" class="nu gray">Learn more</a></p>
          </div>
        </div>
-->
        <p class="t-center no-margin">
          <a href="<?php echo get_post_type_archive_link('event') ;?>" class="btn btn--blue">View All Events</a>
        </p>

      </div>
    </div>
    <div class="full-width-split__two">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>
        <!-- Working with custom querries  -->
        <?php
            $args = array(
                'posts_per_page' =>2
            );
            //'post_type' => 'post'  //will display all posts
            //'post_type' => 'page'  // will display all pages
            //'categoy_name' => 'awards' // posts falling in awards category
            $homepagePosts = new WP_Query($args);
            while ($homepagePosts->have_posts()){
              $homepagePosts->the_post();?>
                <div class="event-summary">
                  <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
                    <span class="event-summary__month"><?php the_time('M'); ?></span>
                    <span class="event-summary__day"><?php the_time('d'); ?></span>
                  </a>
                  <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h5>
                    <p>
                      <?php
                          //echo wp_trim_words( get_the_content(), 18);
                        if (has_excerpt()){
                          //the_excerpt(); //this function will put <p> which will create blank lins arout the test.
                          echo get_the_excerpt();
                        }
                        else {echo wp_trim_words(get_the_content(),18);}
                      ?>
                      <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a>
                    </p>
                  </div>
                </div>
            <?php }
            wp_reset_postdata(); //clearing the cache for custom querries.
        ?>
        <!-- Working with custom querries  -->

        <!--
        <div class="event-summary">
          <a class="event-summary__date event-summary__date--beige t-center" href="#">
            <span class="event-summary__month">Feb</span>
            <span class="event-summary__day">04</span>
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="#">Professors in the National Spotlight</a></h5>
            <p>Two of our professors have been in national news lately. <a href="#" class="nu gray">Read more</a></p>
          </div>
        </div>
      -->

        <p class="t-center no-margin"><a href="<?php echo site_url('/blog');?>" class="btn btn--yellow">View All Blog Posts</a></p>
      </div>
    </div>
  </div>

 <?php get_template_part( 'template-parts/content','slider'); ?>

    <!--
      contents moved in 'template-parts/content-slider'
  <div class="hero-slider">


  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bus.jpg'); ?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Free Transportation</h2>
        <p class="t-center">All students have free unlimited bus fare.</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
      </div>
    </div>
  </div>

  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/apples.jpg'); ?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">An Apple a Day</h2>
        <p class="t-center">Our dentistry program recommends eating apples.</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
      </div>
    </div>
  </div>

  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bread.jpg'); ?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Free Food</h2>
        <p class="t-center">Fictional University offers lunch plans for those in need.</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
      </div>
    </div>
  </div>

</div>
   -->
<?php
get_footer();
?>
<br>Filename:Index.php
