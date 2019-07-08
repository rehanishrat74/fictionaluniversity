<?php


js/modules/Search.js
      getResults()-> this.callCustomRestApiForSearch();
/inc/search-route.php
    function universitySearchResults($data){}




to optimize search overlay,

  we move search overlay from footer.php to js/modules/search.js in addSearchHTML() to get use in jquery.

we will call addSearchHTML in the js constructor at the beging so the lower elements get become available



anonymous function calls.
------------------------------------
method1:
setTimeout(this.testfunction.bind(this),301);  //not working
testfunction(){
    this.searchField.focus();
  }


method2:
setTimeout(()=>this.searchField.focus(),301);  //not working


method3: call different statements with anonymous functions.
setTimeout(()=>{this.searchField.focus();alert('hello');},301);


method4:
setTimeout(post=>{this.searchField.focus() ;},301); //valid. here post is correcting the point of this pointer. we can use anyvariable instead of post.

Note:
---------------------
note 1:

setTimeout(function(){alert('hello') ;},301);  //right syntax of anynomous function but cannot point this pointer to right object.

//so we will correct this pointer as
setTimeout(post=>{this.searchField.focus() ;},301); //valid. here post is correcting the point of this
[
setTimeout(function(){this.searchField.focus() ;},301);
//invalid as this pointer will not point to right object.

//so we will use
setTimeout(post=>{this.searchField.focus() ;},301); //valid. here post is correcting the point of this
]

-------------------------------------
pls note the methods created in Search.js cannot be called in nested funtions.
we can call functions via custructor / events-mapping / setTimeout-mapping / using this pointer.












?>
