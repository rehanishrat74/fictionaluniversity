<?php
add_filter( 'query_vars', 'universityQueryVars');
//944-custom-query-variables.php .
function universityQueryVars($vars) {
  //query variables in address bar.
  $vars[]='skyColor'; //will use in page.php
  $vars[]='grassColor';
  return $vars;
}



require get_theme_file_path('inc/like-route.php');
require get_theme_file_path('inc/search-route.php');



/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

  register_sidebar( array(
    'name'          => 'Home right sidebar',
    'id'            => 'home_right_1',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="rounded">',
    'after_title'   => '</h2>',
  ) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );


function university_custom_rest() {
  //register_rest_field( $post_type, $newFieldName, array( '' ) );
  register_rest_field( 'post', 'authorName', array(
      //assainging value to  autorName parameter.
      //we can verify the author name as http://amazingcollege.test/wp-json/wp/v2/posts
      'get_callback' => function() {return get_the_author();}
     ) );


// at the time of deleting notes, we need to hide the error message of max limit. so we need note count property.

     register_rest_field( 'note', 'userNoteCount', array(
      //assainging value to  autorName parameter.
      //we can verify the author name as http://amazingcollege.test/wp-json/wp/v2/posts
      'get_callback' => function() {return count_user_posts( get_current_user_id(), 'note');}
     ) );


}
add_action('rest_api_init','university_custom_rest');


function university_files(){
      //to load javascript
      //wp_enqueue_script( anyGivenName=main-university-js_file location="/js/scripts-bundled.js" ,any_dependent_script=NULL,version=1.0,right before the body closing tag </body> = so jscript get loaded in the end rather in the begening.);
      //for slides to slide.
      //wp_enqueue_script( 'main-university-js',get_theme_file_uri('/js/scripts-bundled.js'),NULL,'1.0',true);

// js to load googlemap.
        wp_enqueue_script( 'googleMap','//maps.googleapis.com/maps/api/js?key=AIzaSyBh9b1rNCp6kOi5JeMHiRP4klDymBeoEWk',NULL,microtime(),true);

        wp_enqueue_script( 'main-university-js',get_theme_file_uri('/js/scripts-bundled.js'),NULL,microtime(),true);
        //replace version with microtime to avaoid caching.



        //to use google fonts.
        wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');

        //facebook icons in footer.php will become available
        wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');


        //wp_enqueue_style('university_main_styles',get_stylesheet_uri());
        //wp_enqueue_style('university_main_styles',get_stylesheet_uri(),NULL='no dependencies',microtime=to avoid cache instead of version no.);
        wp_enqueue_style('university_main_styles',get_stylesheet_uri(),NULL,microtime());

        //wp_localize_script( 'main-university-js', 'universityData', array('root_url' => get_site_url()) );
        /* we declared a varialble universityData for javascript '/js/scripts-bundled.js' with a property of website url. we will use it in js/modules/Search.js.getResults();
        we can see this object property in view source of the page in a browser also.
        w*/
        wp_localize_script( 'main-university-js', 'universityData', array(
          'root_url' => get_site_url(),
          'nonce' => wp_create_nonce('wp_rest') //no used for once only for restapi security in MyNotes.js
        ) );

}
add_action('wp_enqueue_scripts','university_files');



function university_features() {
          // [ for dynamic menu
          //register_nav_menu( 'headerMenuLocation','Header Menu Location'); //(codingName,friendlyname)
          //In appearance tab menue will become available. now create menu in wordpress admin
          //in admin Appearance->Menu->Menusettings->displayLocation = Header Menu Location


          //now create two menus in the footer.
          //register_nav_menu( 'footerLocationOne','Footer Location One');
          //register_nav_menu( 'footerLocationTwo','Footer Location Two');
          // ]

          add_theme_support('title-tag'); //title-tag in browser tab
          /*
            format: <titile-tag> - Amazing University.
            Amazing University can be changed from Wordpress->AdminSettings.
          */

          add_theme_support('post-thumbnails'); //enable thumbnails features in admin
          //creating two additional custom sizes for images in upload folder. total images = 5+2 = 7
          add_image_size('professorLandscape',400,260,true); //format Name,width,height,crop allowed
          add_image_size('professorPortrait',480,650,true); //format Name,width,height,crop allowed
          //the crop position is centre by default. we can crop by specifying the position also.
        //  add_image_size('professorLandscape',400,260,array('left','top'));
          add_image_size('pageBanner',1500,350,true);
}
add_action( 'after_setup_theme', 'university_features');

