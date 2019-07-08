<?php
//to create a note in events.
FileName: .js/modules/MyNotes.js
FileName: page-my-notes.php

  events(){
    $(".submit-note").on("click",this.createNote.bind(this));
  }


  createNote(e){
    /*here we donot need li element because there are no multiple elements to get edited.
      var thisNote=$(e.target).parents("li"); */

    var ourNewPost = {
      'title': $(".new-note-title").val(),
      'content': $(".new-note-body").val(),
      'status': 'publish' // default is 'draft' , other value is private.
    }


    $.ajax({
      beforeSend: (xhr)=> {
        xhr.setRequestHeader('X-WP-Nonce',universityData.nonce);
      }, //adding attributes to request for trust. nonce created in functions.php

      //url: universityData.root_url + '/wp-json/wp/V2/note/' + thisNote.data("id"),
      url: universityData.root_url + '/wp-json/wp/V2/note/', //for pages, we can use page.
      type: 'POST',   //create post identifier
      data: ourNewPost,
      success: (response)=>{

          //-----------clearing the control boxes-----------------.
          $(".new-note-title,.new-note-body").val(''); //we dont find as there is only 1 instance.

          //sample to slide down the contents.
          $('<li>Imagine real data</li>').prependTo("#my-notes").hide().slideDown();
          //#my-notes is the div id.
          //-----------end of clearing the control boxes -----------


            //this.makeNoteReadOnly(thisNote); //we dont need as it is not the editing case where we need to disable the editing..
      },
      error: (response) =>{

          console.log('Failure. create :');
          console.log(response);

      }
    });
  }
-------------------------------------------------------------------------------------------

in MyNotes.js file,



  events(){
    $(".delete-note").on("click",this.deleteNote); //catching delete-note class.
    //with this.deleteNote() parenthesis, it will run along with constructor and not on click method. so using this.deleteNote instead.

    $(".edit-note").on("click",this.editNote.bind(this));
    $(".update-note").on("click",this.updateNote.bind(this));
    $(".submit-note").on("click",this.createNote.bind(this));
  }


Note: The above methods will work when we have predefined html elements in page-my-notes.php. But if we create notes at run time,  the now <li> that will created will not get attached with the above listners.
    To enable listners to listen to the newly posted/created html elements which we are doing in   createNote(e) method of MyNotes.js  we need to modify as.



  events(){
    $("#my-notes").on("click",this.deleteNote); //catching delete-note class.
    //with this.deleteNote() parenthesis, it will run along with constructor and not on click method. so using this.deleteNote instead.

    $("#my-notes").on("click",".edit-note",this.editNote.bind(this));
    $("#my-notes").on("click",".update-note",this.updateNote.bind(this));
    $("#my-notes").on("click",".submit-note",this.createNote.bind(this));
  }


Note: i.e. we selected the <ul id ="my-notes"> element and then it will listen to any newly created element on the fly having corresponding classes.



?>
