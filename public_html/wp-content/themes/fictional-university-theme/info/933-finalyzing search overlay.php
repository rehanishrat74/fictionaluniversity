
Relationship:
                    Events
                       .
                       .
                       v
                       .
                     .      .
                   .  programs  .
 Professor   >   .                .      > Campuses
                   .            .
                      .     .
                        .

/*------------------------------------------*/
i.e
    Events => Programs
    Professor => Programs
                  programs  => Campuses


Steps:
1. design search overlay in footer.php.
2. design jquery in /js/modules/Search.js
    2.b moved search overlay in Search.js
    2.c created Event listners -> Search.js -> events()
3. register CusomRestAPI in /inc/search-route.php->universityRegisterSearch
       http://amazingcollege.test/wp-json/university/v1/search?term=math
4. Generate output for restApi in /inc/search-route.php -> universitySearchResults($data)
5.Display search overlay results in /js/Search.js => getResults ()


Steps for:
    4. Generate output for restApi in /inc/search-route.php -> universitySearchResults($data) :
        4.a. generated arrays from post types 'post','page','Professor','program','campus','event'
        4.b. Generated relationship search for programs
              4.b.1. with Events and Professors.
              4.b.2.  with campuses as the relationship is opposite to 4.b.1.

Note: Help files 925-livesearch.php [to] 933-finalyzing search overlay.php


