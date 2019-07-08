FileNames: single-professor.php
FileNames: muplug-in ->create_like_post_type()

<span class="like-box"></span>

The like posts does not have contents (editor and thumbnails.)
we need to create a custom field (Like Professor ID) for professor id in custom fields.
Required must be set as No / post type is equal to like.

Step 1.
//retrieving likes from custom field against the visited professor.
                  <?php
                      $likeCount = new WP_Query(array(
                        'post_type' => 'like',
                        'meta_query' => array(
                            array(
                              'key' =>'liked_professor_id',
                              'compare' => '=',
                              'value' => get_the_ID()  // id of the professor.
                            )
                        )
                      ));

  ---------lets modify the above query-to get the count of professor associated with logged in user.-----------

                      $existQuery = new WP_Query(array(
                        'author' => get_current_user_id(), // id of the current user.
                        'post_type' => 'like',
                        'meta_query' => array(
                            array(
                              'key' =>'liked_professor_id',
                              'compare' => '=',
                              'value' => get_the_ID()
                            )
                        )
                      ));
                    ?>
Step 2.
    Logic to show heart as blank heart or filled heart.
    <span class="like-box" data-exists="yes"> OR
    <span class="like-box" data-exists="no">
