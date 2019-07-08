<!--  HelpFile: 934-traditionalSearch.php
Related Files: filename:page-search.php and search.php
-->
                <div class="event-summary">
                  <a class="event-summary__date t-center" href="#">

                    <span class="event-summary__month"><?php echo date("M", strtotime(get_field('event_date'))); ?></span>
                    <span class="event-summary__day"><?php echo date("d", strtotime(get_field('event_date'))); ?></span>
                  </a>
                  <!--       $eventDate = new DateTime(get_field('event_date'));
                              echo $eventDate->format('M')-->
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
FileName: /template-parts/content-event.php
                </div>

