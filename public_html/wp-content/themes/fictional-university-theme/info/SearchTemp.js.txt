import $ from 'jquery';
//Note: Help files 925-livesearch.php [to] 933-finalyzing search overlay.php
class Search {

  constructor() {

    //1. describe and create / initiate our object
      //e.g. as person. name,eyecolor,head(),brain()
     this.addSearchHTML(); //create search overlay div with jquery instead from footer.php.
      /*openButton: A handle to virtual search button created. .js-search-trigger is defined in header.php. associated with span to cover search icon. */
      this.openButton=$(".js-search-trigger");

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

      this.events(); //making the listners available over the html page
  }




  //2. events
      // e.gon this.head feels cold, wearsHat.
events(){
    /*binding handle to search icon in header.php with the delegate openOverlay*/
    this.openButton.on("click",this.openOverlay.bind(this));

    /*binding handle to fa-window-close icon in footer.php with the delegate closeOverlay*/
    this.closeButton.on("click",this.closeOverlay.bind(this));
    $(document).on("keydown",this.keyPressDispatcher.bind(this));  // keyevent on this browser window.
    //keyup fires only once while keydown fires in miliseconds

    //this.searchField.on("keyup",this.typingLogic); // this.typingLogic linked with textbox and not object of this class.
    this.searchField.on("keyup",this.typingLogic.bind(this));
    //keydown is so rapid that does not give chance to update the previousValue property. so using keyup
}




  //3. methods (function, action...) = verbs/action words
      // e.g wearsHat(){}
  openOverlay(){
    //applying css in footer.php in <div class="search-overlay">
    // adding the class will make the div visibile
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll"); //hide scroll bar

         //search text box get active by default.
     //this.searchField.focus(); // will not work because css is in transition for searchoverlay. we need to wait for 300 mili seconds.
    //setTimeout(()=>this.searchField.focus(),301); //valid
    setTimeout(()=>this.searchField.focus(),301);
    this.searchField.val(''); //make the searchbox empty.
    console.log("open overlay");

    this.isOverlayOpen = true;
    return false;
    /* to disable default behaviour of a element in case of traditional search and javascript enabled.
    otherwise, traditional search page=localhost/search will get open.*/
  }


  closeOverlay(){
    //applying css in footer.php in <div class="search-overlay">
    //removing the class will make the div invisible.
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    console.log("close overlay");
    this.isOverlayOpen = false;
  }
  keyPressDispatcher(e) {
    //console.log(e.keyCode); // prints the code of key pressed.
    if (e.keyCode==83 && !this.isOverlayOpen && !$("input,textarea").is(':focus') ){
      /* Explain: !$("input,textarea").is(':focus').
          with jquery we place check not to open overlay search area if any text box or text area
          is in focus in any of the pages. as keyPressDispatcher is associated with browser event and will be listening
          on all the pages in the web application.
      */

      // 83 is the s key
      this.openOverlay();
    }
    if(e.keyCode==27 && this.isOverlayOpen){
      //27 is the escape key
      this.closeOverlay();
    }
  }

  typingLogic(){
      // the if check will skip keystrokes of e.g arrow/control keys etc,
     if (this.searchField.val() != this.previousValue){

          //reset old/previous timer state if exists.
          clearTimeout(this.typingTimer);
                if (this.searchField.val()){
                  // search if and only iff , there is text in searchfield text then do query
                          //load spinner first before timer interval
                          if (!this.isSpinnerVisible){
                              this.resultsDiv.html('<div class="spinner-loader"></div>');
                              this.isSpinnerVisible=true;
                          }
                              /*note: the spinner will close in getresults method as the spinner class will be removed..
                                //this.typingTimer= setTimeout(function(){ console.log("this is timeout test"); },2000);
                                    //setTimeout(x,2000); //call function after 2 seconds.
                              // or call anonymous function as above
                              2000 => 2 seconds. / 750 = quarter of a second.
                              */
                              this.typingTimer=setTimeout(this.getResults.bind(this),750);
                              //==> a delegate for the timer, the Main method.
                } else {
                  // empty the results and reset the spinner state as it wont be visibile because of missing class spinner-loader
                  this.resultsDiv.html('');
                  this.isSpinnerVisible=false;
                }

     }

      this.previousValue=this.searchField.val(); //val is jquery method to read text field.

    }
//${combinedSearchResults.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a> by ${item.authorName}</li>`).join('')}
  getResults() {
    //method 1:
    //this.callRestApiToSearchPostsOnly();
    //this.callSynchronousRestApiToSearchPostsAndPages();
    //this.callAsynchronousRestApiToSearchPostsAndPages();
    //this.callAsynchronousRestApiToSearchPostsAndPagesWithCustomAttributes();
    this.callCustomRestApiForSearch();
    }

