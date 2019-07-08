Challenge1.
Make slide show dynamic.

option 1:
Each slide is a post.
  Slide Backgroud Image
  Slide Heading
  Slide Subtitle.
  Slide Button Caption.

option 2:
in pages e.g front page, with custom fields.
  we can have 5 slides area
  for dynamic: use ACF Pro. it is paid component.
  important feature:
    it uses repeater to add subtitle and page banner background as a new row.
    contents editor.
    Add content. two column layout.
    Image . Three column layout.
    Gallery. Slide show.
    Quote. Datatable.
    Downloads: Featured professors.



Solution:
Files: front-page.php  // hide the slider.html and control it with template-parts/content-slider.php
        content-slider.php  //calls dynamicSlider from functions.php
        muplugin function.  // created post types slideLayers and sliders.


-------------------------------
// replacing some content in the words as ****
in /plugins/my-first-amazing-plugin.php

add_filter( 'the_content','amazingContentEdits'); //hook to a wp function.
function amazingContentEdits($content) {
}


//Usage: Wrote in about us page : We offer a total of [programCount] programs in our campuses.

in /plugins/my-first-amazing-plugin.php
add_shortcode( 'programCount', 'getProgramCount' );
function getProgramCount($attribs=NULL){
  $counts = wp_count_posts( 'program');
  return $counts->publish;
}


