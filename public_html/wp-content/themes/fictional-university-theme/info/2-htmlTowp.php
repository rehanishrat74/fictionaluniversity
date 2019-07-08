<?php
copy from index.html <header class="site-header"> section into header.php.
copy from index.html <footer class="site-footer"> section into footer.php
copy rest of div between header and footer into index.php
correct the images file paths in index.php with url(echo  get_theme_file_uri('filepath'))

add style sheets and javascript into functions.php
    function university_files(){
      wp_enqueue_script( 'main-university-js',get_theme_file_uri('/js/scripts-bundled.js'),NULL,'1.0',true);
      wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400, 400i,700,700i|Roboto:100,300,400,400i,700,700i');

      wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
      wp_enqueue_style('university_main_styles',get_stylesheet_uri());
    }
    add_action('wp_enqueue_scripts','university_files');

to write [you'll] write html as [you&rsquo;ll ]

//use microtime() in place of version no to load scripts/styles in functions.php
?>
