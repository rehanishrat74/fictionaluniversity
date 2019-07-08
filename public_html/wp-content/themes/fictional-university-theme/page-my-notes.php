<?php
//echo esc_url(site_url('/'));
if (!is_user_logged_in()){
  wp_redirect(esc_url(site_url('/')));
  exit;
}

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


  <div class="container container--narrow page-section">

      <div class = "create-note">
          <h2 class="headline headline--medium">Create New Note</h2>
          <input class="new-note-title" placeholder="Title">
          <textarea class = "new-note-body" placeholder="Your note here..."></textarea>
          <span class="submit-note" >Create Note</span>
          <span class="note-limit-message">Note limit reached: delete an existing note to make room for a new one.</span>
              <!-- by default note-limit-message will be hidden.-->
      </div>

    <ul class="min-list link-list" id="my-notes">
      <?php
        $userNotes = new WP_Query(array(
          'post_type' =>'note',
          'posts_per_page' => -1,
          'author' => get_current_user_id()
        ));

        while ($userNotes->have_posts()){
            $userNotes->the_post();?>
            <li data-id ="<?php the_ID();?>">
              <!-- removing (Private :) prefix from get_the_title();-->
              <input readonly class="note-title-field"  value="<?php echo  str_replace(
              'Private:','',esc_attr(get_the_title())); ?>">
              <!--
                    Use the <i> element only when there is not a more appropriate semantic element, such as:
                    <em> (emphasized text)
                    <strong> (important text)
                    <mark> (marked/highlighted text)
                    <cite> (the title of a work)
                    <dfn> (a definition term)
               -->
              <span class="edit-note" ><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span>
              <span class="delete-note" ><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span>

              <textarea readonly class="note-body-field" ><?php echo esc_textarea(get_the_content()); ?></textarea>

              <span class="update-note btn btn--blue btn--small" ><i class="fa fa-arrow-right" aria-hidden="true"></i>Save</span>

            </li>
        <?php }


      ?>
    </ul>

  </div>



<?php }

get_footer();
?>

Filename: page-my-notes.php for all pages.
