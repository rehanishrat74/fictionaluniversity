<?php
get_header();

while (have_posts() ) {
the_post(); ?>

<?php
$args=array(
  //'title' => 'hello! there is the title',
  //'subtitle' => 'this is subtitle',
  'photo' => 'https://images.unsplash.com/photo-1493246507139-91e8fad9978e?dpr=1&auto=format&fit=crop&w=1500&h=1000&q=80'

);
//'https://images.unsplash.com/photo-1493246507139-91e8fad9978e?dpr=1&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop='

pageBanner($args);?>
<!--  <div class="page-banner">
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
      <!-----Display--Breadcumb area- if the page is child page---------------->
    <?php
        $theParent = wp_get_post_parent_id(get_the_ID());
        if  ($theParent){?>
          <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent);?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent);?></a> <span class="metabox__main"><?php the_title();?></span></p>
          </div>
        <?php }
    ?>

    <!-------------Links Menues pointing to child pages .------------------->
    <?php
    $testArray = get_pages(array(
        'child_of' => get_the_ID()
    ));
    //echo print_r($testArray);

    if($theParent or $testArray) {
    //this if is for the case if we have a page which is not parent nor child, hide the comple menue along with page-links__title shown in blue color. Without the above if condition, the menue blue box will appear which will seems ugly.

     ?>

    <div class="page-links">
      <?php echo 'creating menue in page.php<br>'?>
      <h2 class="page-links__title"><a href="<?php echo get_the_permalink($theParent);?>"><?php echo get_the_title($theParent);?></a></h2>
      <ul class="min-list">
        <?php
          // $parent=0 means the current page is the parent page.
          if ($theParent){
              $findChildrenOf = $theParent; //if it is parent page, this line will not execute
          } else {
              $findChildrenOf=get_the_ID();  // if it is a child then find its parent.
          }

          wp_list_pages(array(
              'title_li' => NULL,
              'child_of' => $findChildrenOf,
              'sort_column' => 'menu_order'
            ));
        ?>
      </ul>
    </div>
    <?php }?>
<!-------------End of Links Menues pointing to child pages .------------------->

    <div class="generic-content">
      <?php the_content();
        echo 'registered query variable usage: http://localhost:3000/about-us/?skyColor=blue&grassColor=green';
          $skyColorValue=sanitize_text_field(get_query_var('skyColor')); // to prevent injections.
          $grassColorValue=sanitize_text_field(get_query_var('grassColor'));

        if($skyColorValue=='blue' AND $grassColor=='green') {
          echo '<p>The sky is blue today. Life is green</p>';
          //usage: http://localhost:3000/about-us/?skyColor=blue&grassColor=green
        }
      ?>
        <form method="get">
            <input name="skyColor" placeholder="Sky Color">
            <input name = "grassColor" placeholder="Grass Color">
            <button>Submit</button>
        </form>

    </div>

  </div>


<?php }

get_footer();
?>

Filename: page.php for all pages.
