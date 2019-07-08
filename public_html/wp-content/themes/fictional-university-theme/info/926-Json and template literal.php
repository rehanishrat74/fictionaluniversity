
js/modules/Search.js
      getResults()-> this.callCustomRestApiForSearch();
/inc/search-route.php
    function universitySearchResults($data){}



<?php
wordpress Rest API. we can coomunicate with it e.g with android application using objective C.
RestAPI supports CRUD against posts.
C reate
R ead  (Load data)
U pdate
D elete

https://developer.wordpress.org/rest-api/

http://localhost:3000/wp-json/wp/v2/posts
//raw data for 10 recent blog posts on a website.

http://localhost:3000/wp-json/wp/v2/posts?per_page=2
// this will show two posts.

http://localhost:3000/wp-json/wp/v2/posts/7
//raw data of specific post

http://localhost:3000/wp-json/wp/v2/posts?search=award
// search award

http://localhost:3000/wp-json/wp/v2/pages
//raw data for 10 recent pages on a website.

J Java
S Script
O Object
N Notation

An array = [a,b,c,d]
An array of objects = [{},{},{},{}] e.g.
    [
      { id: 7,
        title: "About Us",
        date: "10/20/2017"
      },
      { id: 4,
        title: "Privace Policy",
        date: "10/15/2017"
      },
      {},
      {}
    ]

With postman we can see the structured format of raw json.

we can use javascript to query json and represent data as we needed.

// to query json in search.js
    getResults(){
        /*this.resultsDiv.html("Amazing real search here.");
        this.isSpinnerVisible=false;*/
       $.getJSON('http://localhost:3000/wp-json/wp/v2/posts?search=' + this.searchField.val() ,function(posts){
          //posts is simpley a variable. it can be anything.
          alert(posts[0].title.rendered);
          /*
              here this pointer will point to $.json. to point [this]to search field we have two options.
              option 1.
                    $.getJSON('http://localhost:3000/wp-json/wp/v2/posts?search=' + this.searchField.val() ,function(posts){},bind(this))
              option 2.
                    ES6 Arrow function.
                    To acheive arrow function we will replace function(posts) with posts => as
                    $.getJSON('http://localhost:3000/wp-json/wp/v2/posts?search=' + this.searchField.val() ,posts=>{})
                    this way, the value of 'this' keyword wont change.
          */

           template literal = `` . it helps us to write html in different lines. it is the key before 1 button over keyboard.
       })
    }

-----------------------------------------------------------
looping within a template literal in getResults() in search.js.
          //${}. this combination tells javascript that we are going to use java code instead of pure text.
          //${}. this combination is not a jquery.

//$.getJSON takes two parameters (url,[anonymous arrow function] or any function name)
//here posts variable is passed to an anonymous arrow function.
        $.getJSON('http://localhost:3000/wp-json/wp/v2/posts?search=' + this.searchField.val() ,posts =>{


          this.resultsDiv.html(`
            <h2 class ="search-overlay__section-title" >General Information</h2>
            <ul class="link-list min-list">
                <li><a href="${posts[0].link}">${posts[0].title.rendered}</a></li>
            </ul>`);
          //${}. this combination tells javascript that we are going to use java code instead of pure text.
          //${}. this combination is not a jquery.

       })

          ---------------<li><a href="${posts[0].link}">${posts[0].title.rendered}</a></li> ----------------------------
                          [lets make the
                                ${posts[0].title.rendered
                                        line dynamic ] -----------

          Example: consider var testArray instead of posts

          var testArray=['red','orange','yellow'];
          this.resultsDiv.html(`
            <h2 class ="search-overlay__section-title" >General Information</h2>
            <ul class="link-list min-list">
                ${testArray.map()}
            </ul>`);

//map() points to a annonymous arrow function which takes a parameter =item
//we use arrow anonymous function as
              ${testArray.map(item=>`          here item is a parameter to a function
                    <li>${item}</li>            it will print red,orange,yellow
                `
              )}

//in javascript join() can be used to convert an array into a simple string.
              ${
                testArray.map(item=>`
                    <li>${item}</li>                  `
                  ).join('')
                /*if we use join(x), the contents in array with merged together as redxorangexyellow. so we                           used blank space to bypass character x or , with blank space. */
              }

the above example was for understanding.
// now replace testArray with posts variable in search.js.

              ${
                testArray.map(item=>`
                    <li>${item}</li> `
                  ).join('')
              }
              ----------step 2

              ${
                testArray.map(item=>`<li>${item}</li>`).join('')
              }
              ---------step 3
              ${testArray.map(item=>`<li>${item}</li>`).join('')}
              ----------step 4-- replace testArray with valid parameter posts.
              ${posts.map(item=>`<li>${item}</li>`).join('')}
              /*if there is no data in posts variable, then map fuction will not work. so we dont need if n elseif conditions.*/

?>





