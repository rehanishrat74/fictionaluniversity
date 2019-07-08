FileNames: single-professor.php
FileNames: muplug-in ->create_like_post_type()
FileNames: /js/modules/Like.js
Filenames: /inc/like-route.php // add this file name in functions.php

<?php

in Like.js
------------------
    // e.target is the current element.
    var currentLikeBox = $(e.target).closest(".like-box");
    //without closest, click on heart or number wont work as these are associated with <i> element.

?>

for custom routes and fields in rest api, we need to use hook rest_api_init.

<?php
add_action('rest_api_init','universityLikeRoutes');
function universityLikeRoutes() {
  //register_rest_route(a,b,c);
  //register_rest_route(begeningURL [=namespace.],name of route/url,);
  register_rest_route( 'university/v1', 'manageLike', array(
    'methods' => x,
    'callback' => x
   ));
}

we created two routes with same name. one for GET and the other for POST.
and we will call these routes from Like.js
Syntax: in createLike().
    $.ajax({
      url: x,
      type: 'POST',
      success: x,
      error: x
    });

---------------------------------
in MyNotes.js we created posts using jquery and rest api.
in like-route.php, we can use wordpress function to create a post as
   ---------------


Flow of Information:
  //the status is set in single-professor.php using wp_query and css property
  single-professor.php -> .Likebox -[data-professor] //here profossorId assaigned.
      -> Like.js -> event_listener ->createLike()->$data; // a jquery ajax call contains professorId.
            -> Functions.php -> like-route.php -> function createLike($data) //here like post inserted.

    Step1:
            -------------In like.js retrieving like posts as---------------
  createLike() {
    //alert("create test message");
    //default url = universityData.root_url + '/wp-json/wp/v2/posts'
      $.ajax({
          url: universityData.root_url + '/wp-json/university/v1/manageLike',
          type: 'POST',
          //data: {'skyColor':'blue', 'grassColor':'green' },
          data: {'professorId': '789'},
          // is equivalent to  universityData.root_url + '/wp-json/university/v1/manageLike?professorId=789',

          success: (response) => {
            console.log(response);
          },
          error: (response) => {
            console.log(response);
          }
        });
  }

   Step2: in functions.php -> like-route.php // receives call from jquery ajax like.js
function createLike() {

  wp_insert_post(array(
    'post_type' => 'like',
    'post_status' => 'publish',
    'post_title' => 'Our PHP Create Post Test',
    'post_content' => 'Hello world 123.'
    'meta_input' => array(( //this will create custom fields (meta fields).
      'skyColor' => 'blue', //new filed will get added.
      'grassColor' => 'green'
      'liked_professor_id' => '61' // field value will get updated created using custom fields.
    )
  ));
  return 'Thanks for trying to create a like.';
}

-------------------------------

like-route.php
  function createLike($data){
      if (current_user_can( 'publish_note' )){ } // we dont need that.
  }
//instead we need to check  if current user logged in and he did not created a like post and the id of the posted data is of type professor, only then create the note.

//-----------------it is achieved as -----------------------------------------------------
      $professor = sanitize_text_field($data['professorId']);
      //finding like of the current user against the professor id.
      $existQuery = new WP_Query(array(
          'author' => get_current_user_id(), // id of the current user.
          'post_type' => 'like',
          'meta_query' => array(
                             array(
                                  'key' =>'liked_professor_id',
                                  'compare' => '=',
                                  'value' => $professor
                                )
                            )
                          ));


        if($existQuery->found_posts==0 AND get_post_type($professor)=='professor'){
          /*get_post_type($professor)=='professor'. this line makes sure that passed professor id by ajax belongs to the post professor and not for e.g blog / page etc.
          */
                return wp_insert_post(array(
                  'post_type' => 'like',
                  'post_status' => 'publish',
                  'post_title' => 'Our PHP Create Post Test',
                  'meta_input' => array(
                    'liked_professor_id' => $professor
                  )
                ));
//--------------------------------------------------------------------------------------------

// if the current user id is the author of the like_post_id and the post type is also of 'like'
  $likeId = sanitize_text_field($data['like']);
  if (get_current_user_id()==get_post_field( 'post_author', $likeId ) AND get_post_type($likeId)=='like') {
      wp_delete_post($likeId,true); //wiith false, trash will get empty.
      return 'Congrats, like deleted.';
    }















?>
