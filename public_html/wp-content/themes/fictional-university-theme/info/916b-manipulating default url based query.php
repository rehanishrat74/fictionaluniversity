functions.php

<?php
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

}

add_action( 'pre_get_posts', 'university_adjust_queries');
?>
