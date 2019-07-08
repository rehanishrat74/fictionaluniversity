import $ from 'jquery';

class Like {
  constructor(){
    //alert('just testing likejs.');
    this.events();
  }

  events(){
      $(".like-box").on("click", this.ourClickDispatcher.bind(this));
  }

  // methods........
  ourClickDispatcher(e) {
    // e.target is the current element.
      var currentLikeBox = $(e.target).closest(".like-box");
      //without closest, click on heart or number wont work as these are associated with <i> element.

      //if($(".like-box").data('exists')=='yes') {
      //if(currentLikeBox.data('exists')=='yes') { //the status is set in single-professor.php using wp_query and css property
    if(currentLikeBox.attr('data-exists')=='yes') {
        /* .data('exists') won't work in case of toggle like on and off. so need to use .attr('data-exists')
        .attr will always get fresh values.
        */
        this.deleteLike(currentLikeBox);
      } else {
        this.createLike(currentLikeBox);
      }
  }
  createLike(currentLikeBox) {
    //alert("create test message");
    //default url = universityData.root_url + '/wp-json/wp/v2/posts'
      $.ajax({
          beforeSend: (xhr)=> {
            xhr.setRequestHeader('X-WP-Nonce',universityData.nonce);
          }, //adding attributes to request for trust. nonce created in functions.php

          // target=>functions.php->like-route.php->createLike($data);
          url: universityData.root_url + '/wp-json/university/v1/manageLike',
          type: 'POST',
          data: {'professorId': currentLikeBox.data('professor')},
          success: (response) => {
            //updating data attribute in single-professor.php to show full heart.
            currentLikeBox.attr('data-exists','yes');

            //retrieving the like counter from single-professor.php and converting to base 10.
            var likeCount=parseInt(currentLikeBox.find(".like-count").html(),10);
            likeCount++; //increamenting the like counter.
            currentLikeBox.find(".like-count").html(likeCount) //updating like count variable in single-professor.php
            //updating liked post id.
            currentLikeBox.attr('data-like',response);
            //if we dont set it here, it will remain empty. we have to do hard refresh single-professor.php otherwise.


            console.log(response);
          },
          error: (response) => {
            console.log(response);
          }
        });


  }
  deleteLike(currentLikeBox) {
//    alert("delete test message.");

      $.ajax({
          beforeSend: (xhr)=> {
            xhr.setRequestHeader('X-WP-Nonce',universityData.nonce);
          }, //adding attributes to request for trust. nonce created in functions.php
          url: universityData.root_url + '/wp-json/university/v1/manageLike',
          type: 'DELETE',
          data: {'like': currentLikeBox.attr('data-like') },
          success: (response) => {

            currentLikeBox.attr('data-exists','no');

            //retrieving the like counter from single-professor.php and converting to base 10.
            var likeCount=parseInt(currentLikeBox.find(".like-count").html(),10);
            likeCount--; //decreamenting the like counter.
            currentLikeBox.find(".like-count").html(likeCount) //updating like count variable in single-professor.php
            //updating the liked post id from html.
            currentLikeBox.attr('data-like','');
            //if we dont set it here, it will remain empty. we have to do hard refresh single-professor.php otherwise.

            console.log(response);
          },
          error: (response) => {
            console.log(response);
          }
        });

  }
}

export default Like;
