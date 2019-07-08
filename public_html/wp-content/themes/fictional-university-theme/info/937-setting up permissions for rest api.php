937-setting up permissions for rest api via mu-plugin.
FileName: functions.php,
FileName: MyNotes.js,
FileName: muplugin->university-post-types.php
FileName: ,page-my-notes.php


<?php
function create_notes_post_type(){

$post_type='note';
$labels =array(
      'name' => 'Notes',    // in the admin left tree.
      'add_new_item' => 'Add New Note',
      'edit_item' => 'Edit Note',
      'all_items' => 'All Notes',
      'singular_name' => 'Note'
);
$rewrite =array(
'slug' => 'notes'
);

$support_avaliable_for_custom_note_posts =array(
  'title','editor','thumbnail','author'
  /*"supports": ["title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats", "none"]*/
);


  register_post_type($post_type, array(
    'capability_type' => 'note', // this can be any text reqd for new rights.and make notes available in user->roles.
    'map_meta_cap' => true, //enforce permission @ right time, @ right place. admin -> notes will crash otherwise.
    'show_in_rest' =>true,  // the node will beome available in rest api
    'supports' => $support_avaliable_for_custom_note_posts,
    /*we dont want archive for professor types*/
    //'rewrite' => $rewrite,
    //'has_archive' => true,
    'public' => false,  //notes must be pvt associated with each account. to resotre
    'show_ui'=> true,
    'labels' => $labels,
    'menu_icon' => 'dashicons-welcome-write-blog'
  ));
}



Note: After assigning     'capability_type' => 'note', 'map_meta_cap' => true
we need to give administrator rights to the note post type from users->roles.

Subscriber rights: edit_notes / publish_notes / delte_notes / edit_published_notes.


making posts private:
-------------------------------

/js/modules/MyNotes.js -> createNote(e)
Method1;

    var ourNewPost = {
      'title': $(".new-note-title").val(),
      'content': $(".new-note-body").val(),
      //'status': 'publish' // default is 'draft' , other value is private.
      'status': 'private' //contents wont be available in post man for security reasons.
      //postman url to test = http://amazingcollege.test/wp-json/wp/v2/note
    }
postman url = http://amazingcollege.test/wp-json/wp/v2/note




Method2:
    var ourNewPost = {
      'title': $(".new-note-title").val(),
      'content': $(".new-note-body").val(),
      'status': 'publish' //draft/private/publish
    }

and we secure the contents in functions.php .

//force note posts to be private. A more secure way to restrain from malicious attempt..
function makeNotePrivate($data) {
if ($data['post-type']=='note' AND $data['post-type']!='trash'){
  $data['post-status'] ="private";
}

return $data;
}
add_filter('wp_insert_post_data','makeNotePrivate');

------------------------------------------------------
in page-my-notes.php
  <input readonly class="note-title-field"  value="<?php echo  esc_attr(get_the_title()); ?>">
    //it prints the title with Private: attribute. to remove it we need to use str_replace(a,b,c);

  <input readonly class="note-title-field"  value="<?php echo  esc_attr(get_the_title()); ?>">
        str_replace('Private :','',esc_attr(get_the_title()));

uncheck delete published notes and edit published notes from subscriber in admin.
----------------------------------------------
esc_attr // when reading actual value.
esc_html
esc_textarea( $text ); // for text area.

in page-my-notes.php
echo  str_replace('Private:','',esc_attr(get_the_title()));
echo esc_textarea(get_the_content());

//plain text. in functions.php->makeNotePrivate
sanitize_textarea_field( $str );
sanitize_text_field($data['post_title']);


-------------------------------------------
in page-my-notes.php add
  <span class="note-limit-message">Note limit reached: delete an existing note to make room for a new one.</span>

