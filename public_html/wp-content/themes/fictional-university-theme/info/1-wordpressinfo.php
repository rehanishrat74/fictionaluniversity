<?php
//todo
create document for gulp and from documents/npm

screenshot.png 1200 x 900
section3: lecture 6
https://www.udemy.com/become-a-wordpress-developer-php-javascript/learn/v4/content

https://codex.wordpress.org/
https://developer.wordpress.org/

Famous wordpress loop: while (have_posts() )


font awesome to create icons
maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css

google fonts
onts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i



wordpress files.
-----------------
[
Filename: 1. index.php for blog posts.
          2. Filename: single.php for single posts.
          3. archive.php // for custom description, see archiveTitleByType.php

Filename: front-page.php for home page set by admin.

Filename: page.php. //if there index.php will not loaded but page.php
Filename: functions.php // for menu and hooks.



to create plugins for custom blogs:
Folder   :/var/www/amazingcollege/public_html/wp-content/mu-plugins/
Filename :university-post-types.php  // file and foldername could be anything.
//contains custom types for event/program.
      Filename :university-post-types.php   //custom plugin file
                Filename: single-event.php  // for custom post type named event.
                Filename : page-past-events.php // create an empty page in admin and then create the file.
                Filename: archive-event.php  // for archive of custom post type named event.

      FileName: template-parts/content-event.php //common html for the posts events.
      FileName: single-event.php
      Filename: single-professor.php //show professors and its subjects
      Filename: single-program.php //creating relationships between program(subjects) and event posts.
      /*we split the relations ships in single-program.php into two seperate files.
      <?php  include 'single-program_relationship2with_professors.php'; ?>
      <?php  include 'single-program_relationship1with_events.php'; ?>
      */
              FileName: single-program_relationship2with_professors.php
              FileName: single-program_relationship1with_events.php
      Filename: A part of event posts is also in front-page.php
      // relations ships developed in above files as
      1 prgram -> events posts
      1 program -> profossors.
Filename: inc/search-route.php.

FileNme: page-search.php // for traditional search.
          934-traditionalSearch.php
]




goto admin->settings->permalinks() and save changes.
it will update the new structure of permalink and can handle custom event types.

// to allow wordpress to save permalink settings
chmod 644 .htaccess
chown www-data: .htaccess

Enable widgets
-----------------------
add_action( 'widgets_init', 'arphabet_widgets_init' );
in functions.php

wordpress Maps
----------------------
get api key from https://developers.google.com/maps/documentation/javascript/get-api-key


wordpress functions
--------------------
bloginfo('name')         // settings->General settings ->Site Title
bloginfo('description') // settings->General settings -> Tagline
the_content();
the_excerpt();

the_title(); //echo the title.
get_the_title($pageid) // return title array

the_ID()  // if we have the_?  it means it will echo the id of current page.
echo get_the_ID()  // id of the current post or page.
get_the_id() // it will return id of the current page in array

