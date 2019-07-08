<?php
Using custom querries:


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

------------------------------------
The above html of front-page.php has been converted to with custom querries as
------------------------------------

    <?php
            /*-------------[-----------Custom querries----------------------------*/
            $args = array(
                'posts_per_page' =>2
              //'post_type' => 'post'  //will display all posts
              //'post_type' => 'page'  // will display all pages
              //'categoy_name' => 'awards' // posts falling in awards category
            );

            $homepagePosts = new WP_Query($args);
            /*------------------------End Custom querries--------------]-----------*/

            while ($homepagePosts->have_posts()){
              $homepagePosts->the_post();?>
                <div class="event-summary">
                  <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
                    <span class="event-summary__month"><?php the_time('M'); ?></span>
                    <span class="event-summary__day"><?php the_time('d'); ?></span>
                  </a>
                  <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h5>
                    <p><?php echo wp_trim_words( get_the_content(), 18); ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
                  </div>
                </div>
            <?php }
            wp_reset_postdata(); //clearing the cache for custom querries.
        ?>




// to limit the content
echo wp_trim_words( get_the_content(), 18);
wp_reset_postdata(); //clearing the cache for custom querries and set to the previous state of variables.

echo site_url('/blog') //blog url

//update the same url in header.php against blog link.

//to identify a blog we have functions
is_home() , is_archive(),is_author(),is_category(),
or simply use ,  if(get_post_type()=='post'

?>
