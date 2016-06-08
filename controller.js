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

    var onboardingdisplaytext;


        var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

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
      setTimeout(function() {
        if(conversationQuery.data.length==0) {
          onboardingdisplaytext=true;
          document.getElementById("welcometext").innerHTML="Good news. No one's in trouble yet. You have no messages.";
          // console.log(conversationQuery.data);
        } else {
          onboardingdisplaytext=false;
          console.log(conversationQuery.data);
          document.getElementById("welcometext").innerHTML= "Tap a conversation to the left to start changing people's lives. :)";
        }
      }, 500);

      //this.initializeViews();
      /**
       * Any time a Conversation is created, deleted, or its participants changed,
       * rerender the conversation list
       */
      conversationQuery.on('change', function(evt) {
        /*if(conversationQuery.data.length!=0) {
            if(document.getElementById("welcometext"))
                document.getElementById("welcometext").innerHTML= "Tap a conversation to the left to start changing people's lives. :)";
        }*/
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
        if(document.getElementById("welcometext")) {
          if(getUrlParameter("conversationid")!=null) {
            selectConversation(getUrlParameter('conversationid'));
            //window.location.search = jQuery.query.REMOVE('conversationid');
          }
        } 
        
        
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
            // console.log('Message was sent with text: ' + evt.target.parts[0].body);
        });
      }
    }

    // Initialize Everything:
    initializeQueries();
    initializeViews();


    // if(onboardingdisplaytext) {
    //   document.getElementById("welcometext").innerHTML="Good news. No one's in trouble yet. You have no messages.";
    // } else {
    //   document.getElementById("welcometext").innerHTML= "Tap a conversation to the left to start changing people's lives. :)";
    // }

