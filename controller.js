'use strict';

/**
 * Controller initializer
 */
(function() {
  var layerSampleApp = window.layerSampleApp;
  layerSampleApp.Controller = function(client) {

    var titlebarView, sidebarView, conversationListView, conversationListHeaderView,
      userListView, activeConversation, conversationQuery,
      messageListView, messageComposerView, messagesQuery;

    /**
     * During initialization, create all of the views and setup event listeners
     * to handle user interaction events.
     */
    function initializeViews() {
      titlebarView = new layerSampleApp.Titlebar();
      titlebarView.render();

      // Setup Conversation Views
      conversationListView = new layerSampleApp.ConversationList();
      conversationListHeaderView = new layerSampleApp.ConversationListHeader();
      userListView = new layerSampleApp.UserListDialog();

      // Setup Message Views
      messageComposerView = new layerSampleApp.MessageComposer();
      messageListView = new layerSampleApp.MessageList();

      // When the user clicks the New Conversation button in the
      // Conversation List Header, call newConversation.
      conversationListHeaderView.on('conversations:new', function() {
        newConversation();
      });

      // When the user is in the User List Dialog and clicks to create a conversation,
      // call createConversation.
      userListView.on('conversation:created', function(participants) {
        createConversation(participants);
      });

      // When the user selects a Conversation, call selectConversation.
      conversationListView.on('conversation:selected', function(conversationId) {
          selectConversation(conversationId);
      });

      // When the user hits ENTER after typing a message this will trigger
      // to create a new message and send it.
      messageComposerView.on('message:new', function(text) {
        sendMessage(text);
      });
    }
    /**
     * During initialization we need to create the queries that will
     * download data from Layer's servers;
     * Also need to setup event handlers to rerender when the query
     * data changes.
     */
    function initializeQueries() {
      /**
       * Create the Conversation List Query
       */

       

      conversationQuery = client.createQuery({
        model: layer.Query.Conversation,
        sortBy: [{'lastMessage.sentAt': 'desc'}]
      });
      if(!conversationQuery.isDestroyed) {
        conversationQuery.destroy();
      }
      conversationQuery = client.createQuery({
        model: layer.Query.Conversation,
        sortBy: [{'lastMessage.sentAt': 'desc'}]
      });
      //this.initializeViews();
      /**
       * Any time a Conversation is created, deleted, or its participants changed,
       * rerender the conversation list
       */
      conversationQuery.on('change', function(evt) {

        conversationQuery.data.forEach(function(conversation){
          if(conversation.participants.length==0 && conversationListView.checkifSelectedConversation(conversation)) {
            titlebarView.render(null);
            messageListView.render(null);
          }
        });

        if (evt.type === 'remove') {

          var removedItem = evt.target;
          if(removedItem==conversationListView.selectedConversation) {
            titlebarView.render(null);
          } 
          
          conversationListView.removeFromTreeNames(removedItem.metadata.student.name);
        }
        conversationListView.render(conversationQuery.data);
        //console.log("something changed " +  conversationQuery.data.length);
        //use a for each loop to delete now
        
        
      });

      // Tutorial Step 3: Setup the Message Query here
      messagesQuery = layerSampleApp.client.createQuery({
        model: layer.Query.Message
      });
      if(messagesQuery!=null) {
        messagesQuery.destroy();
      }

      messagesQuery = layerSampleApp.client.createQuery({
        model: layer.Query.Message
      });


      messagesQuery.on('change', function(e) {
        messageListView.render(messagesQuery.data);
      });
      
      
      


    }

    /**
     * Handle the user requesting to create a new conversation by showing the User List Dialog.
     */
    function newConversation() {
      userListView.show();
    }

    /**
     * Handle the user creating a Conversation from the User List Dialog.
     */
    function createConversation(participants) {
      var conversation = client.createConversation({
          participants: participants,
          distinct: true
      });
      selectConversation(conversation.id);
    }

    /**
     * Handle the user selecting a Conversation
     */
    function selectConversation(conversationId) {
      var conversation = client.getConversation(conversationId);
      activeConversation = conversation;

      // Update the Conversation List to highlight the selected Conversation
      conversationListView.selectedConversation = conversation;
      conversationListView.render();

      titlebarView.render(conversation);

      // Tutorial Step 3: Update Mesage Query here
      messagesQuery.update({
        predicate: 'conversation.id = "' + conversationId + '"'
      });


    }

    function sendMessage(text) {
      // Tutorial Step 2: Send a message
      if (activeConversation) {
        var message = activeConversation.createMessage(text).send();
        message.on('messages:sent', function(evt) {
            console.log('Message was sent with text: ' + evt.target.parts[0].body);
        });
      }
    }

    // Initialize Everything:
    initializeQueries();
    initializeViews();

//         $(window).load(function() {
          
        var send_email_report = function (em_arr) {
          for (var i = 0; i < em_arr.length; i++) {
            console.log(document.getElementById("notes").value +"test");
            var email = currentUser.attributes.email;
            var php_data = "email=" + em_arr[i] + "&second="+ email + "&body=" + document.getElementById("notes").value;
            console.log(php_data);
            $.ajax({
              type: "POST",
              url: '../reportEmail.php',
              data: php_data,
              success: function() {}
            });
          }
        };
        document.getElementById("report").addEventListener("click", function () {
          if(conversationListView.selectedConversation) {
              var email_array=[currentUser.attributes.schoolID];
              var Schools = Parse.Object.extend("SchoolIDs");
              var query = new Parse.Query(Schools); 
              console.log(currentUser.attributes.schoolID);
              console.log(currentUser.attributes.schoolID.id);
              query.get(currentUser.attributes.schoolID.id, {
                  success: function(school) {
                    var modal = document.getElementById("myModal");
                    document.getElementById("modal-text").innerHTML= "Are you sure you want to report this conversation? You reveal the student's identity and conversation history to you organizations' admin.";
                  document.getElementById("OKModal").value="Report";
                  document.getElementById("OKModal").style.border="solid 1px #e60000";
                  document.getElementById("OKModal").style.backgroundColor="#ff0000";
                  $("#OKModal").hover(function(){
                      $(this).css("background-color", "#cc0000");
                      }, function(){
                      $(this).css("background-color", "#ff0000");
                  });
                  modal.style.display = "block";


                  $( "#OKModal").unbind("click");
                  //OK Button
                  $("#OKModal").click(function() {

                    
                    var query = new Parse.Query(Parse.User);
                    query.equalTo("counselorType", "0");  // find all the counselors
                    query.equalTo("schoolID", currentUser.attributes.schoolID);
                    query.find({
                      success: function(counselors) {
                        var newParticipants=[];
                        counselors.forEach(function(counselor){
                          newParticipants.push(counselor.id);
                          console.log(newParticipants);
                        });
                        
                        conversationListView.selectedConversation.addParticipants(newParticipants);
                        
                      }
                    });
                    modal.style.display = "none";
                    console.log(school);
                    email_array=[school.attributes.SchoolEmails];
                      send_email_report(email_array);
                      document.getElementById("notes").value="";
                  });


                    
                  },
                  error: function(object, error) {
                    // The object was not retrieved successfully.
                    // error is a Parse.Error with an error code and message.
                    document.getElementById("OKModal").style.display="none";
                    document.getElementById("modal-text").innerHTML= 'Error making the report! Email us at <a href="mailto:teamroots@teamroots.org">teamroots@teamroots.org</a>  to share the problem. Or try again.';
                    var modal = document.getElementById('myModal');
                    modal.style.display="block";
                  }
              });
          }
      });



document.getElementById("banuser").addEventListener("click", function () {

                console.log("I am here");
                  var modal = document.getElementById("myModal");
                  document.getElementById("modal-text").innerHTML= "Are you sure you want to disable these counselors accounts?";
                document.getElementById("OKModal").value="Disable";
                document.getElementById("OKModal").style.border="solid 1px #e60000";
                document.getElementById("OKModal").style.backgroundColor="#ff0000";
                $("#OKModal").hover(function(){
                    $(this).css("background-color", "#cc0000");
                    }, function(){
                    $(this).css("background-color", "#ff0000");
                });
                modal.style.display = "block";


                $( "#OKModal").unbind("click");
                //OK Button
                $("#OKModal").click(function() {

                  
                  var email_text = document.getElementById("emails").value.replace(/\s/g, '');
                  var num_commas = (email_text.match(/,/g) || []).length;
                  alert("reset");
                  var email_array = email_text.split(',');
                  Parse.Cloud.run('banUsers', { counselors: email_array }, {

                  success: function(result) {
                  // result is 'Hello world!'
                      //console.log(result);
                      modal.style.display = "none";
                      document.getElementById("emails").value="";
                  },
                  error: function(object, error) {
                      document.getElementById("OKModal").style.display="none";
                      console.log(object.message);
                      document.getElementById("modal-text").innerHTML= object.message;
                      var modal = document.getElementById('myModal');
                      modal.style.display="block";
                  }
                });
                });
                  
                });

document.getElementById("unreport").addEventListener("click", function () {
              if(conversationListView.selectedConversation) {
                   var modal = document.getElementById("myModal");
                    document.getElementById("modal-text").innerHTML= "Are you sure you want to un-flag this conversation? You lose access to conversation history and enable the student to delete the conversation.";
                  document.getElementById("OKModal").value="Undo";
                  document.getElementById("OKModal").style.border="solid 1px #51C781";
                  document.getElementById("OKModal").style.backgroundColor="#64c87a";
                  $("#OKModal").hover(function(){
                      $(this).css("background-color", "#5CA759");
                      }, function(){
                      $(this).css("background-color", "#64c87a");
                  });
                  modal.style.display = "block";


                  $( "#OKModal").unbind("click");
                  //OK Button
                  $("#OKModal").click(function() {

                    
                    var query = new Parse.Query(Parse.User);
                    query.equalTo("counselorType", "0");  // find all the counselors
                    query.equalTo("schoolID", currentUser.attributes.schoolID);
                    query.find({
                      success: function(counselors) {
                        var newParticipants=[];
                        counselors.forEach(function(counselor){
                          newParticipants.push(counselor.id);
                        });
                        
                        conversationListView.selectedConversation.removeParticipants(newParticipants);
                        
                      }
                    });
                    modal.style.display = "none";
                  });
              }
                  
          });
  };
})();
