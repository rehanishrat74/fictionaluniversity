<?php
metabox div = breadcomb div.
replace Our History with the_title.  <span class="metabox__main">Our History</span></p>
Breadcumb should appear in child pages only.

put breadcumb/metabox under the condition of child page.
$theParent = wp_get_post_parent_id(get_the_ID());
if  ($theParent){?>

put the parent link in metabox__blog-home-link = echo get_permalink($theParent)
put the title of the parent echo get_the_title($theParent)

set parent of cookiepolicy to privacy policy in wordpress admin.
?>
