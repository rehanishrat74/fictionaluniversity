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
    <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program');?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="metabox__main"><?php the_title();?>   </span></p>
  </div>

  <div class="generic-content">
      <?php
          //the_content(); we hide it to avoid unrelated search in search-route.php [/info/931-customRestApi with relational Search.php]
          the_field('main_body_content');
      ?>
  </div>
  <!-----Displaying of professors related with subjects/programs via admin.professor related prog field---->
    <?php  include 'single-program_relationship2with_professors.php'; ?>
    <?php wp_reset_postdata();?>
<!-- ---Displaying upcoming events.-of this subject/program via admin.events related prog field.------->
    <?php  include 'single-program_relationship1with_events.php'; ?>
  <!----End of Displaying upcoming events.-of this program with the relationship created.-->
</div>

<?php }
get_footer();

?>

Filename: single-program.php for custom posts type event.
