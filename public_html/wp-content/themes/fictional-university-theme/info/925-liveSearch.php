
js/modules/Search.js
      getResults()-> this.callCustomRestApiForSearch();
/inc/search-route.php
    function universitySearchResults($data){}


Note: traditional search = http://localhost:3000/?s=biology. filename:page-search.php.
<?php
//jquery is used to handle html elements and css objects on run time.


Create a js file in /js/modules/Search.js
in scripts.js import the file in a variable

in footer.php create a div class=search-overlay.



in functions.php the dependent =NULL
        wp_enqueue_script( 'main-university-js',get_theme_file_uri('/js/scripts-bundled.js'),NULL,microtime(),true);
        //replace version with microtime to avaoid caching.
if the javascript is dependent on jquery you can replace NULL as array('jquery') above.

  . for class ,   # for id

/* learning jquery*/
//---------------------------------------------------------------------

Basic steps:
step1:
  //in Search.js
  import $ from 'jquery';

step2:
  //Create class and in constructor create properties.
      this.openButton=$(".js-search-trigger"); //exists in header.php

      /*closeButton: A handle to a  virtual close button created. against icon specified in footer.php for icon fa-window-close*/
      this.closeButton =$(".search-overlay__close");

      /*searchField: # is the id of search text box in footer.php */
      this.searchField=$("#search-term");

      /*searchOverlay: A handle to a main overlay search div in footer.php */
      this.searchOverlay=$(".search-overlay");

      //jquery means we are using DOM which is slow. to increase the response time, lets create a variable.
      //DOM means Document model
      this.isOverlayOpen = false; //overlay state
      this.isSpinnerVisible = false; // spinner state

      this.typingTimer;

      this.resultsDiv=$("#search-overlay__results"); //div exists in footer.php
      this.previousValue;

step3:
    //Create Events

    /*binding handle to search icon in header.php with the delegate openOverlay*/
    this.openButton.on("click",this.openOverlay.bind(this)); //button from header.php

    /*binding handle to fa-window-close icon in footer.php with the delegate closeOverlay*/
    this.closeButton.on("click",this.closeOverlay.bind(this));
    $(document).on("keydown",this.keyPressDispatcher.bind(this));  // keyevent on this browser window.
    //keyup fires only once while keydown fires in miliseconds

    //this.searchField.on("keyup",this.typingLogic); // this.typingLogic linked with textbox and not object of this class.
    this.searchField.on("keyup",this.typingLogic.bind(this)); //search field from footer.php
    //keydown is so rapid that does not give chance to update the previousValue property. so using keyup


step4:
    //Create methods for events.
    openOverlay,closeOverlay,keyPressDispatcher,typingLogic

//------------------------------------------------------------------------------

openOverlay:
        this.searchOverlay.addClass("search-overlay--active"); // add css class in footer.php to display the search div.
        $("body").addClass("body-no-scroll"); //hide scroll bar

closeOverlay:
        this.searchOverlay.removeClass("search-overlay--active"); // remove css class in footer.php from search div to hide.
        $("body").removeClass("body-no-scroll");  // browser scroll will disapper in overlay

keyPressDispatcher:
        decides when to open and close search div.
        With [s] div open. With [esc] the div closes.

        keyPressDispatcher is attached to browser window, so will listen to every page.
        we need to disable its listening if any text box and textarea is in focus, otherwise search div will
        open while typing which is a meaning less action.
        //to do that we will use the condition in jquery as
        !$("input,textarea").is(':focus')

typingLogic:

        MainLogic:
        //get called when someone starts typing in the search text box.
        clearTimeout(this.typingTimer); // clear the previously set timer.
        this.resultsDiv.html('<div class="spinner-loader"></div>'); // it will display the spinner using css class

        //keep typing. to query the getResults function will get called after every two seconds.
        this.typingTimer=setTimeout(this.getResults.bind(this),2000);


        Conditions:
            if (this.searchField.val() != this.previousValue){} // skipping arrow/control keys if typed in search text box.
                if (this.searchField.val()){} // only call getResults to query if there is data in the search text box.
                    if there is no data then clear the search div area as
                          this.resultsDiv.html('');

getResults:
        will display the search result.
?>