in MyNotes.js-> createNote(e){
//add
        error: (response) =>{
          if (response.responseText=="You have reached your note limit."){
            $(".note-limit-message").addClass("active"); //displaying error message that limit reached.
          }

}

// at the time of deleting notes, we need to hide the error message of max limit. so we need note count property in functions.php ->university_custom_rest()

     register_rest_field( 'note', 'userNoteCount', array(
      //assainging value to  autorName parameter.
      //we can verify the author name as http://amazingcollege.test/wp-json/wp/v2/posts
      'get_callback' => function() {return count_user_posts( get_current_user_id();, 'note');}
     ) );


// at the time of delte note, we need userNoteCount property to make error message disappear.
      in MyNotes.js->deleteNote(e) // add
               if (response.userNoteCount < 5){ // variable is created in functions.php ->university_custom_rest
            $(".note-limit-message").removeClass("active");
          }

----------------------------------------
subscriber ritghts:
edit notes / publish notes/ delte notes / delete published notes / edit published notes.

since user notes will be pvt so we can further redure rights to
edit notes / publish notes/ delte notes

---------------------------------------
Check for limit post =5.
step1:
in MyNotes.js->deleteNotes(e)
          //hiding error message of notecount.
          if (response.userNoteCount < 5){
                                ===========
          // variable is created in functions.php ->university_custom_rest
            $(".note-limit-message").removeClass("active");
          }
step2:
in functions.php -> makeNotePrivate(e)
  if ($data['post_type'] == 'note') {
    if(count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID']) {
                                                =============
      die("You have reached your note limit.");
      /*!$postarr['ID'] => if it will be a new post as new post does not containt ID, and after post limit ends. die will end the process and no new note will be created.*/

    }
-----------------------------------------
JQueryAjax:

for delete /update / create
  we use jquery : ajax in MyNotes.js
Syntax:
  var postURL=universityData.root_url + '/wp-json/university/v1/search?term=' + this.searchField.val();
  $.getJSON(postURL,(result)=>{
            //console.log(result);
            //resultsDiv handler in constructor
          this.resultsDiv.html(`
                           ${result.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}

                           ${result.generalInfo.map(item=>`<li><a href="${item.permalink}">${item.title}</a>${item.postType=='post' ? ` by ${item.authorName}` : ''} </li>`).join('')
                         } `));
    }
-------------------------------------------
JQueryJsonCreate:

for searching in database, we used
  jquery : json in Search.js

Syntax:

  createNote(e){
    var ourNewPost = {
      'title': $(".new-note-title").val(),
      'content': $(".new-note-body").val(),
      'status': 'publish'
    }

    $.ajax({
      beforeSend: (xhr)=> {
        xhr.setRequestHeader('X-WP-Nonce',universityData.nonce);
      },
      url: universityData.root_url + '/wp-json/wp/V2/note/',
      type: 'POST',
      data: ourNewPost,
      success: (response)=>{
          //Clearing the control boxes having relevant classes
          $(".new-note-title,.new-note-body").val('');
          //sample to slide down.
          $(`
            <li data-id = "${response.id}">
              <input readonly  value="${response.title.raw}">
              <textarea readonly >${response.content.raw}</textarea>

            </li>
            `).prependTo("#my-notes").hide().slideDown();
      },
      error: (response) =>{
          if (response.responseText=="You have reached your note limit."){
            $(".note-limit-message").addClass("active"); //displaying error message.
          }
      }
    });
  }

---------------------------------------------------------
JQueryJsonUpdate:
    //difference from create
    var thisNote=$(e.target).parents("li");
    var ourUpdatedPost = {
      'title': thisNote.find(".note-title-field").val(),
      'content': thisNote.find(".note-body-field").val()
    }
    // ---------end difference -----------

    $.ajax({
      beforeSend: (xhr)=> {
        xhr.setRequestHeader('X-WP-Nonce',universityData.nonce);
      },
      url: universityData.root_url + '/wp-json/wp/V2/note/' + thisNote.data("id"), // difference
      type: 'POST',
      data: ourUpdatedPost,
      success: (response)=>{
      },
      error: (response) =>{
      }
    });
---------------------------------------------------------
JQueryJsonDelete:

    var thisNote=$(e.target).parents("li");
    $.ajax({
      beforeSend: (xhr)=> {
        xhr.setRequestHeader('X-WP-Nonce',universityData.nonce);
      },
      url: universityData.root_url + '/wp-json/wp/V2/note/' + thisNote.data("id"),
      type: 'DELETE',             //difference
      //data: ourUpdatedPost,     //differnce as data attribute not required.
      success: (response)=>{
          console.log('success Delete');
          //hiding error message of notecount.
          if (response.userNoteCount < 5){ // difference
            $(".note-limit-message").removeClass("active");
          }

          thisNote.slideUp();
      },
      error: (response) =>{

      }
    });

          console.log('Failure. create :');
          console.log(response);















?>
