
for traditional search.
<?php
Note: traditional search = http://localhost:3000/?s=biology.
filename:page-search.php , search.php and searchform.php
1. copy/paste the page.php into page.search.php



2. to simulate if javascript is disabled, comment the search instances in scripts.js

3. in Searchjs:
   openOverlay()
      return false;
    /* to disable default behaviour of a element in case of traditional search and javascript enabled.
    otherwise, traditional search page=localhost/search will get open.*/

4. in header.php replaced span for both mobile and desktop versions and put the search hyperlink there as
    <a href="<?php esc_url(site_url('/search')); ?>"> </a>

5. Create file : search.php to format the result of traditional search.
6. copy everything from search.php into index.php since search is powered by index.php by default.



get_search_query()
---------------------------

example: http://localhost:3000/?s=<script>alert('hay')</script>
behaviour: it will convert the script into string..

get_search_query(false) // will not allow to navigate the page.

safe way:
esc_html(get_search_query())



Usage: in search.php
$args =array(
    'title' => 'Search Results',
    //'subtitle' => 'You searched for &ldquo;x&rdquo;'
    //'subtitle' => 'You searched for &ldquo;' . x . '&rdquo;'
    'subtitle' => 'You searched for &ldquo;' . esc_html(get_search_query(false))  . '&rdquo;'
  );
pageBanner($args);

&ldquo = “
&rdquo = ”

----------------------
get_template_part('template-parts/content', get_post_type() );
=>
Filename: template-parts/content-professor.php
Filename: template-parts/content-event.php
Filename: template-parts/content-post.php
Filename: template-parts/content-program.php
Filename: template-parts/content-page.php:
Filename: template-parts/content-campus.php:


    Filename: template-parts/content-post.php
        copy the html div from search.php into this file. which was copied from index.php
    ------------------------------------------------

    Filename: template-parts/content-program.php
    ------------------------------------------------
    copy the html div from search.php into this file. which was copied from index.php with slight modifications.

    Filename: template-parts/content-professor.php :
    ------------------------------------------------
    copy the <li> html from FileName: 'single-program_relationship2with_professors.php' into this file.


    Filename: template-parts/content-page.php:
    ------------------------------------------
    copy from content-post.php

    Filename: template-parts/content-campus.php:
    ------------------------------------------
    copy from content-post.php

get_search_form(); // it will look into file searchform.php by default. it is wordpress function

?>
