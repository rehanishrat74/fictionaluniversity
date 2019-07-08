<?php
Create two blank pages home and blog.
admin.settings->ReadSettings
    Front Page = Home
    Blog Page = Blog

copy all the code in index.php to front-page.php
delete  everything from index.php

now front-page.php will serve as Home page automatically.
and index page will serve as blog. url =http://amazingcollege.test/blog/

copy
<div class="page-banner">
from page.php and put in index.php to display banner.



copy from page.php
  <div class="container container--narrow page-section">
to display contents in the centre.

// following class for border and space between each post.
<div class="post-item"></div>

//to look nice author names and dates
class "metabox" //with yellow background
class generic-content

//for title with hover effect
class = headline headline--medium headline--post-title

//class converts hyperlink into a blue button
class ="btn btn--blue"

the_content()
the_excerpt();


//the sign of >> is &raquo;

//to show the author name in capital, go to admin->user->profile and set nickname in CAPS and display nickname.

the_time()
F => month in captital
Y => year

// to get the category of the current post
echo get_the_category_list(', ')

//help
type wordpress <function name>  in google
?>
