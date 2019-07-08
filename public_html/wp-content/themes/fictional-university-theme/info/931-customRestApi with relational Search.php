js/modules/Search.js
      getResults()-> this.callCustomRestApiForSearch();
/inc/search-route.php
    function universitySearchResults($data){

mu-plugins/university-post-types.php

single-program.php

uses the_field('main_body_content'); in single-program.php


in search-route.php
-----------------------------
<?php
      //finding relationship between professoer [<-----] program

    if ($results['programs']) {
      //in url, if type a gebrish data, meta query will give null results and will load all perfessors. so if statement is necessary.


    /*      $programRelationshipQuery = new WP_Query(array(
            'post_type' => array('Professor'),
            'meta_query' => array(
              'relation' => 'OR',
              array(
              'key' =>'related_programs',
              'compare' => 'LIKE',
              'value' => $results['programs'][0]['id'] //'56'  id of biology
                  ),
              array(
              'key' =>'related_programs',
              'compare' => 'LIKE',
              'value' => $results['programs'][1]['id'] //'56'  id of biology
                  ),
              array(
              'key' =>'related_programs',
              'compare' => 'LIKE',
              'value' => $results['programs'][2]['id'] //'56'  id of biology
                  )
               )
          ));
          // Transforming this query for having multiple programs as------------------------
    */

          $programsMetaQuery= array('relation'=>'OR');
          foreach ($results['programs'] as $item){
              array_push($programsMetaQuery,array(
              'key' =>'related_programs',
              'compare' => 'LIKE',
              'value' => '"' . $item['id'] . '"'
              ));
          }
/* resolving a flaw.
    if in programs content of biology at admin, soneone type maths somewhere, it will load math professors as well. so we will replace the content editor for programs in mu plugin.university-post-types.php and  create a new custom field main-body-content type via  wysiwyg editor, in admin for programs. also will do changes in single program.php

*/
          $programRelationshipQuery = new WP_Query(array(
            'post_type' => array('Professor'),
            'meta_query' => array($programsMetaQuery)
          ));

          while ($programRelationshipQuery->have_posts()){
              $programRelationshipQuery->the_post();
                 if (get_post_type()=='professor'){
                        $Properties = array(
                                      'title'=>get_the_title(),
                                      'permalink'=> get_the_permalink(),
                                      //'image'=> get_the_post_thumbnail( 0, 'professorLandscape')/ we dont need object
                                      'image'=> get_the_post_thumbnail_url( 0, 'professorLandscape')
                                      //url of professor image. 0 means current post.
                        );
                        array_push($results['professors'], $Properties);
                }
          }
          //to avoid  multiple professors.
          $results['professors']= array_values(array_unique($results['professors'],SORT_REGULAR));


    } // end of if programs.
?>
