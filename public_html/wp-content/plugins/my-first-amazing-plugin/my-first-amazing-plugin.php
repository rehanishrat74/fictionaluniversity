<?php
/*
  Plugin Name: My First Amazing Plugin
  Description: this plugin will change your life.
*/

add_filter( 'the_content','amazingContentEdits'); //hook to a wp function.

function amazingContentEdits($content) {
/*The hook will get invoked where ever we use the_content.*/
$content =$content.'<p>All content belongs to Fictional University. Lorem <br>File: plugin/my-first-amazing-plugin.php</p>';

$content=str_replace('Lorem','***',$content); // this will replace Lorem with ****.

return $content;

}


//Usage: We offer a total of [programCount] programs in our campuses.

add_shortcode( 'programCount', 'getProgramCount' );
function getProgramCount($attribs=NULL){

  $counts = wp_count_posts( 'program');
  return $counts->publish;

}
/* shortcodes can be used in the main content field.
e.g Our school has [programCount] programs in about us page. //to do.

to research over more advanced plugins.
url: codex.wordpress.org  / developer.wordpress.org
add_menu_page();
add_option();
get_option();
update_option();
delete_option();

//example:
Simplest example of a shortcode tag using the API: [footag foo="bar"]

function footag_func( $atts ) {
  return "foo = {$atts['foo']}";
}
add_shortcode( 'footag', 'footag_func' );



Example wp-config.php for Debugging

The following code, inserted in your wp-config.php file, will log all errors, notices, and warnings to a file called debug.log in the wp-content directory. It will also hide the errors so they do not interrupt page generation.

 // Enable WP_DEBUG mode
define( 'WP_DEBUG', true );

// Enable Debug logging to the /wp-content/debug.log file
define( 'WP_DEBUG_LOG', true );

// Disable display of errors and warnings
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG', true );


    <pre>
    <?php echo var_dump($counts); ?>
    </pre>

*/
?>