the_time()
F => month in captital
Y => year
$today = date('Ymd');
$date2 = date("F j, Y", strtotime($date));
$eventDate = date("M", strtotime($date2);
$eventDate = date("d", strtotime($date2);

get_current_user_id()
sanitize_text_field($data)
get_post_type($postid)

is_user_logged_in()

echo get_the_category_list(', ') //get the category of the current post.
 add_theme_support('title-tag'); //title-tag in browser tab (in functions.php)

// the permalink for custom post types.
    echo get_post_type_archive_link('event');
    echo site_url('/blog')
      if(get_post_type()=='post')
        echo site_url('/blog') / echo  get_post_type_archive_link('blog')


echo wp_trim_words(get_the_content(), 18)  // to limit the words in contents. hint front-page.php
wp_reset_postdata(); //clearing the cache for custom querries. hint front-page.php

the_post_thumbnail_url(); //single-program_relationship2with_professors.php
gulp watch
gulp script // budndle javascript and css

echo paginate_links(array(
  'total'=>$pastEvents->max_num_pages
  ));
Ref:// page-past-events.php

get_template_part( 'template-parts/content',get_post_type()); => content-event.php e.g.
require get_theme_file_path('inc/search-route.php'); // to include a file in functions.php

sanitize_text_field($data['term']) ; // preventing sql injections.

//push array within array
array_push($results['generalInfo'], $Properties);

Note: While will be used with WP_Query.
      foreach will be used with arrays.

Finding Parent:
-------------------
[
$theParent = wp_get_post_parent_id(get_the_ID());
echo get_permalink($theParent)  //the parent link in metabox__blog-home-link
echo get_the_title($theParent)  //the title of the parent
$theParent = wp_get_post_parent_id(get_the_ID()); // id of the parent of the current (page/post)  id.

if(is_page('about-us') or (wp_get_post_parent_id(0) ==11)
// if page is parent aboutus or the child page has a parent id of about us.

]


wp_list_pages();  // list all the pages
get_pages() = wp_list_pages() in the sense that get_pages return pages in memory while wp_list_pages display menu
register_rest_route( $namespace, $route, $routeOptions, false );  // to create custom rest api in functions.php.search-route.php
in archive.php
-----------------
get_the_archive_title()  //retun in variable
the_archive_title()      // it will echo
get_the_archive_description() // return in variable
the_archive_description()    // it will echo


wordpress googlemap:
-------------------------
create file archive-campus.php
copy the contents of archive-program.php in this file
in header.php, updated hyperlink of campuses.
                //info to use googlemaps with acf field
                ----------------------------------------
                www.advancedcustomfields.com/resources/google-map/
                //we created js based upon above article in the folder js/modules/GoogleMap.js

                //write line in /js/modules/scripts.js
                import GoogleMap from './modules/GoogleMap';
                var googleMap = new GoogleMap();

                Note: if gulp wath is running it will automatically rebundled the files for us.
                other way is to use gulp scripts to rebundle.
                ----------------------------------------
html in archive-campus.php
<?php $mapLocation=get_field('map_location'); ?>
<div class="container container--narrow page-section">
     <div class="acf-map">
        <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>"></div>
      </div>
</div>

in functions.php
  name: university_files
// js to load googlemap.
        wp_enqueue_script( 'googleMap','//maps.googleapis.com/maps/api/js?key=AIzaSyBh9b1rNCp6kOi5JeMHiRP4klDymBeoEWk',NULL,microtime(),true);



wordpress images:
-------------------------------------


add_theme_support('post-thumbnails'); //enable thumbnails features in admin
//creating two additional custom sizes for images in upload folder. total images = 5+2 = 7
add_image_size('professorLandscape',400,260,true); //format Name,width,height,crop allowed
add_image_size('professorPortrait',480,650,true); //format Name,width,height,crop allowed
add_image_size('pageBanner',1500,350,true);
  //the crop position is centre by default. we can crop by specifying the position also.
 add_image_size('professorLandscape',400,260,array('left','top'));

the_post_thumbnail();
the_post_thumbnail('professorPortrait'); //single-professor.php
//in single-program_relationship2with_professors.php
<img class="professor-card__image" src="<?php the_post_thumbnail_url();?>">
<img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape');?>">

the_field('page_banner_subtitle')

//-----------------for background image in single.professor.php-----------------
$pageBannerImage=get_theme_file_uri('/images/ocean.jpg');
$pageBannerImage=get_field('page_banner_background_image');
     $pageBannerImage['sizes']['pageBanner'];
     $pageBannerImage['url'];

  <div class="page-banner__bg-image" style="background-image: url(<?php echo  $pageBannerImage['sizes']['pageBanner']; ?>);"></div>

    // the following two syntaxes are equal
      ------------------
      { .
      $pageBannerImage=get_field('page_banner_background_image');
           $pageBannerImage['sizes']['pageBanner'];
      get_field('page_banner_background_image')['sizes']['pageBanner']
      }
      ------------------

print_r($pageBannerImage);

function pageBanner($args=NULL)  in functions.php . the pageBanner() is called in single-professor.php and page.php

default image used: 'https://images.unsplash.com/photo-1493246507139-91e8fad9978e?dpr=1&auto=format&fit=crop&w=1500&h=1000&q=80'


wordpress custom fields and where clause.
-----------------------------------------
front-page.php
archive-event.php
the_field('event_date')
$eventDate = date("M", strtotime(get_field('event_date')));_
$eventDate = date("d", strtotime(get_field('event_date')));

example:
        $today = date('Ymd');
          $whereQueryforcustomfield1 =array(
                        'key'=>'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type'=>'numeric'
                      );

          $whereQuery = array(
              'posts_per_page' => -1,    //-1 means gives all posts with following coditions.
              'post_type' => 'event',
              'meta_key' => 'event_date',  // for custom field event_date.
              'orderby' =>'meta_value_num',   //'orderby' =>'post_date',title,rand,meta_value
              'order'=>'ASC',  //ASC,DESC
              'meta_query' => array($whereQueryforcustomfield1)
          );
          $homepageEvents = new WP_Query($whereQuery);
          while ($homepageEvents->have_posts()){
            $homepageEvents->the_post();
            echo date("M", strtotime(get_field('event_date')));


example:
    over riding default queries in functions.php
    ---------------------------------------------
    add_action( 'pre_get_posts', 'university_adjust_queries');


Mobile compatibility:
----------------------
[
<meta name="viewport" content="width=device-width,initial-scale=1">
<html <?php language_attributes();?> >
<head>.<meta charset="<?php bloginfo('charset'); ?>">
<body <?php body_class(); ?>>
]


while (have_posts() ) { the_post();



Paths:
------------------------
[
echo  get_theme_file_uri('/images/library-hero.jpg') // file location for background-image: url() in index.php
correct the images file paths in index.php with url(echo  get_theme_file_uri('filepath'))
]


Styles n Scripts:
------------------------
[
add style sheets and javascript into functions.php
    function university_files(){
      wp_enqueue_script( 'main-university-js',get_theme_file_uri('/js/scripts-bundled.js'),NULL,'1.0',true);
      //use microtime() in place of version no to load scripts/styles in functions.php

      wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400, 400i,700,700i|Roboto:100,300,400,400i,700,700i');

      wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
      wp_enqueue_style('university_main_styles',get_stylesheet_uri());
    }
    add_action('wp_enqueue_scripts','university_files');
    add_action( 'after_setup_theme', 'university_features');
]


Wordpress Menu:
-----------------------
[
register_nav_menu( 'headerMenuLocation','Header Menu Location')
// [functions.php]  Menu option becomes appear in wp admin

wp_nav_menu(array('theme_location' => 'headerMenuLocation' ))
// will use in header/footer.php to display menu

is_page('about-us')
// if the current page is about-us page

wp_get_post_parent_id(0) ==11 // if the current page parent is about-us page and 11 is the id of about-us page.
]


Wordpress Class: assaign a particular class to a link.
-------------------------------------------------------
[
<li <?php if(is_page('about-us') or (wp_get_post_parent_id(0) ==11)) echo 'class="current-menu-item"' ?> ><a href="<?php echo site_url('/about-us') ?>">About Us</a></li>

/*wp_get_post_parent_id(0) => 0 means get the parent of the current page.
  11 is the id of about us page.
  We are saying if the current page is about-us or the childPage has a parent named about us then assign the special class to about us hyperlink to keep the header menu link glow.
*/
]


Wordpress Blog
--------------------
"Definition of blog. A blog (shortening of “weblog”) is an online journal or informational website displaying information in the reverse chronological order, with latest posts appearing first. It is a platform where a writer or even a group of writers share their views on an individual subject."


Create two blank pages home and blog.
admin.settings->ReadSettings
    Front Page = Home
    Blog Page = Blog
copy all the code in index.php to front-page.php
delete  everything from index.php

now front-page.php will serve as Home page automatically.
and index page will serve as blog. url =http://amazingcollege.test/blog/

bloginfo ('name'); // will display site title = amazin college
echo site_url('/blog') //blog url

[Steps to create a blog]

1. index.php
2. single.php
3. archive.php // for custom description, see archiveTitleByType.php

//to show the author name in capital, go to admin->user->profile and set nickname in CAPS and display nickname.

// to get the category of the current post
echo get_the_category_list(', ')

//help
type wordpress <function name>  in google

Admin-> settings -> reading settings -> blog pages. set the no of posts to display..
single.php  is for individual posts
page.php  is for individual pages.


//to identify a blog we have functions
is_home() , is_archive(),is_author(),is_category(),
or simply use ,  if(get_post_type()=='post'


Wordpress Archive.
------------------------
archive.php triggers when view posts by author,date or category.
in the abscense of archive.php, index.php will serve the functionaliy.
copy all contents of index.php into archive.php.

Biography for archives obtained from admin.users.profile.biographical info
and
Category description from Posts->Categories->Edit Category
and set description.
we can view the descrition as the_archive_description();

the_archive_title(); // for archive by date/category.

if (is_category()) { single_cat_title();}
if (is_author()){ echo 'Posts by '; the_author();}
echo paginate_links();

Posted by the_author_posts_link() on the_time('n.j.y') in echo get_the_category_list(', ');

To set title of archive with if statements, see archiveTitleByType.php.
To let wordpress set the title of archive, see archive.php


Wordpress custom querries:
------------------------------
// to limit the content
echo wp_trim_words( get_the_content(), 18);
wp_reset_postdata(); //clearing the cache for custom querries and set to the previous state of variables.


        front-page.php
        ----------------
        <?php
            //wp_querry for posts/pages
            $args = array(
                'posts_per_page' =>2
            );
            //'post_type' => 'post'  //will display all posts
            //'post_type' => 'page'  // will display all pages
            //'categoy_name' => 'awards' // posts falling in awards category
            $homepagePosts = new WP_Query($args);
            while ($homepagePosts->have_posts()){
              $homepagePosts->the_post();?>
            }
        ?>



        <?php
            //wp_querry for custom post events
          $args = array(
              'posts_per_page' => 2,
              'post_type' => 'event'
          );
          $homepageEvents = new WP_Query($args);
          while ($homepageEvents->have_posts()){
            $homepageEvents->the_post();
          }

        ?>
          ----------------------------------------
          $today = date('Ymd');
          $whereQueryforcustomfield1 =array(
                        'key'=>'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type'=>'numeric'
                      );

          $whereQuery = array(
              'paged' => get_query_var( 'paged', 1 ),//to get the page no from url bar.
             //to be used with pagination links. 1 is for default page if not found

              'posts_per_page' => 2,    //-1 means gives all posts with following coditions. if commented, default 10 posts per page will get displayed.

              'post_type' => 'event',
              'meta_key' => 'event_date',  // for custom field event_date.
              'orderby' =>'meta_value_num',   //'orderby' =>'post_date',title,rand,meta_value
              'order'=>'ASC',  //ASC,DESC
              'meta_query' => array($whereQueryforcustomfield1)
          );
          $homepageEvents = new WP_Query($whereQuery);
          while ($homepageEvents->have_posts()){
            $homepageEvents->the_post(); ?>
                echo date("M", strtotime(get_field('event_date')));-----(B)


        echo paginate_links(array(
            'total'=>$pastEvents->max_num_pages
        ));
            ----------manipulating default url based querries----------

              Filename:functions.php
              add_action( 'pre_get_posts', 'university_adjust_queries');

Wordpress html:
--------------------
homepage design
    http://localhost/learn_v2/
/home/rehan/Downloads/wordpresslectures/university-static-master/learn $
/home/rehan/Documents/css

Lectures:
/home/rehan/Downloads/wordpresslectures


Wordpress CSS:
--------------------

//to display banner.
<div class="page-banner">

//to display contents in the centre.
<div class="container container--narrow page-section">


//for border and space between each post.
<div class="post-item"></div>

//for title with hover effect normally with <h2>
class = headline headline--medium headline--post-title

//class converts hyperlink into a blue button
class ="btn btn--blue"


<hr class="section-break">
<ul class="link-list min-list">

//to look nice author names and dates
class "metabox" //with yellow background
//meta box for breadcumb
<div class="metabox metabox--position-up metabox--with-home-link">

//to display contents below the title image.
class generic-content

//generate home button
<i class="fa fa-home" aria-hidden="true"></i>

// to glow selected menu item in header.php
 <li <?php  if(get_post_type()=='post') echo 'class="current-menu-item"' ?> ><a href="<?php echo site_url('/blog');?>">Blog</a></li>

<li <?php if(is_page('about-us') or (wp_get_post_parent_id(0) ==11)) echo 'class="current-menu-item"' ?> ><a href="<?php echo site_url('/about-us') ?>">About Us</a></li>


//A two column layout in single-program_relationship2with_professors.php
[
      <div class="generic-content">
          <div class="row group">
              <div class="one-third"></div>
              <div class="two-thirds"></div>
          </div>
      </div>

    // remove bullets and put name in a row
    <li class="professor-card__list-item">
    <a class="professor-card" href="#"> </a> // class gives backgroud color.




    //image overlay and rotate angle css.
    ------------------------------------
    <ul class="professor-cards">
          <li class="professor-card__list-item">
              <a class="professor-card" href="<?php the_permalink();?>">
                    <img class="professor-card__image" src="<?php the_post_thumbnail_url();?>">
                    <span class="professor-card__name"><?php the_title();?></span>
              </a>
          </li>
    </ul>
]


wordpress icons
--------------------------
to download icons
https://developer.wordpress.org/resource/dashicons/#sort
//remember the code name of icon to type in functions.php to be used in register_post_type in functions.php or plugin directory . custom post types should be placed in plugins older.

wordpress plugins / downloaded plugins.
------------------------------
  there are two standard custom fields.
    Advanced custom fields (ACF)  by elliot condon.
        https://wordpress.org/plugins/advanced-custom-fields/
        https://downloads.wordpress.org/plugin/advanced-custom-fields.5.7.7.zip

to regenerate plugins, we have
https://downloads.wordpress.org/plugin/regenerate-thumbnails.zip
to manual crop images we have
https://downloads.wordpress.org/plugin/manual-image-crop.1.12.zip
for role permissios to assign to different post types.
https://downloads.wordpress.org/plugin/members.2.1.0.zip
for migrating mysql database in single file.
https://wordpress.org/plugins/all-in-one-wp-migration

for mysql deployment
https://wordpress.org/plugins/wp-migrate-db/

update the secret keys by visiting
https://api.wordpress.org/secret-key/1.1/salt/ and update the wp-config.php file.

wordpress plugins/ creating custom events
-------------------
create a folder as /var/www/amazingcollege/public_html/wp-content/mu-plugins/university-post-types.php
php file in this folder will behave as functions.php. the functionality will remain available even if switch the theme

function university_post_types() {

$post_type='event';
$labels =array(
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event'
);
$rewrite =array(
'slug' => 'events'
);
$support_avaliable_for_custom_posts =array(
  'title','editor','excerpt','custom-fields'
);



// rewrite => to change the slug name of events archive.  http://amazingcollege.test/events/
// has_archive => to tell word press that custom type event supports archive.
//labels => to change label captions in admin.event custom type created.
//menu_icon => the value obtained from https://developer.wordpress.org/resource/dashicons/#sort
//'support' => feature to enable excerpt
  register_post_type($post_type, array(
    'support' => $support_avaliable_for_custom_posts,
    'rewrite' => $rewrite,
    'has_archive' => true,
    'public' => true,
    'labels' => $labels,
    'menu_icon' => 'dashicons-calendar'
  ));
}
add_action('init', 'university_post_types');



wordpress urls (Search Overlay):
----------------------
/* for icons visit https://developer.wordpress.org/resource/dashicons/#sort */
/* for more label items visit https://codex.wordpress.org/Function_Reference/register_post_type  */
/*https://developer.wordpress.org/rest-api/*/


wordpress jQuery:
---------------------
/js/modules/Search.js
/js/scripts.js
logic file: /info/925-liveSearch.php [to] 933-finalyzing search overlay.php

925-liveSearch.php
---------------------
Search.js describe
    how to turn html tags into buttons and controls and how to map methods.
    typing logic
    adding, removing classes at run time.
    make search global by listening to all the pages.
    key ='s' to open Search overlay and 'ESC' to close search overlay


wordpress json /Rest Api:
--------------------
//search div in footer.php
//in /js/modules/ search.js   getResults()
//$.getJSON(url,delegated function);
$.getJSON('http://localhost:3000/wp-json/wp/v2/posts?search=' + this.searchField.val() ,function(posts){}

using: anonymus fuction taking a parameter named 'posts':
$.getJSON('http://localhost:3000/wp-json/wp/v2/posts?search=' + this.searchField.val() ,posts=>{})

template literal = `` // it let  us to write html in different lines. it is the key button before 1 button over keyboard.

${} //this combination tells javascript that we are going to use java code instead of pure text in a template literal.

postman is the software used to represent json in readable format.

<li><a href="${posts[0].link}">${posts[0].title.rendered}</a></li>

using arrow function: //926-json and template literal.php
---------------------
var posts=['red','orange','yellow'];
//map() points to a annonymous arrow function which takes a parameter =item. here item will point to contents of posts.
${posts.map(item=>`<li>${item}</li>`)} // this will print red,orange,yellow
${posts.map(item=>`<li>${item}</li>`).join('')} // this will print red,orange,yellow in seperate lines.


Asynchronous call
----------------------
$.when($.getJSON(url1),$.getJSON(url2)).then((resultJquery1,resultJquery2)=>{},errorHndler);

// replacing localhost:3000  /  universityData declared in functions.php
var postsUrl = universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val();


Synchronous call
---------------------

$.getJSON(postsUrl ,postedJsonDataForPosts =>{
    $.getJSON(pagesUrl , postedJsonDataForPages =>{
      combinedSearchResults = postedJsonDataForPosts.concat(postedJsonDataForPages);
      this.resultsDiv.html(`
                        <h2 class ="search-overlay__section-title" >General Information</h2>
                         ${combinedSearchResults.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
                         ${combinedSearchResults.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
                         ${combinedSearchResults.length ? '</ul>' : ''}
                        `);
    });
});


Custom Routes: /inc/search-route.php , /js/search.js
-----------------------
objective:
http://amazingcollege.test/wp-json/university/v1/search?term=award
http://amazingcollege.test/wp-json/university/v1/search?term=about
http://amazingcollege.test/wp-json/university/v1/search?term=barksalot
http://amazingcollege.test/wp-json/university/v1/search?term=biology
http://amazingcollege.test/wp-json/university/v1/search?term=award
http://amazingcollege.test/wp-json/university/v1/search?term=biology


add_action('rest_api_init','universityRegisterSearch');
    register_rest_route( $namespace, $route, $routeFunctions, false );
        $namespace='university/v1'; $route ='search';
        $routeFunctions =array(
        'methods' =>WP_REST_Server::READABLE,  // or 'GET'
        'callback' =>'universitySearchResults'  // function name to receive json data.
          );


function universitySearchResults($data){
  $queryFilter =array(
    'post_type'=>array('post','page','Professor','program','campus','event'),
    's'=>sanitize_text_field($data['term'])
      );


  $mainQuery = new WP_Query($queryFilter);
  $results = array(
              'generalInfo'=>array(), //for blogpost and page
              'professors'=>array(),
              'programs'=>array(),
              'events'=>array(),
              'campuses'=>array()
            );

      while ($mainQuery->have_posts()){
        $mainQuery->the_post();
            if (get_post_type()=='post' OR get_post_type()=='page'){
                    $Properties = array(
                                  'title'=>get_the_title(),
                                  'permalink'=> get_the_permalink()
                    );
                    array_push($results['generalInfo'], $Properties);
                    }}
}

Finals of SearchOverlay and Relationships:
----------------------------------------------
    Events => Programs
    Professor => Programs
                  programs  => Campuses


Steps:
1. design search overlay in footer.php.
2. design jquery in /js/modules/Search.js
    2.b moved search overlay in Search.js
    2.c created Event listners -> Search.js -> events()
3. register CusomRestAPI in /inc/search-route.php->universityRegisterSearch
       http://amazingcollege.test/wp-json/university/v1/search?term=math
4. Generate output for restApi in /inc/search-route.php -> universitySearchResults($data)
5.Display search overlay results in /js/Search.js => getResults ()


Steps for:
    4. Generate output for restApi in /inc/search-route.php -> universitySearchResults($data) :
        4.a. generated arrays from post types 'post','page','Professor','program','campus','event'
        4.b. Generated relationship search for programs
              4.b.1. with Events and Professors.
              4.b.2.  with campuses as the relationship is opposite to 4.b.1.

Note: While will be used with WP_Query.
      foreach will be used with arrays.

Wordpress Traditional Search Overlay:
-----------------------------------------

step:
934-traditionalSearch.php
FileNme: page-search.php



Wordpress Rest API
------------------------------
927-customizingRestApi.php .....upto .....937-setting up permissions for rest api.php


WordPress Likes with custom rest api.
----------------------------------------
FileName: 938b-HeartLikes-click-event.php

in MyNotes.js we created posts using jquery and rest api.
in like-route.php, we can use wordpress function to create a post as
wp_insert_post(array(
    'post_type' => 'like',
    'post_status' => 'publish',
    'post_title' => 'Our PHP Create Post Test',
    'post_content' => 'Hello world 123.'

  ));

wp_delete_post($likeId,true); //will false, trash will get empty.

Flow of Information:
  //the status is set in single-professor.php using wp_query and css property
  single-professor.php -> .Likebox -[data-professor] //here profossorId assaigned.
      -> Like.js -> event_listener ->createLike()->$data; // a jquery ajax call contains professorId.
            -> Functions.php -> like-route.php -> function createLike($data) //here like post inserted.



using nonce in MyNotes.js and like.js //for security reasons.
    $.ajax({
      beforeSend: (xhr)=> {
        xhr.setRequestHeader('X-WP-Nonce',universityData.nonce);
      }, //adding attributes to request for trust. nonce created in functions.php



wordpress ajax /java (like.js)
------------------------------------------

import $ from 'jquery';
this.events();
$(".like-box").on("click", this.ourClickDispatcher.bind(this));

//reading the value from like box.
var currentLikeBox = $(e.target).closest(".like-box");

currentLikeBox.attr('data-exists') // recommended. always use fresh values.
currentLikeBox.data('exists') // not recommended.
currentLikeBox.attr('data-exists','yes'); //setting html element with yes
currentLikeBox.find(".like-count").html(); //finding counter in like.js
currentLikeBox.find(".like-count").html(likeCount) // setting counter in like.js
var likeCount=parseInt("25" , 10) // converting string 25 into integer 25 with base 10.

      $.ajax({
          beforeSend: (xhr)=> {
            xhr.setRequestHeader('X-WP-Nonce',universityData.nonce);
          }, //adding attributes to request for trust. nonce created in functions.php

          // target=>functions.php->like-route.php->createLike($data);
          url: universityData.root_url + '/wp-json/university/v1/manageLike',
          type: 'POST', // or type: 'DELETE'
          data: {'professorId': '169'},
          success: (response) => {
            console.log(response);
          },
          error: (response) => {
            console.log(response);
          }
        });

Search.js:
this.openButton=$(".js-search-trigger"); // attaching handler with html elements

events:
this.openButton.on("click",this.openOverlay.bind(this));
$(document).on("keydown",this.keyPressDispatcher.bind(this));  // keyevent on this browser window.
this.searchField.on("keyup",this.typingLogic.bind(this));

// adding the class will make the div visibile
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll"); //hide scroll bar

         //search text box get active by default.
     //this.searchField.focus(); // will not work because css is in transition for searchoverlay. we need to wait for 300 mili seconds.
    //setTimeout(()=>this.searchField.focus(),301); //valid
    setTimeout(()=>this.searchField.focus(),301);
    this.searchField.val(''); //make the searchbox empty.

    //removing the class will make the div invisible.
    this.searchOverlay.removeClass("search-overlay--active");

  keyPressDispatcher(e) {
    //console.log(e.keyCode); // prints the code of key pressed.
    if (e.keyCode==83 && !this.isOverlayOpen && !$("input,textarea").is(':focus') ){
      /* Explain: !$("input,textarea").is(':focus').
          with jquery we place check not to open overlay search area if any text box or text area
          is in focus in any of the pages. as keyPressDispatcher is associated with browser event and will be listening
          on all the pages in the web application.
      */
      // 83 is the s key ,27 is the escape key
}
      //load spinner first before timer interval
      if (!this.isSpinnerVisible){
          this.resultsDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible=true;
          }

     /*note: the spinner will close in getresults method as the spinner class will be removed..
     //this.typingTimer= setTimeout(function(){ console.log("this is timeout test"); },2000);
     //setTimeout(x,2000); //call function after 2 seconds.
     // or call anonymous function as above
       2000 => 2 seconds. / 750 = quarter of a second.
     */
     this.typingTimer=setTimeout(this.getResults.bind(this),750);



Wordpress (A json call) search.js:
------------------------------
      var postURL=universityData.root_url + '/wp-json/university/v1/search?term=' + this.searchField.val();
      //$.getJSON(x,function(result){});
      $.getJSON(postURL,(result)=>{
        //console.log(result);
          this.resultsDiv.html(`
                  <div class="row">
                      <div class="one-third">
                        <h2 class ="search-overlay__section-title">General Information</h2>
                           ${result.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
                           ${result.generalInfo.map(item=>`<li><a href="${item.permalink}">${item.title}</a>${item.postType=='post' ? ` by ${item.authorName}` : ''} </li>`).join('')}
                           ${result.generalInfo.length ? '</ul>' : ''}
                      </div>
                  </div> `) }
Asynchronous call:
    var postsUrl = universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val();
    var pagesUrl = universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val();
    $.when($.getJSON(postsUrl),$.getJSON(pagesUrl)).then((postedJsonDataForPosts,postedJsonDataForPages)=>{
      combinedSearchResults = postedJsonDataForPosts[0].concat(postedJsonDataForPages[0]);
    }, ()=>{this.resultsDiv.html(`<p>Unexpected error; Please try again.</p>`)});


Synchronous call:
  $.getJSON(postsUrl ,postedJsonDataForPosts =>{
      $.getJSON(pagesUrl , postedJsonDataForPages =>{
          combinedSearchResults = postedJsonDataForPosts.concat(postedJsonDataForPages);
        }}



wordpress tips n urls:
https://deliciousbrains.com/creating-custom-table-php-wordpress/
https://developer.wordpress.org/reference/functions/dbdelta/#source
https://codex.wordpress.org/Category:API
https://codex.wordpress.org/Blog_Design_and_Layout
https://codex.wordpress.org/Developing_a_Colour_Scheme
https://htmlcolors.com/palette/90/website-palette
https://www.shivarweb.com/13033/how-to-make-a-web-design-color-palette/
https://wordpress.org/plugins/advanced-custom-fields/


MyDocuments/WordPress/Working With Database
MyDocuments/WordPress/Working With Database


------------------------------------------
prventing injections / wordpress security:

esc_attr // when reading actual value.
esc_html
esc_textarea( $text ); // for text area.

in page-my-notes.php
echo  str_replace('Private:','',esc_attr(get_the_title()));
echo esc_textarea(get_the_content());

//plain text. in functions.php->makeNotePrivate
sanitize_textarea_field( $str );
sanitize_text_field($data['post_title']);

--------------------------------------------
for automatic updates:
add_filter''('allow_dev_auto_core_updates','__return_true')
943-automatic updates.txt

for free hosting:
goto wordpress.org -> hosting



for deployments: 939-LiveFreehostingAccount.php
update the secret keys by visiting
https://api.wordpress.org/secret-key/1.1/salt/ and update the wp-config.php file.


Version Control:
943-automatic updates.txt
bitbucket.org.
940-repository.php
941-deployhq.php


944-custom-query-variables and form parameters
add_filter( 'query_vars', 'universityQueryVars'); in functions.php for query variables.

wordpress jquery:
-------------------------------
jquery.com
jquery is an abstraction layer of javascript library.
jquery is very similar to writing plain regular javascript.

the following designed for single page applications.
react.org  *** prefeffered.
angular.io // for mobile and desktop.
vuejs.org


wordpress vagrant setup:
-------------------------
www.virtualbox.org
www.vagrantup.com
www.puphpet.com

946-flywheel and vagrant setup.php
947-virtual box and vagrant.php

