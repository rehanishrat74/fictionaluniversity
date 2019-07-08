
Added custom-fields in $support_avaliable_for_custom_posts in file mu-plugin folder.
there are two standard custom fields.
  Advanced custom fields (ACF)  by elliot condon.
      https://wordpress.org/plugins/advanced-custom-fields/
      https://downloads.wordpress.org/plugin/advanced-custom-fields.5.7.7.zip

  CMB2 (Custom Metaboxes 2)


after instlling ACF, assaign dates against events where post type = events in admin.
lets code in front-page.php


<?php
front-page.php

                //$date = get_field('event_date');
                //different formats
                $date2 = date("F j, Y", strtotime($date));

                $date2 = date("M", strtotime($date));
                or
                $eventDate = date("M", strtotime(get_field('event_date')));
                $eventDate = date("d", strtotime(get_field('event_date')));
-----------------------------------------------------------------------

          $args = array(
              'posts_per_page' => 2,    //-1 means gives all posts with following coditions.
              'post_type' => 'event',
              'orderby' =>'title',   //'orderby' =>'post_date',title,rand
              'order'=>'DESC'  //ASC,DESC
          );
          $homepageEvents = new WP_Query($args);
          while ($homepageEvents->have_posts()){
            $homepageEvents->the_post();

--------------------to query with custom fields ---------------------------

          $args = array(
              'posts_per_page' => -1,    //-1 means gives all posts with following coditions.
              'post_type' => 'event',
              'meta_key' => 'event_date',  // for custom field: event_date.
              'orderby' =>'meta_value_num',   //'orderby' =>'post_date',title,rand,meta_value,meta_value_num
              'order'=>'DESC'  //ASC,DESC
          );
          $homepageEvents = new WP_Query($args);
          while ($homepageEvents->have_posts()){
            $homepageEvents->the_post();
------------------------syntax for query and display---------------------
          //set the same "F j, Y" format in custom fields.
        $today = date('Ymd');
          $whereQueryforcustomfield1 =array(
                        'key'=>'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type'=>'numeric'
                      );

          $whereQuery = array(
              'posts_per_page' => 2,    //-1 means gives all posts with following coditions.
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



+Filename---archive-event.php


?>

