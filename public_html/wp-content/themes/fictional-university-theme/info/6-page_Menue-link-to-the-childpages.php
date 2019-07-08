<? php
div class="page-links">  in page.php
wp_list_pages();  // list all the pages
title_li => NULL // hide first list item with caption as Pages
sort_column => 'menu_order
// will look the sort criteria in wordperss admin. In the absence of sort_column, alphabatical sorting will work.

if we are on parent page we can use as
child_of=>get_the_ID()
but if we are on the child page, we cannot.

Replace follwoing menu with
    <div class="page-links">
      <?php echo 'creating menue in page.php<br>'?>
          <h2 class="page-links__title"><a href="#">About Us</a></h2>
          <ul class="min-list">
              <li class="current_page_item"><a href="#">Our History</a></li>
              <li><a href="#">Our Goals</a></li>
          </ul>
<dynamic code>



get_pages() = wp_list_pages() in the sense that get_pages return pages in memory while wp_list_pages display menu

?>
