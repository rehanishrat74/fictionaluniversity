<!--  HelpFile: 934-traditionalSearch.php
Related files: filename:page-search.php and search.php
-->
<!--
    copy the <li> html from FileName: 'single-program_relationship2with_professors.php' into this file.
934-traditionalSearch.php
 -->
<div class="post-item">
    <li class="professor-card__list-item">
        <a class="professor-card" href="<?php the_permalink();?>">
            <?php //the_title(); //print name of professor?>
             <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape');?>">
             <span class="professor-card__name"><?php the_title();?></span>
        </a>
    </li>
FileName: template-parts/content-profressor.php
</div>

