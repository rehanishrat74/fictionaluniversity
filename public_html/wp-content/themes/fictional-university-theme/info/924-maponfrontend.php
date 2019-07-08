<?php
create file archive-campus.php
copy the contents of archive-program.php in this file

in header.php, updated hyperlink of campuses.

//info to use googlemaps with acf field
----------------------------------------
www.advancedcustomfields.com/resources/google-map/

//we created js based upon above article in the folder js/modules/GoogleMap.js

//write line in /js/modules/scripts.js
import GoogleMap from './modules/GoogleMap';
var googleMap = new GoogleMap();

Note: if gulp wath is running it will automatically rebundled the files for us.
other way is to use gulp scripts to rebundle.
----------------------------------------

html in archive-campus.php
?>

<div class="container container--narrow page-section">

     <div class="acf-map">
    <?php
        while(have_posts()){
          the_post();
          $mapLocation=get_field('map_location');
          ?>
          <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
              <!-- composing googlemap pin details-->
              <h3> <a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
              <?php  echo $mapLocation['address']; ?>
          </div>
        <?php }?>
</div>


<?php

in functions.php
  name: university_files
// js to load googlemap.
        wp_enqueue_script( 'googleMap','//maps.googleapis.com/maps/api/js?key=AIzaSyBh9b1rNCp6kOi5JeMHiRP4klDymBeoEWk',NULL,microtime(),true);


//Addresses
Downtown West
160 W 79th St, New York, NY 10024, USA


Downtown East
50 85th St Transverse, New York, NY 10128, USA


create single-campus.php and copy the contents of single-program.php in it.

create a related campuses in custom fields. so we can show programs/subjects in that campus. fieldtype = relationship, postype =campus, location = program.
mathprogram = downtown west


created <br>FileName: 'single-campus_relationship1with_programs.php'

to show relationship in both directions, we need to modify
single-program.php -> 'single-program_relationship1with_events.php'
 as well


unlimited campuses in university_adjust_queries() in functions.php


?>
