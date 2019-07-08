<?php
//always regenerate permalink whenever register new type or do changes.

function create_campus_post_type(){

$post_type='campus';
$labels =array(
      'name' => 'Campuses',
      'add_new_item' => 'Add New Campus',
      'edit_item' => 'Edit Campus',
      'all_items' => 'All Campuses',
      'singular_name' => 'Campus'
);
$rewrite =array(
'slug' => 'campuses'
);
/*$support_avaliable_for_custom_posts =array(
  'title','editor','excerpt','custom-fields'. we dont use custom fields but
  install  Advanced custom fields (ACF) by elliot condon.
  CMB2 (Custom Metaboxes 2) is another one that can be used.
);*/
$support_avaliable_for_custom_posts =array(
  'title','editor','excerpt'
);

// rewrite => to change the slug name of events archive.  http://amazingcollege.test/events/
// has_archive => to tell word press that custom type event supports archive.
//labels => to change label captions in admin.event custom type created.
//menu_icon => the value obtained from https://developer.wordpress.org/resource/dashicons/#sort
//supports => to make the post related default functions available.

  register_post_type($post_type, array(
    'capability_type' => 'campus',
    'map_meta_cap' => true,
    'supports' => $support_avaliable_for_custom_posts,
    'rewrite' => $rewrite,
    'has_archive' => true,
    'public' => true,
    'labels' => $labels,
    'menu_icon' => 'dashicons-location-alt'
  ));
}


function create_event_post_type(){

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
/*$support_avaliable_for_custom_posts =array(
  'title','editor','excerpt','custom-fields'. we dont use custom fields but
  install  Advanced custom fields (ACF) by elliot condon.
  CMB2 (Custom Metaboxes 2) is another one that can be used.
);*/
$support_avaliable_for_custom_posts =array(
  'title','editor','excerpt'
);

// rewrite => to change the slug name of events archive.  http://amazingcollege.test/events/
// has_archive => to tell word press that custom type event supports archive.
//labels => to change label captions in admin.event custom type created.
//menu_icon => the value obtained from https://developer.wordpress.org/resource/dashicons/#sort
//supports => to make the post related default functions available.

  register_post_type($post_type, array(
    'capability_type' => 'event',
    'map_meta_cap' => true,
    'supports' => $support_avaliable_for_custom_posts,
    'rewrite' => $rewrite,
    'has_archive' => true,
    'public' => true,
    'labels' => $labels,
    'menu_icon' => 'dashicons-calendar'
  ));
}
function create_program_post_type(){

$post_type='program';
$labels =array(
      'name' => 'Programs',
      'add_new_item' => 'Add New Program',
      'edit_item' => 'Edit Program',
      'all_items' => 'All Programs',
      'singular_name' => 'Program'
);
$rewrite =array(
'slug' => 'programs'
);

$support_avaliable_for_custom_program_posts =array(
//  'title','editor'
  'title'
);
// we hide the default editor as will be using WYSISYG editor so keywords for different subjects in programs posts should not be searched by WP_Query in  /inc/search-route.php custom Rest API. we will replace content logic also in single-program.php

  register_post_type($post_type, array(
    'supports' => $support_avaliable_for_custom_program_posts,
    'rewrite' => $rewrite,
    'has_archive' => true,
    'public' => true,
    'labels' => $labels,
    'menu_icon' => 'dashicons-awards'
  ));
}

function create_professor_post_type(){

$post_type='professor';
$labels =array(
      'name' => 'Professor',
      'add_new_item' => 'Add New Professor',
      'edit_item' => 'Edit Professor',
      'all_items' => 'All Professors',
      'singular_name' => 'Professor'
);
$rewrite =array(
'slug' => 'professors'
);

$support_avaliable_for_custom_professor_posts =array(
  'title','editor','thumbnail'
);


  register_post_type($post_type, array(
    'show_in_rest' =>true,  // the node will beome available in rest api
    'supports' => $support_avaliable_for_custom_professor_posts,
    /*we dont want archive for professor types*/
    //'rewrite' => $rewrite,
    //'has_archive' => true,
    'public' => true,
    'labels' => $labels,
    'menu_icon' => 'dashicons-welcome-learn-more'
  ));
}

function create_notes_post_type(){

$post_type='note';
$labels =array(
      'name' => 'Notes',    // in the admin left tree.
      'add_new_item' => 'Add New Note',
      'edit_item' => 'Edit Note',
      'all_items' => 'All Notes',
      'singular_name' => 'Note'
);
$rewrite =array(
'slug' => 'notes'
);

$support_avaliable_for_custom_note_posts =array(
  'title','editor','thumbnail','author'
  /*"supports": ["title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats", "none"]*/
);


  register_post_type($post_type, array(
    'capability_type' => 'note', // this can be any text reqd for new rights.and make notes available in user->roles.
    'map_meta_cap' => true, //enforce permission @ right time, @ right place. admin -> notes will crash otherwise.
    'show_in_rest' =>true,  // the node will beome available in rest api
    'supports' => $support_avaliable_for_custom_note_posts,
    /*we dont want archive for professor types*/
    //'rewrite' => $rewrite,
    //'has_archive' => true,
    'public' => false,  //notes must be pvt associated with each account. to resotre
    'show_ui'=> true,
    'labels' => $labels,
    'menu_icon' => 'dashicons-welcome-write-blog'
  ));
}


