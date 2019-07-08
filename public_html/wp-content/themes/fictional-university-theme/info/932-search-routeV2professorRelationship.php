<?php
/*
  Help Files:
  927-customizingRestApi.php, 928-creatingCustomRestAPI.php,928b-search-routeV1.php
*/
add_action('rest_api_init','universityRegisterSearch');

function universityRegisterSearch() {
  //register_rest_route( $namespace, $route, array( '' ), false );
  /*
  in http://amazingcollege.test/wp-json/wp/v2/posts
    wp is the namespace. v2 is also the part of namespace.
    posts is the route.
  */
    $namespace='university/v1';
    $route ='search';
    /*WP_REST_Server::READABLE will use in all browsers.*/
    $routeFunctions =array(
      'methods' =>WP_REST_Server::READABLE,  // or 'GET'
      'callback' =>'universitySearchResults'  // function name to receive json data.
    );

register_rest_route( $namespace, $route, $routeFunctions, false );

//usage: http://localhost:3000/wp-json/university/v1/search

}

function universitySearchResults($data){
//wordpress will automatically pass $data into this function

  $queryFilter =array(
    //'post_type'=>'Professor',
    'post_type'=>array('post','page','Professor','program','campus','event'),



    //'s'=>'barksalot'     //'s for search
    //'s'=>$data['term']     //'reading querystring parameter
    's'=>sanitize_text_field($data['term'])     // preventing from malicious script.
  );

// an empty array
  $results = array(
              'generalInfo'=>array(), //for blogpost and page
              'professors'=>array(),
              'programs'=>array(),
              'events'=>array(),
              'campuses'=>array()
            );
  $mainQuery = new WP_Query($queryFilter);


      while ($mainQuery->have_posts()){
        $mainQuery->the_post();
            if (get_post_type()=='post' OR get_post_type()=='page'){
                    $Properties = array(
                                  'postType'=> get_post_type(),
                                  'authorName'=> get_the_author(),
                                  'title'=>get_the_title(),
                                  'permalink'=> get_the_permalink()
                    );
                    array_push($results['generalInfo'], $Properties);
            }
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
            if (get_post_type()=='program'){
                    $Properties = array(
                                  'title'=>get_the_title(),
                                  'permalink'=> get_the_permalink(),
                                  'id' => get_the_ID()
                    );
                    array_push($results['programs'], $Properties);
            }
            if (get_post_type()=='event'){
                    $eventDate = new DateTime(get_field('event_date'));
                    $description = null;
                      //echo wp_trim_words( get_the_content(), 18);
                        if (has_excerpt()){
                           //the_excerpt(); //this function will put <p> which will create blank lins arout the test.
                            $description = get_the_excerpt();
                            }
                        else {$description = wp_trim_words(get_the_content(),18);}

                    $Properties = array(
                                  'title'=>get_the_title(),
                                  'permalink'=> get_the_permalink(),
                                  'month'=>  $eventDate->format('M'),
                                  'day' =>$eventDate->format('d'),
                                  'description' =>$description
                    );
                    array_push($results['events'], $Properties);
            }
            if (get_post_type()=='campus'){
                    $Properties = array(
                                  'title'=>get_the_title(),
                                  'permalink'=> get_the_permalink()
                    );
                    array_push($results['campuses'], $Properties);
            }


      }  //wnd of while statement.

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





   //array_push, pushes contents =hellow in array $professorResults.
  return $results;
}


?>
