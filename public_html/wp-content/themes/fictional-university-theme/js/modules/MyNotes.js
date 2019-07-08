import $ from 'jquery'; // thanks to npm and webpack.
class MyNotes {
  constructor() {
    this.events();
  }
  events(){
    /*$(".delete-note").on("click",this.deleteNote); //catching delete-note class.
    //with this.deleteNote() parenthesis, it will run along with constructor and not on click method.
    $(".edit-note").on("click",this.editNote.bind(this));
    $(".update-note").on("click",this.updateNote.bind(this));
    $(".submit-note").on("click",this.createNote.bind(this));*/


    $("#my-notes").on("click",".delete-note",this.deleteNote); //catching delete-note class.
    //with this.deleteNote() parenthesis, it will run along with constructor and not on click method. so using this.deleteNote instead.

    $("#my-notes").on("click",".edit-note",this.editNote.bind(this));
    $("#my-notes").on("click",".update-note",this.updateNote.bind(this));
    $(".submit-note").on("click",this.createNote.bind(this));
    //  Note: i.e. we selected the <ul id ="my-notes"> element and then it will listen to any
    //newly created element on the fly having corresponding classes.
  }
  //methods goes here
  //deleteNote(e() by default. e is added after adding data-id in li in page-my-notes.php
  deleteNote(e) {
    //alert('hello');
    /* console.log(e);
    <li data-id ="<?php the_ID()?>">
    var thisNote =$(e.target).parents("li");
    console.log(thisNote);
    console.log("note.data");
    console.log(thisNote.data('id'));
    if <li data-id1 ="<?php the_ID()?>">
    then  console.log(thisNote.data('id1'));*/
    var thisNote=$(e.target).parents("li");
    $.ajax({
      beforeSend: (xhr)=> {
        xhr.setRequestHeader('X-WP-Nonce',universityData.nonce);
      }, //adding attributes to request for trust. nonce created in functions.php
      url: universityData.root_url + '/wp-json/wp/V2/note/' + thisNote.data("id"),
      type: 'DELETE',
      success: (response)=>{
          console.log('success Delete');
          console.log(response);
          /*console.log(universityData.root_url);*/


          //hiding error message of notecount.
          if (response.userNoteCount < 5){ // variable is created in functions.php ->university_custom_rest
            $(".note-limit-message").removeClass("active");
          }

          thisNote.slideUp();
          //refresh contents with slide effects.
      },
      error: (response) =>{
          console.log('failure. Delete response:');
          console.log(response);
          /*console.log(universityData.root_url);*/
      }
    });
  }

  editNote(e){
    var thisNote = $(e.target).parents("li");
    if (thisNote.data("state")=="editable") { //both data and value is added in html at run time.
      this.makeNoteReadOnly(thisNote);

    } else {
      this.makeNoteEditable(thisNote);
    }
  }
  makeNoteEditable(thisNote) {
    thisNote.find(".edit-note").html('<i class="fa fa-pencil" aria-hidden="true"></i>Cancel');
    thisNote.find(".note-title-field, .note-body-field").removeAttr("readonly").addClass("note-active-field");
    thisNote.find(".update-note").addClass("update-note--visible");
    thisNote.data("state","editable");
  }

  makeNoteReadOnly(thisNote){
    thisNote.find(".edit-note").html('<i class="fa fa-pencil" aria-hidden="true"></i>Edit');
    thisNote.find(".note-title-field, .note-body-field").attr("readonly","readonly").removeClass("note-active-field");
    thisNote.find(".update-note").removeClass("update-note--visible");
    thisNote.data("state","cancel"); // we can use any word instead of cancel.
  }

  updateNote(e) {

    var thisNote=$(e.target).parents("li");
    var ourUpdatedPost = {
      'title': thisNote.find(".note-title-field").val(),
      'content': thisNote.find(".note-body-field").val()
    }

    $.ajax({
      beforeSend: (xhr)=> {
        xhr.setRequestHeader('X-WP-Nonce',universityData.nonce);
      }, //adding attributes to request for trust. nonce created in functions.php
      url: universityData.root_url + '/wp-json/wp/V2/note/' + thisNote.data("id"),
      type: 'POST',
      data: ourUpdatedPost,
      success: (response)=>{
          console.log('success update');
          console.log(response);
          /*console.log(universityData.root_url);*/
          this.makeNoteReadOnly(thisNote);

      },
      error: (response) =>{
          console.log('success. Delete :');
          console.log(response);
      }
    });
  }
  createNote(e){
    /*here we donot need li element because there are no multiple elements to get edited.*/

    /*var thisNote=$(e.target).parents("li");
    var ourUpdatedPost = {
      'title': thisNote.find(".note-title-field").val(),
      'content': thisNote.find(".note-body-field").val()
    }*/

    var ourNewPost = {
      'title': $(".new-note-title").val(),
      'content': $(".new-note-body").val(),
      'status': 'publish'
      //'status': 'publish' // default is 'draft' , other value is private.
      //'status': 'private' //contents wont be available in post man for security reasons.
      //postman url to test = http://amazingcollege.test/wp-json/wp/v2/note

      // see 937-setting up permissions for rest api.php to make secure in functions.php -> makeNotePrivate()
    }


    $.ajax({
      beforeSend: (xhr)=> {
        xhr.setRequestHeader('X-WP-Nonce',universityData.nonce);
      }, //adding attributes to request for trust. nonce created in functions.php
      //url: universityData.root_url + '/wp-json/wp/V2/note/' + thisNote.data("id"),
      url: universityData.root_url + '/wp-json/wp/V2/note/', //for pages, we can use page.
      type: 'POST',
      data: ourNewPost,
      success: (response)=>{
          console.log('success created');
          console.log(response);
          //-----------clearing the control boxes-----------------.
          $(".new-note-title,.new-note-body").val(''); //we dont find as there is only 1 instance.

          //sample to slide down.
          $(`
            <li data-id = "${response.id}">
              <input readonly class="note-title-field"  value="${response.title.raw}">

              <span class="edit-note" ><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span>
              <span class="delete-note" ><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span>

              <textarea readonly class="note-body-field" >${response.content.raw}</textarea>

              <span class="update-note btn btn--blue btn--small" ><i class="fa fa-arrow-right" aria-hidden="true"></i>Save</span>

            </li>
            `).prependTo("#my-notes").hide().slideDown();

          //-----------end of clearing the control boxes -----------


          /*console.log(universityData.root_url);*/
            //this.makeNoteReadOnly(thisNote); //we dont need as it is not the editing case.
      },
      error: (response) =>{
          if (response.responseText=="You have reached your note limit."){
            $(".note-limit-message").addClass("active"); //displaying error message.
          }
          console.log('Failure. create :');
          console.log(response);
          /*console.log(universityData.root_url);*/
          //"You have reached your note limit."
      }
    });
  }

}

export default MyNotes;