/*to create custom events
/var/www/amazingcollege/public_html/wp-content/mu-plugins/university-post-types.php*/

/*overriding hooks for default querries associated with url.
--------------------------------------------------------------*/
function university_adjust_queries($query) {
        /*this query will effect all posts either blog/event/or admin pages. resulting in one row which is not reqd.*/
        //$query->set('posts_per_page','1');

        /*
        $query->is_main_query() // if it is the default query for a url and not custom query or blog.
        !is_admin() // it will not effect the admin.

        */

          if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query() ){
            //$query->set('posts_per_page','1'); // will display 1 row only with paging
                  $today = date('Ymd');
                  // donot show past events query
                  $whereQueryforcustomfield1 =array(
                                'key'=>'event_date',
                                'compare' => '>=',
                                'value' => $today,
                                'type'=>'numeric'
                              );

            $query->set('meta_key','event_date');
            $query->set('orderby','meta_value_num');
            $query->set('order','ASC');
            $query->set('meta_query',$whereQueryforcustomfield1);

          }
        // -------------------filter for custom post = program.

          if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query() ){
              $query->set('orderby','title'); //sort by title
              $query->set('order','ASC');     // Ascending order
              $query->set('posts_per_page',-1);
              }

       // -------------------filter for custom post = campus

          if (!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query() ){
              $query->set('posts_per_page',-1);
              }

}

add_action( 'pre_get_posts', 'university_adjust_queries');



function pageBanner($args=NULL)
{
          //setting default values.
          if(!isset($args['title'])){
              $args['title']=get_the_title();
          }
          if (!isset($args['subtitle'])) {
              $args['subtitle']=get_field('page_banner_subtitle');
          }
          if (!isset($args['photo'])) {
              if (get_field('page_banner_background_image')){
                  $args['photo'] =get_field('page_banner_background_image')['sizes']['pageBanner'];
              } else {
                $args['photo'] = get_theme_file_uri( '/images/ocean.jpg' );
              }
          }
  ?>
          <div class="page-banner">

          <?php
            /*$pageBannerImage=get_theme_file_uri('/images/ocean.jpg');
             usage: echo $pageBannerImage;
            */
            //$pageBannerImage=get_field('page_banner_background_image');
            //usage: echo $pageBannerImage['url'] or  $pageBannerImage['sizes']['pageBanner']

          ?>
          <div class="page-banner__bg-image" style="background-image: url( <?php echo
            $args['photo']; ?>);"></div>
          <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title'];?></h1>
            <div class="page-banner__intro">
              <p><?php echo $args['subtitle'];?></p>
            </div>
          </div>
        </div>
  <?php
}

function universityMapKey($api) {
  //get api key from https://developers.google.com/maps/documentation/javascript/get-api-key
  $api['Key']='AIzaSyBh9b1rNCp6kOi5JeMHiRP4klDymBeoEWk';
  return $api;
}

add_filter ('acf/fields/google-map/api','universityMapKey');


// Redirect subscriber accounts out of admin and onto homepage

function redirectSubsToFrontend(){
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles)==1 AND $ourCurrentUser->roles[0]=='subscriber') {
      wp_redirect(site_url( '/'));
      exit;
  }


}
add_action('admin_init','redirectSubsToFrontend');


function noSubsAdminBar(){
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles)==1 AND $ourCurrentUser->roles[0]=='subscriber') {
      show_admin_bar( false ); //top horizontal bar over page.
  }

}
add_action('wp_loaded','noSubsAdminBar');


// Customize Login Screen
//----------------------------------------------------------
function ourHeaderUrl(){
  //stopping user from redirecting to wordpress.org over login screen.
  return esc_url(site_url('/'));
}
add_filter('login_headerurl','ourHeaderUrl');