function create_like_post_type(){

$post_type='like';
$labels =array(
      'name' => 'Likes',    // in the admin left tree.
      'add_new_item' => 'Add New Like',
      'edit_item' => 'Edit Like',
      'all_items' => 'All Likes',
      'singular_name' => 'Like'
);
$rewrite =array(
'slug' => 'likes'
);

$support_avaliable_for_custom_like_posts =array(
  'title' //,'editor','thumbnail'. //we dont need these features in like posts.
  /*"supports": ["title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats", "none"]*/
);


  register_post_type($post_type, array(
    /*'capability_type' => 'like', // this can be any text reqd for new rights.and make notes available in user->roles.
    'map_meta_cap' => true, //enforce permission @ right time, @ right place. admin -> notes will crash otherwise.
    it will not required as we will handle rights ourselves.
    */
    'show_in_rest' =>false,  // we will use custom rest api instead.
    'supports' => $support_avaliable_for_custom_like_posts,
    /*we dont want archive for like types*/
    //'rewrite' => $rewrite,
    //'has_archive' => true,
    'public' => false,  //notes must be pvt associated with each account. to resotre
    'show_ui'=> true,
    'labels' => $labels,
    'menu_icon' => 'dashicons-heart'
  ));
}

function create_layer_for_SliderPosts(){
$post_type='sliderLayer';
$labels =array(
      'name' => 'SliderLayers',    // in the admin left tree.
      'add_new_item' => 'Add New SliderLayer',
      'edit_item' => 'Edit SliderLayer',
      'all_items' => 'All SliderLayers',
      'singular_name' => 'SliderLayer'
);
$rewrite =array(
'slug' => 'SliderLayers'
);

$support_avaliable_for_custom_sliderLayer_posts =array(
  'title' //,'editor','thumbnail'. //we dont need these features in like posts.
  /*"supports": ["title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats", "none"]*/
);


  register_post_type($post_type, array(
    //'capability_type' => 'sliderLayer', // this can be any text reqd for new rights.and make notes available in user->roles.
    //'map_meta_cap' => true, //enforce permission @ right time, @ right place.

    'show_in_rest' =>false,  // we will use custom rest api instead. / dont want to show in rest.
    'supports' => $support_avaliable_for_custom_sliderLayer_posts,
    /*we dont want archive for like types*/
    //'rewrite' => $rewrite,
    //'has_archive' => true,
    'public' => true,  //notes must be pvt associated with each account as false. to resotre
    'show_ui'=> true,
    'labels' => $labels,
    'menu_icon' => 'dashicons-format-image'  //'dashicons-images-alt2'
  ));
}
function create_slider_post_type(){
create_layer_for_SliderPosts();


$post_type='slider';
$labels =array(
      'name' => 'Sliders',    // in the admin left tree.
      'add_new_item' => 'Add New Slider',
      'edit_item' => 'Edit Slider',
      'all_items' => 'All Sliders',
      'singular_name' => 'Slider'
);
$rewrite =array(
'slug' => 'Sliders'
);

$support_avaliable_for_custom_slider_posts =array(
  'title' //,'editor','thumbnail'. //we dont need these features in like posts.
  /*"supports": ["title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats", "none"]*/
);


  register_post_type($post_type, array(
    //'capability_type' => 'slider', // this can be any text reqd for new rights.and make notes available in user->roles.
    //'map_meta_cap' => true, //enforce permission @ right time, @ right place.

    'show_in_rest' =>false,  // we will use custom rest api instead. / dont want to show in rest.
    'supports' => $support_avaliable_for_custom_slider_posts,
    /*we dont want archive for like types*/
    //'rewrite' => $rewrite,
    //'has_archive' => true,
    'public' => true,  //notes must be pvt associated with each account as false. to resotre
    'show_ui'=> true,
    'labels' => $labels,
    'menu_icon' => 'dashicons-format-gallery'
    // 'dashicons-format-image'  //'dashicons-images-alt2'
  ));
}





function university_post_types() {
    create_event_post_type();
    create_program_post_type();
    create_professor_post_type();
    create_campus_post_type();
    create_notes_post_type();
    create_like_post_type();
    create_slider_post_type();
}

add_action('init', 'university_post_types');

