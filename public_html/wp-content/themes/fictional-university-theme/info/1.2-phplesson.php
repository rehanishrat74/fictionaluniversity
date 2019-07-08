<?php
<h1> <?php   bloginfo('name'); ?> </h1>
<p><?php bloginfo('description'); ?></p>

Arrays:
$names = array('Brad','John');
$count =0;
while ($count <count($names) ) {
   # code..
  echo "<li> $names[$count] </li>";
  $count++;
}

$animalSounds = array('cat'=>'meow,'dog'=>'bark');  //associative array is key value pair.
echo $animalSounds['dog'];


to write [you'll] write html as [you&rsquo;ll ]

<meta name="viewport" content="width=device-width,initial-scale=1">
<html <?php language_attributes();?> >
<head>.<meta charset="<?php bloginfo('charset'); ?>">
<body <?php body_class(); ?>>

//the sign of >> is &raquo;

CSS
-----------
//to display banner.
<div class="page-banner">

//to display contents in the centre.
<div class="container container--narrow page-section">


//for border and space between each post.
<div class="post-item"></div>

//for title with hover effect
class = headline headline--medium headline--post-title

//class converts hyperlink into a blue button
class ="btn btn--blue"


//to look nice author names and dates
class "metabox" //with yellow background
//meta box for breadcumb
<div class="metabox metabox--position-up metabox--with-home-link">

//to display contents below the title image.
class generic-content

//generate home button
<i class="fa fa-home" aria-hidden="true"></i>

//padding
div { padding: 25px 50px 75px 100px; }
top padding is 25px
right padding is 50px
bottom padding is 75px
left padding is 100px


// to glow selected menu item in header.php , class="current-menu-item"
 <li <?php  if(get_post_type()=='post') echo 'class="current-menu-item"' ?> ><a href="<?php echo site_url('/blog');?>">Blog</a></li>
?>
