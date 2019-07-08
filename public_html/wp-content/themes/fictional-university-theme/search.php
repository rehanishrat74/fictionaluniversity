<!--  HelpFile: 934-traditionalSearch.php
Related files : filename:page-search.php , searchform.php and search.php
-->

<?php
get_header();
$args =array(
    'title' => 'Search Results',
    //'subtitle' => 'You searched for &ldquo;x&rdquo;'
    //'subtitle' => 'You searched for &ldquo;' . x . '&rdquo;'
    'subtitle' => 'You searched for &ldquo;' . esc_html(get_search_query(false))  . '&rdquo;'
  );
pageBanner($args);
?>
<!-- 934-traditionalSearch.php-->
<!--
  replaced following with pageBanner function. blog main does not have title and subtitle in database.
 <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Welcome to our blog</h1>
      <div class="page-banner__intro">
        <p>Keep up with our latest news..</p>
      </div>
    </div>
  </div>
-->

  <div class="container container--narrow page-section">
    <?php
        if (have_posts()) {
              while(have_posts()){
                the_post();
                get_template_part('template-parts/content', get_post_type() );
        //move the following contents in to the content-post.php files.
                ?>

      <!--
                    <div class="post-item">
                      <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                        <div class="metabox">
                          <p>Posted by <?php the_author_posts_link();?> on <?php the_time('n.j.y');?> in <?php  echo get_the_category_list(', ') ; ?> </p>
                        </div>
                        <div class="generic-content">
                            <?php the_excerpt(); ?>
                            <p><a class ="btn btn--blue" href="<?php the_permalink( );?>">Continue reading &raquo;</a></p>
                        </div>

                    </div>
      -->
              <?php }
              echo paginate_links();
        }else
        {
            echo '<h2 class="headline headline--small-plus">No results match that result.</h2>';
        }
      get_search_form(); // it will look into file searchform.php by default. it is wordpress function
    ?>
  </div>
<?php get_footer();

?>
FileName: search.php
