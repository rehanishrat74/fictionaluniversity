js/modules/Search.js
      getResults()-> this.callCustomRestApiForSearch();
/inc/search-route.php
    function universitySearchResults($data){


            if (get_post_type()=='campus'){
                    $Properties = array(
                                  'title'=>get_the_title(),
                                  'permalink'=> get_the_permalink()
                    );
                    array_push($results['campuses'], $Properties);
            }



