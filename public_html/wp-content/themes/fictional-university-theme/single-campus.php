<?php
//mu.university-post-types.php  /*types created here.*/
get_header();

while (have_posts() ) {
the_post();

pageBanner(); //defaults will get applied.
 ?>
 <!--
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title();?></h1>
      <div class="page-banner__intro">
        <p>Dont forget to replace me later.</p>
      </div>
    </div>
  </div>
-->

<div class="container container--narrow page-section">
        <!-----Display--Breadcumb area- ---------------->
  <div class="metabox metabox--position-up metabox--with-home-link">
    <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus');?>"><i class="fa fa-home" aria-hidden="true"></i> All Campuses</a> <span class="metabox__main"><?php the_title();?>   </span></p>
  </div>

  <div class="generic-content">
      <?php the_content();?>
  </div>
     <div class="acf-map">
          <?php $mapLocation=get_field('map_location'); ?>

          <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
              <!-- composing googlemap pin details-->
              <h3> <?php the_title();?></h3>
              <?php  echo $mapLocation['address']; ?>
          </div>

    </div>

  <!-----Displaying of Programs/subjects taught over thts campus related campus field---->
    <?php  include 'single-campus_relationship1with_programs.php'; ?>
    <?php wp_reset_postdata();?>

</div>

<?php }
get_footer();

?>

Filename: single-campus.php for custom posts type event.
