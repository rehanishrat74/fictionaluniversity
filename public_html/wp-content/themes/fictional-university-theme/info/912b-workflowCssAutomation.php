<?php
we do changes in css to stay organised.

/var/www/amazingcollege/public_html/wp-content/themes/fictional-university-theme/css $

after compliation
the resulted css get copied to
/var/www/amazingcollege/public_html/wp-content/themes/fictional-university-theme/style.css

---------------------------------------
paste following into
/var/www/amazingcollege/public_html/wp-content/themes/fictional-university-theme/css/style.css

/*
Theme Name: Fictional University
Author: Rehan
Version: 1.0;
*/


---------------------------------
javascript:
in functions.php we included
wp_enqueue_script( 'main-university-js',get_theme_file_uri('/js/scripts-bundled.js'),NULL,microtime(),true);
this is the compiled js after doing editing in
rehan@xenial /var/www/amazingcollege/public_html/wp-content/themes/fictional-university-theme/js/modules

?>
