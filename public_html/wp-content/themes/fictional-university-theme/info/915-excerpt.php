<?php

"select a blog post in admin.post, and from top rright menue, select excerpt check box.
now you can type your cusom excerpt.

front-page.php
  From our blog"
      the_excerpt();
      "this function will put <p> which will create blank lins arout the test. to avoid blank lines use"
      echo get_the_excerpt();
"in mu-plugin/university-post-types.php added the support feature to enable excerpt"

--changes:
1.
       <p>
          <?php
          //echo wp_trim_words( get_the_content(), 18);
           if (has_excerpt()){
              //the_excerpt(); //this function will put <p> which will create blank lins arout the test.
               echo get_the_excerpt();
            }
            else {echo wp_trim_words(get_the_content(),18);}
            ?>
          <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>




2.
        <p class="t-center no-margin">
          <a href="<?php echo get_post_type_archive_link('event') ;?>" class="btn btn--blue">View All Events</a>
        </p>

3. header.php. Event link should remain highlighted.
            <li <?php if (get_post_type()=='event') {echo ' class="current-menu-item"'} ?> >
              <a href="<?php echo  get_post_type_archive_link('event');?>">Events</a></li>

?>