    callCustomRestApiForSearch(){
      //http://amazingcollege.test/wp-json/university/v1/search?term=award

      var postURL=universityData.root_url + '/wp-json/university/v1/search?term=' + this.searchField.val();
      //console.log (postURL);
      //$.getJSON(x,function(result){});
      $.getJSON(postURL,(result)=>{
        //console.log(result);
          this.resultsDiv.html(`
                  <div class="row">
                      <div class="one-third">
                        <h2 class ="search-overlay__section-title">General Information</h2>
                           ${result.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
                           ${result.generalInfo.map(item=>`<li><a href="${item.permalink}">${item.title}</a>${item.postType=='post' ? ` by ${item.authorName}` : ''} </li>`).join('')}
                           ${result.generalInfo.length ? '</ul>' : ''}
                      </div>
                      <div class="one-third">
                        <h2 class = "search-overlay__section-title">Programs</h2>
                           ${result.programs.length ? '<ul class="link-list min-list">' : `<p>No programs matches that search. <a href="${universityData.root_url}/programs"> View all programs</a></p>`}
                           ${result.programs.map(item=>`<li><a href="${item.permalink}">${item.title}</a> </li>`).join('')}
                           ${result.programs.length ? '</ul>' : ''}

                        <h2 class =  "search-overlay__section-title">Professors</h2>
                           ${result.professors.length ? '<ul class="professor-cards">' : `<p>No professors matches that search.</p>`}
                           ${result.professors.map(item=>`
                            <!-- copied from: 'single-program_relationship2with_professors.php'-->
                              <li class="professor-card__list-item">
                                  <a class="professor-card" href="${item.permalink}">
                                  <img class="professor-card__image" src="${item.image}">
                                  <span class="professor-card__name">${item.title}</span>
                                  </a>
                            </li>
                            `).join('')}
                           ${result.professors.length ? '</ul>' : ''}
                      </div>
                      <div class="one-third">
                        <h2  class = "search-overlay__section-title">Campuses</h2>
                           ${result.campuses.length ? '<ul class="link-list min-list">' : `<p>No campuses matches that search. <a href="${universityData.root_url}/campuses">View all campuses</a></p>`}
                           ${result.campuses.map(item=>`<li><a href="${item.permalink}">${item.title}</a> </li>`).join('')}
                           ${result.campuses.length ? '</ul>' : ''}

                        <h2  class = "search-overlay__section-title">Events</h2>
                           ${result.events.length ? `` : `<p>No Events matches that search. <a href="${universityData.root_url}/events">View all events</a></p>`}
                           ${result.events.map(item=>`
                                <!--  FileName: /template-parts/content-event.php -->
                                  <div class="event-summary">
                                    <a class="event-summary__date t-center" href="${item.permalink}">

                                      <span class="event-summary__month"> ${item.month}</span>
                                      <span class="event-summary__day"> ${item.day}</span>
                                    </a>
                                    <div class="event-summary__content">
                                      <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                                      ${item.description}

                                       <a href="${item.permalink}" class="nu gray">Learn more</a></p>
                                    </div>
                                  </div>
                                `).join('')}

                      </div>
                  </div>
            `);
          this.isSpinnerVisible=false;
        });



    }
    callAsynchronousRestApiToSearchPostsAndPagesWithCustomAttributes(){
        var postsUrl = universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val();
        var pagesUrl = universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val();
        var postedJsonDataForPosts;
        var postedJsonDataForPages;
        var combinedSearchResults;

      $.when($.getJSON(postsUrl),$.getJSON(pagesUrl)).then((postedJsonDataForPosts,postedJsonDataForPages)=>{
       /* if we check, we see that data is at index [0]. console.log(postedJsonDataForPosts);*/

            combinedSearchResults = postedJsonDataForPosts[0].concat(postedJsonDataForPages[0]);
            /*
                show added RestApi property authorName only if postType =post.
                ${combinedSearchResults.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a>${condition ? yay : nay} </li>`).join('')}
                ${condition ? yay : nay}
                ${item.type=='post' ? `by ${item.authorName}` : ''}
            */
            this.resultsDiv.html(`
                 <h2 class ="search-overlay__section-title" >General Information</h2>
                 ${combinedSearchResults.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
                 ${combinedSearchResults.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a>${item.type=='post' ? `by ${item.authorName}` : ''} </li>`).join('')}
                 ${combinedSearchResults.length ? '</ul>' : ''}
            `);
            this.isSpinnerVisible=false;
      }, ()=>{this.resultsDiv.html(`<p>Unexpected error; Please try again.</p>`);});

    }
  callAsynchronousRestApiToSearchPostsAndPages(){
        var postsUrl = universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val();
        var pagesUrl = universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val();
        var postedJsonDataForPosts;
        var postedJsonDataForPages;
        var combinedSearchResults;

      $.when($.getJSON(postsUrl),$.getJSON(pagesUrl)).then((postedJsonDataForPosts,postedJsonDataForPages)=>{
       /* if we check, we see that data is at index [0]. console.log(postedJsonDataForPosts);*/

            combinedSearchResults = postedJsonDataForPosts[0].concat(postedJsonDataForPages[0]);
            //console.log(combinedSearchResults);
            this.resultsDiv.html(`
                 <h2 class ="search-overlay__section-title" >General Information</h2>
                 ${combinedSearchResults.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
                 ${combinedSearchResults.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
                 ${combinedSearchResults.length ? '</ul>' : ''}
            `);
            this.isSpinnerVisible=false;
      }, ()=>{this.resultsDiv.html(`<p>Unexpected error; Please try again.</p>`);});

  }
  callSynchronousRestApiToSearchPostsAndPages(){
        //'http://localhost:3000/wp-json/wp/v2/posts?search=Biology'; tranformation
        var postsUrl = universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val();
        var pagesUrl = universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val();
        var postedJsonDataForPosts;
        var postedJsonDataForPages;
        var combinedSearchResults;

        //jquery will put the json data for posts ,in variable postedJsonData used in anonymous function.
        $.getJSON(postsUrl ,postedJsonDataForPosts =>{

              //jquery will put the json data for pages ,in variable postedJsonDataForPages used in second anonymous function .
              $.getJSON(pagesUrl , postedJsonDataForPages =>{
                 //console.log(postedJsonDataForPages);
                  //combining two search arrays.
                  combinedSearchResults = postedJsonDataForPosts.concat(postedJsonDataForPages);
                      this.resultsDiv.html(`
                        <h2 class ="search-overlay__section-title" >General Information</h2>
                         ${combinedSearchResults.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
                         ${combinedSearchResults.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
                         ${combinedSearchResults.length ? '</ul>' : ''}
                       `);

                        this.isSpinnerVisible=false;
                  } );
       });

    }

  callRestApiToSearchPostsOnly(){

       //$.getJSON('http://localhost:3000/wp-json/wp/v2/posts?search=' + this.searchField.val() ,posts =>{
        //universityData.root_url declared in functions.php.university_files
        $.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val() ,posts =>{
          //$.getJSON takes two parameters (url,[anonymous arrow function] or any function name)
          //posts is simpley a variable. it can be anything.

          /*we used posts => instead of anonymous function 'function (posts)' ,so this keyword point to valid div element. other wise will point to $.json.
          ref: 926-Json and template literal.php*/

          //alert(posts[0].title.rendered);
          this.resultsDiv.html(`
            <h2 class ="search-overlay__section-title" >General Information</h2>
                ${posts.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
                ${posts.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
                ${posts.length ? '</ul>' : ''}
            `);
          //${}. this combination tells javascript that we are going to use java code instead of pure text.
          //${}. this combination is not a jquery.

          //map() points to a annonymous arrow function which takes a parameter =item
          this.isSpinnerVisible=false; // done, so that as soon as start a new search, the spinner becomes visible again.

       });

    }
    addSearchHTML(){
      //copying search overlay div from footer.php.
      $("body").append(`
          <div class="search-overlay">
              <div class="search-overlay__top">
                  <div class="container">
                      <!-- creating icon. fa =font awesome. aria-hidden will stop screen reader to read alud-->
                      <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                      <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
                      <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
                  </div>
              </div>

              <div class="container">
                  <div id="search-overlay__results">
                      <!-- search-overlay__results handle exists in Search.js-->
                  </div>
              </div>
          </div>

        `);

    }
}
//}




//at the end of file. this will allow to import in scripts.js
export default Search;
