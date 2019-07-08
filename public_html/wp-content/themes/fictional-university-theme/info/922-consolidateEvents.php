to display events, same div repreated multiple times in different pages. so we will consolidate following code in files template-parts/content-event.php, front-page.php,archive-event.php,page-past-events.php,single-program.php,
single-program_relationship1with_events.php

-------------copy the following code in /template-parts/event.php--------
                <div class="event-summary">
                  <a class="event-summary__date t-center" href="#">

                    <span class="event-summary__month"><?php echo date("M", strtotime(get_field('event_date'))); ?></span>
                    <span class="event-summary__day"><?php echo date("d", strtotime(get_field('event_date'))); ?></span>
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

                     <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
                  </div>
                </div>

-------------------
            get_template_part( 'template-parts/event');
            /*example : get_template_part( 'template-parts/content',get_post_type());
            Filename becomes content-event by wordpress
            */


Note: we use functions where we need to pass args.
we use get_template_part if we need to re-use html.