//         $(window).load(function() {
          
        var send_email_report = function (em_arr) {
          for (var i = 0; i < em_arr.length; i++) {
            var email = currentUser.attributes.email;
            var php_data = "email=" + em_arr[i] + "&second="+ email + "&body=" + document.getElementById("notes").value + "&conversationid=" + conversationListView.selectedConversation.id + "&name=" + currentUser.attributes.name;
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
          console.log("I am here");
          if(conversationListView.selectedConversation) {
              console.log("selected conversation detected");
              var email_array=[currentUser.attributes.schoolID];
              var Schools = Parse.Object.extend("SchoolIDs");
              var query = new Parse.Query(Schools); 
              query.get(currentUser.attributes.schoolID.id, {
                  success: function(school) {
                    console.log("query successful");
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
                        var email_array = [];
                        counselors.forEach(function(counselor){
                          newParticipants.push(counselor.id);
                          email_array.push(counselor.getUsername());
                        });
                        
                        
                        conversationListView.selectedConversation.addParticipants(newParticipants);
                        send_email_report(email_array);
                        modal.style.display = "none";
                        document.getElementById("notes").value="";
                      }
                    });
                    
                    

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

var _0xa792=["\x63\x6C\x69\x63\x6B","\x6D\x79\x4D\x6F\x64\x61\x6C","\x67\x65\x74\x45\x6C\x65\x6D\x65\x6E\x74\x42\x79\x49\x64","\x69\x6E\x6E\x65\x72\x48\x54\x4D\x4C","\x6D\x6F\x64\x61\x6C\x2D\x74\x65\x78\x74","\x41\x72\x65\x20\x79\x6F\x75\x20\x73\x75\x72\x65\x20\x79\x6F\x75\x20\x77\x61\x6E\x74\x20\x74\x6F\x20\x64\x69\x73\x61\x62\x6C\x65\x20\x74\x68\x65\x73\x65\x20\x63\x6F\x75\x6E\x73\x65\x6C\x6F\x72\x73\x20\x61\x63\x63\x6F\x75\x6E\x74\x73\x3F","\x76\x61\x6C\x75\x65","\x4F\x4B\x4D\x6F\x64\x61\x6C","\x44\x69\x73\x61\x62\x6C\x65","\x62\x6F\x72\x64\x65\x72","\x73\x74\x79\x6C\x65","\x73\x6F\x6C\x69\x64\x20\x31\x70\x78\x20\x23\x65\x36\x30\x30\x30\x30","\x62\x61\x63\x6B\x67\x72\x6F\x75\x6E\x64\x43\x6F\x6C\x6F\x72","\x23\x66\x66\x30\x30\x30\x30","\x62\x61\x63\x6B\x67\x72\x6F\x75\x6E\x64\x2D\x63\x6F\x6C\x6F\x72","\x23\x63\x63\x30\x30\x30\x30","\x63\x73\x73","\x68\x6F\x76\x65\x72","\x23\x4F\x4B\x4D\x6F\x64\x61\x6C","\x64\x69\x73\x70\x6C\x61\x79","\x62\x6C\x6F\x63\x6B","\x75\x6E\x62\x69\x6E\x64","","\x72\x65\x70\x6C\x61\x63\x65","\x65\x6D\x61\x69\x6C\x73","\x6C\x65\x6E\x67\x74\x68","\x6D\x61\x74\x63\x68","\x2C","\x73\x70\x6C\x69\x74","\x62\x61\x6E\x55\x73\x65\x72\x73","\x6E\x6F\x6E\x65","\x6D\x65\x73\x73\x61\x67\x65","\x72\x75\x6E","\x43\x6C\x6F\x75\x64","\x61\x64\x64\x45\x76\x65\x6E\x74\x4C\x69\x73\x74\x65\x6E\x65\x72","\x62\x61\x6E\x75\x73\x65\x72","\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A","\x72\x61\x6E\x64\x6F\x6D","\x66\x6C\x6F\x6F\x72","\x74\x6F\x55\x70\x70\x65\x72\x43\x61\x73\x65","\x6A\x6F\x69\x6E","\x43\x6F\x6E\x66\x69\x72\x6D\x61\x74\x69\x6F\x6E\x5F\x43\x6F\x64\x65\x73","\x65\x78\x74\x65\x6E\x64","\x4F\x62\x6A\x65\x63\x74","\x6C\x69\x6D\x69\x74","\x63\x6F\x64\x65","\x65\x71\x75\x61\x6C\x54\x6F","\x54\x68\x65\x72\x65\x20\x73\x65\x65\x6D\x73\x20\x74\x6F\x20\x62\x65\x20\x61\x20\x70\x72\x6F\x62\x6C\x65\x6D\x20\x77\x69\x74\x68\x20\x6F\x75\x72\x20\x77\x65\x62\x73\x69\x74\x65\x2E\x20\x45\x6D\x61\x69\x6C\x20\x75\x73\x20\x61\x74\x20\x3C\x61\x20\x68\x72\x65\x66\x3D\x22\x6D\x61\x69\x6C\x74\x6F\x3A\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x40\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x2E\x6F\x72\x67\x22\x3E\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x40\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x2E\x6F\x72\x67\x3C\x2F\x61\x3E\x2E\x20\x57\x69\x74\x68\x20\x74\x68\x65\x20\x66\x6F\x6C\x6C\x6F\x77\x69\x6E\x67\x20\x69\x6E\x66\x6F\x72\x6D\x61\x74\x69\x6F\x6E\x3A\x20\x3C\x62\x72\x3E\x20\x20\x45\x72\x72\x6F\x72\x20","\x20","\x2E","\x74\x68\x65\x6E","\x66\x69\x6E\x64","\x67\x65\x74\x53\x65\x73\x73\x69\x6F\x6E\x54\x6F\x6B\x65\x6E","\x63\x75\x72\x72\x65\x6E\x74","\x55\x73\x65\x72","\x75\x73\x65\x72\x6E\x61\x6D\x65","\x65\x6D\x61\x69\x6C","\x73\x65\x74","\x70\x61\x73\x73\x77\x6F\x72\x64","\x63\x6F\x75\x6E\x73\x65\x6C\x6F\x72\x54\x79\x70\x65","\x31","\x73\x63\x68\x6F\x6F\x6C\x49\x44","\x61\x74\x74\x72\x69\x62\x75\x74\x65\x73","\x69\x73\x41\x76\x61\x69\x6C\x61\x62\x6C\x65","\x72\x6F\x6F\x74\x73\x41\x75\x74\x68\x44\x61\x74\x61","\x6E\x6F\x74\x76\x65\x72\x69\x66\x69\x65\x64","\x62\x65\x63\x6F\x6D\x65","\x65\x6D\x61\x69\x6C\x3D","\x26\x63\x6F\x64\x65\x3D","\x50\x4F\x53\x54","\x2E\x2E\x2F\x65\x6D\x61\x69\x6C\x2E\x70\x68\x70","\x61\x6A\x61\x78","\x3C\x61\x20\x68\x72\x65\x66\x3D\x22\x6D\x61\x69\x6C\x74\x6F\x3A","\x22\x3E","\x3C\x2F\x61\x3E\x20\x20\x68\x61\x73\x20\x61\x6C\x72\x65\x61\x64\x79\x20\x62\x65\x65\x6E\x20\x61\x64\x64\x65\x64\x20\x61\x73\x20\x61\x20\x63\x6F\x75\x6E\x73\x65\x6C\x6F\x72\x2E","\x73\x69\x67\x6E\x55\x70","\x68\x69\x64\x65","\x23\x61\x64\x64\x75\x73\x65\x72\x73\x73\x65\x63\x74\x69\x6F\x6E","\x23\x72\x65\x70\x6F\x72\x74\x75\x72\x67\x65\x6E\x74\x73\x65\x63\x74\x69\x6F\x6E","\x23\x63\x6C\x61\x73\x73\x2D\x6D\x65\x73\x73\x61\x67\x65\x2D\x62\x6F\x78\x2D\x63\x6F\x6E\x74\x61\x69\x6E\x65\x72\x2D\x6D\x61\x69\x6E\x63\x68\x61\x74","\x41\x72\x65\x20\x79\x6F\x75\x20\x73\x75\x72\x65\x20\x79\x6F\x75\x20\x77\x61\x6E\x74\x20\x74\x6F\x20\x61\x64\x64\x20\x74\x68\x65\x73\x65\x20\x65\x6D\x61\x69\x6C\x73\x20\x61\x73\x20\x63\x6F\x75\x6E\x73\x65\x6C\x6F\x72\x73\x3F","\x41\x64\x64\x20\x55\x73\x65\x72\x73","\x73\x6F\x6C\x69\x64\x20\x31\x70\x78\x20\x23\x35\x31\x43\x37\x38\x31","\x23\x36\x34\x63\x38\x37\x61","\x23\x35\x43\x41\x37\x35\x39","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x61\x6C\x6C","\x61\x64\x64\x75\x73\x65\x72","\x6C\x6F\x61\x64"];document[_0xa792[2]](_0xa792[35])[_0xa792[34]](_0xa792[0],function(){var _0x38bdx1=document[_0xa792[2]](_0xa792[1]);document[_0xa792[2]](_0xa792[4])[_0xa792[3]]=_0xa792[5];document[_0xa792[2]](_0xa792[7])[_0xa792[6]]=_0xa792[8];document[_0xa792[2]](_0xa792[7])[_0xa792[10]][_0xa792[9]]=_0xa792[11];document[_0xa792[2]](_0xa792[7])[_0xa792[10]][_0xa792[12]]=_0xa792[13];$(_0xa792[18])[_0xa792[17]](function(){$(this)[_0xa792[16]](_0xa792[14],_0xa792[15])},function(){$(this)[_0xa792[16]](_0xa792[14],_0xa792[13])});_0x38bdx1[_0xa792[10]][_0xa792[19]]=_0xa792[20];$(_0xa792[18])[_0xa792[21]](_0xa792[0]);$(_0xa792[18])[_0xa792[0]](function(){var _0x38bdx2=document[_0xa792[2]](_0xa792[24])[_0xa792[6]][_0xa792[23]](/\s/g,_0xa792[22]);var _0x38bdx3=(_0x38bdx2[_0xa792[26]](/,/g)||[])[_0xa792[25]];var _0x38bdx4=_0x38bdx2[_0xa792[28]](_0xa792[27]);Parse[_0xa792[33]][_0xa792[32]](_0xa792[29],{counselors:_0x38bdx4},{success:function(_0x38bdx5){_0x38bdx1[_0xa792[10]][_0xa792[19]]=_0xa792[30];document[_0xa792[2]](_0xa792[24])[_0xa792[6]]=_0xa792[22]},error:function(_0x38bdx6,_0x38bdx7){document[_0xa792[2]](_0xa792[7])[_0xa792[10]][_0xa792[19]]=_0xa792[30];document[_0xa792[2]](_0xa792[4])[_0xa792[3]]=_0x38bdx6[_0xa792[31]];var _0x38bdx1=document[_0xa792[2]](_0xa792[1]);_0x38bdx1[_0xa792[10]][_0xa792[19]]=_0xa792[20]}})})});var generate=function(){var _0x38bdx9=_0xa792[36][_0xa792[28]](_0xa792[22]);var _0x38bdxa=[];for(var _0x38bdxb=0;_0x38bdxb<15;_0x38bdxb++){_0x38bdxa[_0x38bdxb]=_0x38bdx9[Math[_0xa792[38]](Math[_0xa792[37]]()*10)];if(Math[_0xa792[38]]((Math[_0xa792[37]]()*2)+1)%2==0){_0x38bdxa[_0x38bdxb]=_0x38bdxa[_0x38bdxb][_0xa792[39]]()}};var _0x38bdxc=_0x38bdxa[_0xa792[40]](_0xa792[22]);var _0x38bdxd=Parse[_0xa792[43]][_0xa792[42]](_0xa792[41]);var _0x38bdxe= new Parse.Query(_0x38bdxd);_0x38bdxe[_0xa792[44]](1000);_0x38bdxe[_0xa792[46]](_0xa792[45],_0x38bdxc);return _0x38bdxe[_0xa792[51]]()[_0xa792[50]](function(_0x38bdxf){if(_0x38bdxf[_0xa792[25]]!=0){return generate()}else {return _0x38bdxc}},function(_0x38bdx10){document[_0xa792[2]](_0xa792[7])[_0xa792[10]][_0xa792[19]]=_0xa792[30];document[_0xa792[2]](_0xa792[4])[_0xa792[3]]=_0xa792[47]+_0x38bdx10[_0xa792[45]]+_0xa792[48]+_0x38bdx10[_0xa792[31]]+_0xa792[49];var _0x38bdx1=document[_0xa792[2]](_0xa792[1]);_0x38bdx1[_0xa792[10]][_0xa792[19]]=_0xa792[20]})};var save_student=function(_0x38bdx12){var _0x38bdx13=Parse[_0xa792[54]][_0xa792[53]]()[_0xa792[52]]();var _0x38bdx14= new Parse.User();_0x38bdx14[_0xa792[57]](_0xa792[55],_0x38bdx12[_0xa792[56]]);_0x38bdx14[_0xa792[57]](_0xa792[58],_0x38bdx12[_0xa792[45]]);_0x38bdx14[_0xa792[57]](_0xa792[56],_0x38bdx12[_0xa792[56]]);_0x38bdx14[_0xa792[57]](_0xa792[59],_0xa792[60]);_0x38bdx14[_0xa792[57]](_0xa792[61],currentUser[_0xa792[62]][_0xa792[61]]);_0x38bdx14[_0xa792[57]](_0xa792[63],true);_0x38bdx14[_0xa792[57]](_0xa792[64],_0xa792[65]);_0x38bdx14[_0xa792[75]](null,{success:function(_0x38bdx14){Parse[_0xa792[54]][_0xa792[66]](_0x38bdx13);var _0x38bdx15=_0xa792[67]+_0x38bdx12[_0xa792[56]]+_0xa792[68]+_0x38bdx12[_0xa792[45]];$[_0xa792[71]]({type:_0xa792[69],url:_0xa792[70],data:_0x38bdx15,success:function(){}})},error:function(_0x38bdx14,_0x38bdx7){if(_0x38bdx7[_0xa792[45]]=202){document[_0xa792[2]](_0xa792[7])[_0xa792[10]][_0xa792[19]]=_0xa792[30];document[_0xa792[2]](_0xa792[4])[_0xa792[3]]=_0xa792[72]+_0x38bdx12[_0xa792[56]]+_0xa792[73]+_0x38bdx12[_0xa792[56]]+_0xa792[74];var _0x38bdx1=document[_0xa792[2]](_0xa792[1]);_0x38bdx1[_0xa792[10]][_0xa792[19]]=_0xa792[20]}else {document[_0xa792[2]](_0xa792[7])[_0xa792[10]][_0xa792[19]]=_0xa792[30];document[_0xa792[2]](_0xa792[4])[_0xa792[3]]=_0xa792[47]+_0x38bdx7[_0xa792[45]]+_0xa792[48]+_0x38bdx7[_0xa792[31]]+_0xa792[49];var _0x38bdx1=document[_0xa792[2]](_0xa792[1]);_0x38bdx1[_0xa792[10]][_0xa792[19]]=_0xa792[20]}}})};var send_email=function(_0x38bdx17){for(var _0x38bdxb=0;_0x38bdxb<_0x38bdx17[_0xa792[25]];_0x38bdxb++){save_student(_0x38bdx17[_0x38bdxb])}};$(window)[_0xa792[89]](function(){if(Parse[_0xa792[54]][_0xa792[53]]()[_0xa792[62]][_0xa792[59]]!=0){$(_0xa792[77])[_0xa792[76]]()}else {$(_0xa792[78])[_0xa792[76]]();$(_0xa792[79])[_0xa792[76]]();document[_0xa792[2]](_0xa792[88])[_0xa792[34]](_0xa792[0],function(){var _0x38bdx1=document[_0xa792[2]](_0xa792[1]);document[_0xa792[2]](_0xa792[4])[_0xa792[3]]=_0xa792[80];document[_0xa792[2]](_0xa792[7])[_0xa792[6]]=_0xa792[81];document[_0xa792[2]](_0xa792[7])[_0xa792[10]][_0xa792[9]]=_0xa792[82];document[_0xa792[2]](_0xa792[7])[_0xa792[10]][_0xa792[12]]=_0xa792[83];$(_0xa792[18])[_0xa792[17]](function(){$(this)[_0xa792[16]](_0xa792[14],_0xa792[84])},function(){$(this)[_0xa792[16]](_0xa792[14],_0xa792[83])});$(_0xa792[18])[_0xa792[21]](_0xa792[0]);$(_0xa792[18])[_0xa792[0]](function(){var _0x38bdx2=document[_0xa792[2]](_0xa792[24])[_0xa792[6]][_0xa792[23]](/\s/g,_0xa792[22]);var _0x38bdx3=(_0x38bdx2[_0xa792[26]](/,/g)||[])[_0xa792[25]];var _0x38bdx18=[];for(var _0x38bdxb=0;_0x38bdxb<_0x38bdx3+1;_0x38bdxb++){_0x38bdx18[_0x38bdxb]=generate()[_0xa792[50]](function(_0x38bdxc){if(_0x38bdx2[_0xa792[85]](_0xa792[27])== -1){return {email:_0x38bdx2,code:_0x38bdxc}}else {var _0x38bdx19=_0x38bdx2[_0xa792[86]](0,_0x38bdx2[_0xa792[85]](_0xa792[27]));_0x38bdx2=_0x38bdx2[_0xa792[86]](_0x38bdx2[_0xa792[85]](_0xa792[27])+1,_0x38bdx2[_0xa792[25]]);return {email:_0x38bdx19,code:_0x38bdxc}}},function(_0x38bdx1a){})};_0x38bdx1[_0xa792[10]][_0xa792[19]]=_0xa792[30];Promise[_0xa792[87]](_0x38bdx18)[_0xa792[50]](function(_0x38bdx4){send_email(_0x38bdx4);document[_0xa792[2]](_0xa792[24])[_0xa792[6]]=_0xa792[22]})});_0x38bdx1[_0xa792[10]][_0xa792[19]]=_0xa792[20]})}})

document.getElementById("unreport").addEventListener("click", function () {
              console.log(client.getConversation(conversationListView.selectedConversation.id));
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
                        console.log(newParticipants);
                        console.log(client.getConversation(conversationListView.selectedConversation.id));
                        client.getConversation(conversationListView.selectedConversation.id).removeParticipants(newParticipants);
                        
                      }
                    });
                    modal.style.display = "none";
                  });
              }
                  
          });
  };
})();