//hiding wordpress logo over login screen by overriding css styles.
function ourLoginCSS() {
  // css/modules/login.css will become active.
  /* we can check logo how get created with css if we inspect W element and comment this function.*/
  wp_enqueue_style('university_main_styles',get_stylesheet_uri());

  //to use google fonts.
  wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}
add_action('login_enqueue_scripts','ourLoginCSS');


//changing tooltime of worpress icon over login page.
function ourLoginTitle() {
  //replacing powered by wordpress over login page.
  return get_bloginfo('name');
}
add_filter( 'login_headertitle','ourLoginTitle');
//----End customize Login Screen------------------------------------------------------


//force note posts to be private.
function makeNotePrivate($data,$postarr) {
/*
  if ($data['post_type']=='note'){

    // to restore
    if (count_user_posts( get_current_user_id(), 'note') >4 AND !$postarr['ID']){
      //!$postarr['ID'] => if it will be a new post after post limit ends.
      die("You have reached your note limit."); // it will end the process and no new note will be created.
    }
    // stopping html from rendering wpadmin section for not posts for security.
    $data['post_content'] = sanitize_textarea_field($data['post_content']);
    $data['post_title'] = sanitize_text_field($data['post_title']);
  }
  if ($data['post_type'] =='note'){
    //if ($data['post_type'] =='note' AND $data['post_status']!='trash'){ to restore
      $data['post_status'] ="publish";
  }
*/

  if ($data['post_type'] == 'note') {
    if(count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID']) {
      die("You have reached your note limit.");
      /*!$postarr['ID'] => if it will be a new post as new post does not containt ID, and after post limit ends. die will end the process and no new note will be created.*/
    }

    $data['post_content'] = sanitize_textarea_field($data['post_content']);
    $data['post_title'] = sanitize_text_field($data['post_title']);
  }

  if($data['post_type'] == 'note' AND $data['post_status'] != 'trash') {
    $data['post_status'] = "private";
  }

return $data;
}
add_filter('wp_insert_post_data','makeNotePrivate',10,2);
/*usage 1:
function makeNotePrivate($data) {}
add_filter('wp_insert_post_data','makeNotePrivate');

Usage 2:
function makeNotePrivate($data,$postarr) {}
add_filter('wp_insert_post_data','makeNotePrivate',10,2);
//10 => priority, 2 => function will take two parameters.
*/

// priority explaination below.............................
/*
add_filter('wp_insert_post_data','makeNotePrivate',10,2);
add_filter('wp_insert_post_data','makeNotePrivate2',1,2);

in this case priorty with 1 will run first. and prioriry with 10 will run later.
*/

//--------------------------------------------------------

function dynamicSlider($args=NULL)
{?>

<div class="hero-slider">

    <?php
           if(!isset($args['sliderId'])){
              $args['sliderId']=164;
          }
      $whereQueryforFindLayers =array (
          'key' => 'related_slider',
          'compare' => 'LIKE',
          'value' =>  '"'. $args['sliderId'] .'"'  //Slide For Front Page
      );


          $whereQuery = array(
              'posts_per_page' => -1,    //-1 means gives all posts with following coditions.
              'post_type' => 'SliderLayer', // 'SliderLayer',
              //'meta_key' => 'related_slides',  // for custom field event_date.
              //'orderby' =>'meta_value_num',   //'orderby' =>'post_date',title,rand,meta_value
              'order'=>'ASC',  //ASC,DESC
              'meta_query' => array($whereQueryforFindLayers)
          );
          $SlideNames = new WP_Query($whereQuery);
          //print_r($SlideNames) ;
          while ($SlideNames->have_posts()){
            $SlideNames->the_post();
             $layerimage= get_field("page_banner_background_image");
          ?>

          <div class="hero-slider__slide" style="background-image: url(<?php echo $layerimage['sizes']['pageBanner'] ; ?>);">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center"><?php esc_attr(the_title());?></h2>
                <p class="t-center"><?php echo  esc_attr(get_field("page_banner_subtitle"));?></p>
                <p class="t-center no-margin"><a href="<?php echo esc_attr(get_field("link_for_learn_more"));?>" class="btn btn--blue"><?php echo esc_attr(get_field("caption_learnmore"));?></a></p>
              </div>
            </div>
          </div>
          <?php }
          wp_reset_postdata(); ?>
</div>
<?php
}










