Filename: archive-program.php, functions.php, single-event.php,single-program.php,header.php (current-menu-item)
front-page.php =Find Your Major .lnk

we will create relation ship between event science of cat and Biology program.
Add a new custom field group = related program, fieldtype =relationship, post type = program.
filter = search
show this field group if post type is event.

now when we go to Science of cats, we can relate it to the biology program.

we will show this relation ship in single-event.php below the content div.

print_r($variablename) // prints whatever inside the variable.


in single-event.php
  <?php
       $programs = get_field('related_programs');
      if($programs){
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">Related Program(s)</h2>';
          echo '<ul class="link-list min-list">';
          foreach ($programs as $program){
            ?>
              <li><a href="<?php echo get_the_permalink($program);?>"><?php echo  get_the_title($program);?></a></li>
            <?php

          } //end of foreach
          echo '</ul>';
      }//end of if program
  ?>


relationships should be two ways. i.e a program can tell associated events and an event can tell corresponding programs.

now go in single-program.php
we can get custom query from front-page.php and then modify it.
