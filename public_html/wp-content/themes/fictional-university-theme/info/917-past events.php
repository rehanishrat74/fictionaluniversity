create a page in wpadmin as past events to display posts of types event.
Filename: page-past-events.php

copy archive-event.php file and past it in page-past-events.php

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

        echo paginate_links(array(
            'total'=>$pastEvents->max_num_pages
        ));

?>

In archive-event.php
    <hr claass="section-break">
    <p>Looking for a recap of past events. <a href = "<?php echo site_url('past-events'); ?>">Checkout our past events archive.</a></p>
In header.php
assaign current menu item class to glow Event Menu in header.
<li <?php if (get_post_type()=='event' or is_page('past-events'))




