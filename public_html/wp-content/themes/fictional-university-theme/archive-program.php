<?php
get_header();
$args = array(
      'title' =>'All Programs',
      'subtitle' =>'See programs in our university.'
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
    <ul class="link-list min-list">
    <?php
        while(have_posts()){
          the_post(); ?>
          <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>

        <?php }
        echo paginate_links();
    ?>
    </ul>

  </div>
<?php get_footer();

?>
Filename: archive-program.php for custom posts type event.
