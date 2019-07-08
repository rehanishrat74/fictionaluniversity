<?php

js/modules/Search.js
      getResults()-> this.callCustomRestApiForSearch();
/inc/search-route.php
    function universitySearchResults($data){}

// in functions.php

function university_custom_rest() {
    //added a new field =authorName in restapi.
    --------------------------------------------
  register_rest_field( 'post', 'authorName', array(
      'get_callback' => function() {return get_the_author();}
     ) );
}
add_action('rest_api_init','university_custom_rest');


//using a custom field.
---------------------------
//putting loging if post type =post, in search.js.callAsynchronousRestApiToSearchPostsAndPagesWithCustomAttributes()
${combinedSearchResults.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a> by ${item.authorName}</li>`).join('')}
${combinedSearchResults.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a>${condition ? yay : nay} </li>`).join('')}


${condition ? yay : nay}
${item.type=='post' ? `by ${item.authorName}` : ''}

/* to  custom post types make available in rest api, in mu-plugin-> create_professor_post_type */register_post_type ->'show_in_rest' =>true
usage: http://amazingcollege.test/wp-json/wp/v2/professor



?>

examples of rest api urls.
http://amazingcollege.test/wp-json/wp/v2/posts
http://amazingcollege.test/wp-json/wp/v2/media
http://amazingcollege.test/wp-json/wp/v2/users
http://amazingcollege.test/wp-json/wp/v2/professor



