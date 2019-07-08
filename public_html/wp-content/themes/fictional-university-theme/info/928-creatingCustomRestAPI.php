<?php
Files:
      /inc/search-route.php
      /info/927-customizingRestApi.php
      /info/ 928b-search-routeV1.php  // a simple version

      js/modules/Search.js
              getResults()-> this.callCustomRestApiForSearch();
      /inc/search-route.php
                function universitySearchResults($data){

  "
  we create custom rest api because of four reasons.
  1. if we search for Biology, we need to know about
      a. Biology Title,
      b. Professor of Biology.
      c. Campus information where biology being taught.
      d. Up coming events regarding biology.
  2. Load faster data.
  3. Send one json request against all sort of post types.
  4. Sharpening php skills.
"
Create a folder named inc. and create file "search-route.php" in inc folder to be included in functions.php.
require get_theme_file_path('inc/search-route.php'); //in functions.php



in this tutorial we  merged different urls
http://amazingcollege.test/wp-json/wp/v2/posts
http://amazingcollege.test/wp-json/wp/v2/media
http://amazingcollege.test/wp-json/wp/v2/users
http://amazingcollege.test/wp-json/wp/v2/professor


in to  one url as
http://amazingcollege.test/wp-json/university/v1/search?term=award
http://amazingcollege.test/wp-json/university/v1/search?term=about
http://amazingcollege.test/wp-json/university/v1/search?term=barksalot
http://amazingcollege.test/wp-json/university/v1/search?term=biology
http://amazingcollege.test/wp-json/university/v1/search?term=award
http://amazingcollege.test/wp-json/university/v1/search?term=biology
for post types = 'post','page','Professor','program','campus','event'

"Note: but it will not link the information based upon the relationships between different types."
?>
