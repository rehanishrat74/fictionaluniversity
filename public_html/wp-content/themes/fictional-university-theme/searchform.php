<!--  HelpFile: 934-traditionalSearch.php
Related files : filename:page-search.php and search.php
this page will be called from search.php and page-search.php
-->

    <div class="generic-content">
      <?php //the_content();?>
      <form class="search-form" method ="get" action="<?php echo esc_url(site_url('/')); ?>">
        <!-- using get so words can be attached with url.-->
        <label class="headline headline--medium" for="s" >Perform a New Search:</label>
          <div class="search-form-row">
            <input placeholder="What are you looking for?" class="s" id="s" type="search" name="s" >
            <input class="search-submit" type="submit" value="Search">
          </div>
      </form>
      FileName: searchform.php
    </div>
