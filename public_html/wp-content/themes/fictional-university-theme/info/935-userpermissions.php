Page: Functions.php
Creating a user:
wp-admin-> Users ->Add new
Roles
    Subscriber: can only manage its own profile e.g. name
    Contributor: can create post/page but cannot publish the
                  contents.
    Author:     can publish the contents. cannot change
                someone else contents.
    Editor:     can edit/delete any post or pages from anyone.
    Administrator:

in chrome ->new ignito window. // a pvt window. and we can login as a seperate user rather than logout.

To restrict an editor to access a particular type of post, we need to create a new "event planner". and we can do it with the plugin Members by Justin Tadlock.
https://downloads.wordpress.org/plugin/members.2.1.0.zip


by default, the custom post types cant be editted. To edit,
go to muplugin-file -> create_event_post_type() / create_campus_post_type()  and set
  'capability_type' =>'event',
  'map_meta_cap' => true,

now we can see right options for post type = event in users -> add new role.
assaign all values.
and now can assign different and multiple roles to different users.
dont forget to assign roles to administrators, otherwise left tree won't get populated.
------------------------------------------------------------

Settings -> anyone can register for membership.
          -> new user default role = subscriber.

localhost:3000/wp-login.php?action=register

in header.php.
        <div class="site-header__util">
          <?php if (is_user_logged_in() ){?>
              <a href="<?php echo wp_logout_url() ;?>" class="btn btn--small  btn--dark-orange float-left btn--with-photo" >
                <span class="site-header__avatar"><?php echo get_avatar( get_current_user_id(), 60 ); ?></span>
                <span class = "btn__text" >Log out </span>
              </a>
          <?php } else { ?>
              <a href="#" class="btn btn--small btn--orange float-left push-right">Login</a>
              <a href="<?php echo esc_url(site_url('/wp-signup.php'));?>" class="btn btn--small  btn--dark-orange float-left">Sign Up</a>
          <?php } ?>

          <!-- a search icon for desktop -->
          <!-- //replace span with a for traditional search.
          <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span> -->
          <a href="<?php echo esc_url(site_url('/search')); ?>" class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>

        </div>
-------------------------------------------------------------
in functions.php add redirect logic and restricting access to admin.
redirectSubsToFrontend();

hiding bar.
noSubsAdminBar();

for signup
echo esc_url(site_url('/wp-signup.php')) == wp_registration_url();



