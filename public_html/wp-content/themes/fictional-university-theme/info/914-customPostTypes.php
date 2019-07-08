<?php
in functions.php add

add_action('init','university_post_types');

to download icons
https://developer.wordpress.org/resource/dashicons/#sort

custom post types must be placed in plugins so can be activated and deactivated if someone switch off plugin.
create a folder as /var/www/amazingcollege/public_html/wp-content/mu-plugins
wordpress automatically load plugins from this folder.


cut and paste  function university_post_types() from functins.php into plugins/university-post-types.php

now our plugin will always be there even if someone switch the theme.

  /* for more label items visit
    https://codex.wordpress.org/Function_Reference/register_post_type
  */
?>
