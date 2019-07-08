<?php


add_action('rest_api_init','universityLikeRoutes');

function universityLikeRoutes() {
  //register_rest_route(a,b,c);
  //register_rest_route(begeningURL [=namespace.],name of route/url,);
  register_rest_route( 'university/v1', 'manageLike', array(
    'methods' => 'POST',
    'callback' => 'createLike'
   ));

  register_rest_route( 'university/v1', 'manageLike', array(
    'methods' => 'DELETE',
    'callback' => 'deleteLike'
   ));

}



function createLike($data) {

  //Like.js will get data from data-attribute =professor in single-prefessor.php ->likebox.
  //ajax call from Like.js will post professorId here.

  /* sample:
  wp_insert_post(array(
    'post_type' => 'like',
    'post_status' => 'publish',
    'post_title' => 'Our PHP Create Post Test',
    'post_content' => 'Hello world 123.'
    'meta_input' => array)( //this will create custom fields (meta fields).
      'skyColor' => 'blue', //new filed will get added.
      'grassColor' => 'green'
      'liked_professor_id' => '61' // field value will get updated created using custom fields.
    )
  ));
*/


  if (is_user_logged_in()){

      $current_user = wp_get_current_user();
      /*
          echo 'Username: ' . $current_user->user_login . '<br />';
          echo 'User email: ' . $current_user->user_email . '<br />';
          echo 'User first name: ' . $current_user->user_firstname . '<br />';
          echo 'User last name: ' . $current_user->user_lastname . '<br />';
          echo 'User display name: ' . $current_user->display_name . '<br />';
          echo 'User ID: ' . $current_user->ID . '<br />';
      */
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

        //like does not exists by the logged in user for the professor, then create like.
        if($existQuery->found_posts==0 AND get_post_type($professor)=='professor'){
          /*get_post_type($professor)=='professor'. this line makes sure that passed professor id by ajax belongs to the post professor and not for e.g blog / page etc.
          */
                $professorName =get_the_title($professor);
                return wp_insert_post(array(
                  'post_type' => 'like',
                  'post_status' => 'publish',
                  'post_title' =>  $professorName . ' is liked by ' . $current_user->display_name  ,
                  'meta_input' => array(
                    'liked_professor_id' => $professor
                  )
                ));
                //wp_insert_post will return an id of the newly created post.

        }else {
              die ('Invalid Professor Id.');
        }

  }else {
      die ('Only logged in users can create like.');
  }


}


function deleteLike($data) {

  $likeId = sanitize_text_field($data['like']);
  if (get_current_user_id()==get_post_field( 'post_author', $likeId ) AND get_post_type($likeId)=='like') {
    // if the current user id is the author of the like_post_id and the post type is also of 'like'
      wp_delete_post($likeId,true); //will false, trash will get empty.
      return 'Congrats, like deleted.';
  } else {
    die ("You do not have permission to delete that.");
  }

}

?>
