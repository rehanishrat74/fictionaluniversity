Files: single-program_relationship2with_professors.php
Files: functions.php
Files: mu-plugins
Files: single-program.php

<?php
add_theme_support('post-thumbnails');  in functions.php //enable thumbnails features in admin
//creating two additional custom sizes for images in upload folder. total images = 5+2 = 7
  add_image_size('professorLandscape',400,260,true); //format Name,width,height,crop allowed
  add_image_size('professorPortrait',480,650,true); //format Name,width,height,crop allowed
  add_image_size('pageBanner',1500,350,true);
    //the crop position is centre by default. we can crop by specifying the position also.
//  add_image_size('professorLandscape',400,260,array('left','top'));

// to regerate old images, we have pougin

add thumbnail in create_professor_post_type() at mu-plugin folder file.
set featured images in wpadmin against professors.

option1: in single-professor.php
<div class="generic-content">
      <?php the_post_thumbnail(); the_content();?>
  </div>

?>
option2:
A two column layout.
  <div class="generic-content">
      <div class="row group">
          <div class="one-third"></div>
          <div class="two-thirds"></div>
      </div>
  </div>

-------------------
in single-program.php->relationship2with_professors.php
<li class="professor-card__list-item"> // remove bullets and put name in a row
<a class="professor-card href=""> // class gives backgroud color.



image overlay and rotate angle css.
------------------------------------
<ul class="professor-cards">
      <li class="professor-card__list-item">
          <a class="professor-card" href="<?php the_permalink();?>">
                <img class="professor-card__image" src="<?php the_post_thumbnail_url();?>">
                <span class="professor-card__name"><?php the_title();?></span>
          </a>
      </li>
</ul>
span tag is used with inline elements whilst the div tag is used with block-level content.
-----------------------------
go to tools and regenerate thumbnails for all previous images.
to regenerate plugins, we have
https://downloads.wordpress.org/plugin/regenerate-thumbnails.zip

to manual crop , download
https://downloads.wordpress.org/plugin/manual-image-crop.1.12.zip
we can access the feature from admin.professor.featured image->crop featured image.

create custom fields for page banner and subtitle. Group name is Page Banner.
page_banner_subtitle and page_banner_background_image
Location is
//to cover every page over the site.
post type equals to post
post type not equals to post

update subtitle over single-professor.php

<?php

      option 1:
      $pageBannerImage=get_theme_file_uri('/images/ocean.jpg');
       usage: echo $pageBannerImage;
          <div class="page-banner__bg-image" style="background-image: url(<?php echo  $pageBannerImage ?>);"></div>

      option 2:
      $pageBannerImage=get_field('page_banner_background_image');
          <div class="page-banner__bg-image" style="background-image: url(<?php echo  $pageBannerImage['url']; ?>);"></div>
      option 3:
          <div class="page-banner__bg-image" style="background-image: url(<?php echo  $pageBannerImage['sizes']['pageBanner']; ?>);"></div>

// to investigate variable use
          print_r($pageBannerImage);
?>
