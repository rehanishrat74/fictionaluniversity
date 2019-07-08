<?php
get_header();
$args = array(
      'title' =>'Our Campuses',
      'subtitle' =>'We have several conveniently located campuses.'
  );
pageBanner($args);

?>
<!--
    archive.php uses blog info. where we have filter by author name and category name. and title generated at run time. so we used the function get_the_archive_title() and get_the_archive_description().
    replaced following with pageBanner function. Archives does not have title and subtitle in database.
 <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">All Programs</h1>
      <div class="page-banner__intro">
        <p>See programs in our university.</p>
      </div>
    </div>
  </div>
-->

  <div class="container container--narrow page-section">
    <!--<ul class="link-list min-list">-->
     <div class="acf-map">
    <?php
        while(have_posts()){
          the_post();
          $mapLocation=get_field('map_location');

          ?>
          <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
              <!-- composing googlemap pin details-->
              <h3> <a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
              <?php  echo $mapLocation['address']; ?>
          </div>
          <!--
          <li><a href="<?php the_permalink();?>">
              <?php the_title(); $mapLocation=get_field('map_location'); print_r($mapLocation);?>
              </a></li>
          -->

        <?php }
        //echo paginate_links();
    ?>
    <!--</ul> -->
    </div>

  </div>
<?php get_footer();

?>
Filename: archive-campus.php for custom posts type event.
