File: page-my-notes.php
copy the contents of page.php into this file.

if (!is_user_logged_in()){
  wp_redirect(esc_url(site_url('/')));
  exit;
}

in header.php
<a href="<?php echo esc_url(site_url('/my-notes')); ?>">


create notes post type in mulogin.
    create_notes_post_type();


add a javascript file /js/modules/MyNotes.js

              <!--
                    Use the <i> element only when there is not a more appropriate semantic element, such as:
                    <em> (emphasized text)
                    <strong> (important text)
                    <mark> (marked/highlighted text)
                    <cite> (the title of a work)
                    <dfn> (a definition term)
               -->


create a variable in /js/scripts.js


our restapi url =
http://amazingcollege.test/wp-json/wp/V2/note
http://amazingcollege.test/wp-json/wp/V2/note/103 //for noteid =103
      => browser sends get request. (others: get/post/delete)
      get => retrieve ,  / $.getJSON()
      post =>send

$.ajax() // for update and delete.

$.ajax({
  url: x,
  type: 'DELETE',
  success: xFunction(),
  error: yFunction()
});














if we need some value of wordpress in javascript, we create variable universitydata in functions.php and put the value there.
Ctrl + D for parallel editing.
