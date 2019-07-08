Files: single-professor.php , page.php , functions.php

copy following div from single-professor into the function pageBanner() into functions.php

  <div class="page-banner">
    <?php
      /*$pageBannerImage=get_theme_file_uri('/images/ocean.jpg');
       usage: echo $pageBannerImage;
      */
      $pageBannerImage=get_field('page_banner_background_image');
      //usage: echo $pageBannerImage['url'] or  $pageBannerImage['sizes']['pageBanner']
    ?>
    <div class="page-banner__bg-image" style="background-image: url(<?php echo  $pageBannerImage['sizes']['pageBanner']; ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title();?></h1>
      <div class="page-banner__intro">
        <p><?php the_field('page_banner_subtitle');?></p>
      </div>
    </div>
  </div>

replace this above code and call function pageBanner(); in pages page.php (for about us pages) / single-professor.php

--------------------------------------------------------------------------------

// in page.php
<?php
$args=array(
  //'title' => 'hello! there is the title',
  //'subtitle' => 'this is subtitle',
  'photo' => 'https://images.unsplash.com/photo-1493246507139-91e8fad9978e?dpr=1&auto=format&fit=crop&w=1500&h=1000&q=80'
);
//'https://images.unsplash.com/photo-1493246507139-91e8fad9978e?dpr=1&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop='

pageBanner($args);?>
------------------------------------------
replaced following with pageBanner function. Archives does not have title and subtitle in database.
archive-event.php , archive-program.php
archive.php uses blog info. where we have filter by author name and category name. and title generated at run time. so we used the function get_the_archive_title() and get_the_archive_description().
index.php for blog/archive root.
page-past-events.php
page.php
single-event.php.
    for poetry day event, upload note icon image and subtitle description the greatest day of the year.
single-professor.php
single.php // for blog posts.
