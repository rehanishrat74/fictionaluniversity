<?php
<div class="page-banner">
<div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">  //breadcumb
    <div class="generic-content">

replace image path with : url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>)
replace title with the_title() in the div
replace contents with the_title()

set the caption in the browser tab of the page in functions.php as:
add_action( 'after_setup_theme', 'university_features');

added the hyperlinks for aboutus, programs,..,blogs in header.php

wordpressAdmin->settings->customSettings->CustomStructure
/index.php/%year%/%monthnum%/%day%/%postname%/


added home url in header.php and footer.php echo site_url()

//tips to hide index.php.
    sudo a2enmod rewrite
    Edit your .htaccess file as advised by wordpress permalink
    add following in /etc/apache2/sites-available/amazingcollege.test.conf
    <Directory /var/www/amazingcollege/public_html>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

 Then restart Apache server


For the complete webserver, we can edit as  /etc/apache2/apache2.conf file and
change the entry for / and /var/www from AllowOverride None to AllowOverride All.

?>
