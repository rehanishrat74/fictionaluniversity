<?php
/*
js/modules/Search.js
      getResults()-> this.callCustomRestApiForSearch();
/inc/search-route.php
    function universitySearchResults($data){

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


  $query =array(
    //'post_type'=>'Professor',
    'post_type'=>array('post','page','Professor'),



    //'s'=>'barksalot'     //'s for search
    //'s'=>$data['term']     //'reading querystring parameter
    's'=>sanitize_text_field($data['term'])     // preventing from malicious script.
  );

  $professorResults = array(); // an empty array
  $professors = new WP_Query($query);


      while ($professors->have_posts()){
        $professors->the_post();
        $professorProperties = array(
                      'title'=>get_the_title(),
                      'permalink'=> get_the_permalink()
        );
        array_push($professorResults, $professorProperties);
      }


   //arra_push, pushes contents =hellow in array $professorResults.
  return $professorResults;
}


?>
