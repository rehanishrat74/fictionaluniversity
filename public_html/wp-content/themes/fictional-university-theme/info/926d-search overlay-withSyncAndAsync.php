<?php


js/modules/Search.js
      getResults()-> this.callCustomRestApiForSearch();
/inc/search-route.php
    function universitySearchResults($data){}



js/modulules/Search.js.getResults()

option1:
      callRestApiToSearchPostsOnly();


option2: combine search for posts and pages via synchronous call
      this.callSynchronousRestApiToSearchPostsAndPages();


option3: combine search for posts and pages via Asynchronous/parallel  call



$.when(jquery1,jquery2).then()
$.when(jquery1,jquery2).then(function(){});
$.when(jquery1,jquery2).then((resultJquery1,resultJquery2)=>{});
//and so on.
$.when($.getJSON(url1),$.getJSON(url2)).then((resultJquery1,resultJquery2)=>{});


js/modules/Search.js.getResults().this.callAsynchronousRestApiToSearchPostsAndPages();

//calling querry with error handling.
$.when(jquery1,jquery2).then(function(){} , erorhandler);
$.when(jquery1,jquery2).then(function(){} , ()=>{});


$.getJSON(postURL,(result)=>{
          this.resultsDiv.html(``)
        }
?>
