<?php
in header.php
[/*
//if a page is a child page, the parent menu item in the header should be highlighted by assaigning a class. to accomplish it do

<li <?php if(is_page('about-us') or (wp_get_post_parent_id(0) ==11)) echo 'class="current-menu-item"' ?> ><a href="<?php echo site_url('/about-us') ?>">About Us</a></li>

//wp_get_post_parent_id(0) => 0 means get the parent of the current page.
  11 is the id of about us page. We are saying if the current page is about-us or the childPage has a parent named about us then assign the special class to about us hyperlink to keep the header menu link glow.
*]
?>


