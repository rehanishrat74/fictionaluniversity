
Files:
js/modules/Search.js
      getResults()-> this.callCustomRestApiForSearch();
/inc/search-route.php
    function universitySearchResults($data){}


<?php


ternary operator is used to write conditional logic withing template literal.
systax: ${condition ? action() if true here : action ()if false here}


// consider following example1.

          this.resultsDiv.html(`
            <h2 class ="search-overlay__section-title" >General Information</h2>
            <ul class="link-list min-list">
                ${posts.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
            </ul>`);

// objective:  in templat literal, if there are post items then show within <ul></ul> other wise display no record found.
-----------------------------
step-1:
      implementing <ul> logic
initial:
         <ul class="link-list min-list">
replacement:
          // ${condition? yes : no}
          ${posts.length? '<ul class="link-list min-list">' : '<p>No general information found in this search.</p>'}

step-2:
      implementing </ul> login_body_class
initial:
      </ul>
replacement:
        ${posts.length ? '</ul>' : ''}

so above example1 becomes:
          this.resultsDiv.html(`
            <h2 class ="search-overlay__section-title" >General Information</h2>
                ${posts.length? '<ul class="link-list min-list">' : '<p>No general information found in this search.</p>'}
                ${posts.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
                ${posts.length ? '</ul>' : ''}
              `);
--------------------------------
making url relative:

in functions.php.university_files, at the bottom of function, add

//for optimizing javascript. and making the first part of json url flexible instead of using localhost:3000/....
pattern:  wp_localize_script( $handle, $object_name, $l10n );
wp_localize_script( 'main-university-js', 'universityData', array(
  'root_url' => get_site_url()
) );

//in js/modules/Search.js
$.getJSON('http://localhost:3000/wp-json/wp/v2/posts?search=' + this.searchField.val() ,posts =>{}
will become
$.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val() ,posts =>{}


        /* we declared a varialble universityData for javascript '/js/scripts-bundled.js' with a property of website url. we will use it in js/modules/Search.js.getResults();
        we can see this object property in view source of the page in a browser also.
        */

?>
