<?php
in functions.php register_nav_menu( 'headerMenuLocation','Header Menu Location');
//Menu option becomes available In admin.Appearance

in header.php
<nav class="main-navigation">
          <?php wp_nav_menu(array(
            'theme_location' => 'headerMenuLocation'
          ));?>  // to display the menu created above for the header section


in functions.php
register_nav_menu( 'footerLocationOne','Footer Location One');
register_nav_menu( 'footerLocationTwo','Footer Location Two');


in footer.php
 <nav class="nav-list">
                <?php wp_nav_menu(array(
                    'theme_location' => 'footerLocationOne'
                ));?>
                <?php wp_nav_menu(array(
                    'theme_location' => 'footerLocationTwo'
                ));?>

// To know the class of some link. right click the menu item and inspect.
you will see current-menu-item and you can change the color scheme in that class.


//the dynamic menu code is saved in following two files
footerPageWithDynamicMenu.php
headerPageWithDynamicMenu.php
?>
