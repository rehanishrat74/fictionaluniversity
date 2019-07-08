<?php
get_header();

$args=array(
      'title'=>'Past Events',
      'subtitle'=> 'A recap of our past events.'
    );
pageBanner($args);

?>

<!--
  replaced following with pageBanner function. Archives does not have title and subtitle in database.
 <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Past Events</h1>
      <div class="page-banner__intro">
        <p>A recap of our past events.</p>
      </div>
    </div>
  </div>
-->

  <div class="container container--narrow page-section">
    <?php

          //$today = date('d/m/Y');
          //$today = date("F j, Y", strtotime(date()));
        //$today = date("F j, Y", (date('Ymd')));
        //$today = date("F j, Y");
        $today = date('Ymd');
          $whereQueryforcustomfield1 =array(
                        'key'=>'event_date',
                        'compare' => '<',
                        'value' => $today,
                        'type'=>'numeric'
                      );

          $whereQueryForPastEvents = array(
              'paged' => get_query_var( 'paged', 1 ),//to get the page no from url bar.
               //to be used with pagination links. 1 is for default page if not found

              //'posts_per_page' => 1,
              //-1 means gives all posts with following coditions. if commented, default 10 posts per page will get displayed.
              'post_type' => 'event',
              'meta_key' => 'event_date',  // for custom field event_date.
              'orderby' =>'meta_value_num',   //'orderby' =>'post_date',title,rand,meta_value
              'order'=>'ASC',  //ASC,DESC
              'meta_query' => array($whereQueryforcustomfield1)
          );
          //$queryPostEvent = new WP_Query($whereQuery);


      $pastEvents = new WP_Query($whereQueryForPastEvents);

        while($pastEvents->have_posts()){
          $pastEvents->the_post();
          echo get_template_part( 'template-parts/content', 'event' );

        }
        //echo paginate_links(); /* this will not work because we ar using custom querry*/
        echo paginate_links(array(
            'total'=>$pastEvents->max_num_pages
        ));
    ?>
  </div>
<?php get_footer();

?>
Filename: page-past-events.php for list of custom posts type event.
