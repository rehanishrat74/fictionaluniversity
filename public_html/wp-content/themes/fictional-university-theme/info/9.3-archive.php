<?php
archive.php triggers when view posts by author,date or category.
in the abscense of archive.php, index.php will serve the functionaliy.

copy all contents of index.php into archive.php.

To set title of archive with if statements, see archiveTitleByType.php.
To let wordpress set the title of archive, see archive.php
the_archive_description()

Biography for archives obtained from admin.users.profile.biographical info
and
Category description from Posts->Categories->Edit Category
and set description.
we can view the descrition as the_archive_description();

the_archive_title(); // for archive by date/category.

Steps to create a blog
----------------------
1. index.php
2. single.php
3. archive.php // for custom description, see archiveTitleByType.php



if (is_category()) { single_cat_title();}
if (is_author()){ echo 'Posts by '; the_author();}
echo paginate_links();

Posted by the_author_posts_link() on the_time('n.j.y') in echo get_the_category_list(', ');
?>

