
/**
 * The ConversationList Class renders a list of Conversations and allows the user
 * to select or delete Conversations.
 */
(function() {
  var treenameA = ["Red", "Green", "Blue", "Purple", "Orange", "Yellow", "Violet", "Pink", "Gray", "Brown", "Cyan", "Crimson" , "Gold" , "Silver" , "Teal" , "Azure", "Turquoise", "Lavender", "Maroon", "Tan", "Magenta" , "Indigo" , "Jade" , "Scarlet", "Amber"];
  var treenameB = ["Acacia", "Aspen" , "Beech" , "Birch" , "Cedar" , "Cypress", "Ebony", "Elm" , "Eucalyptus", "Fir", "Grove" , "Hazel" ,  "Juniper" , "Maple", "Oak" , "Palm", "Poplar", "Pine" , "Sequoia" ,  "Spruce", "Sycamore", "Sylvan",  "Walnut", "Willow", "Yew"];
  var treeNames=[];
  var layerSampleApp = window.layerSampleApp;
  layerSampleApp.ConversationList = Backbone.View.extend({
    el: '.sidebar',

    initialize: function() {
       
    },
    getSelectedConversation: function(){
      return this.selectedConversation;
    },

    betterTitle: function(participants) {
        return participants.map(function(userId) {
            return layerSampleApp.Identities.getDisplayName(userId);
        }).join(', ');
    },

    getSentAt: function(message) {
      if(message!=null){
        var now = new Date();
        var date = message.sentAt;

        if (date.toLocaleDateString() === now.toLocaleDateString()) {
            return date.toLocaleTimeString();
        }
        else {
            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
        }
      }
    },
    checkifSelectedConversation: function(conversation){
      if(this.selectedConversation)
        return conversation.id===this.selectedConversation.id;
      else 
        return false;
    },
    removeFromTreeNames: function(treeName){
      if (!Array.prototype.remove) {
        Array.prototype.remove = function(val) {
          var i = this.indexOf(val);
          return i>-1 ? this.splice(i, 1) : [];
        };
      }

      treeNames.remove(treeName);
    },
    setStudentName: function(conversations, conversation){
      
      if(conversations.length != treeNames.length + 1)
        conversations.forEach(function(conversation){
          if(treeNames.indexOf(conversation.metadata.student.name)==-1 && conversation.metadata.student.name!="")
              treeNames.push(conversation.metadata.student.name);
        });
      var randomName = treenameA[Math.floor(Math.random() * treenameA.length)] + " " + treenameB[Math.floor(Math.random() * treenameB.length)];
      
      while(treeNames.indexOf(randomName)!=-1) {
          randomName = treenameA[Math.floor(Math.random() * treenameA.length)] + " " + treenameB[Math.floor(Math.random() * treenameB.length)];
      }
      
      treeNames.push(randomName);
      conversation.setMetadataProperties({
        'student.name': randomName
      });
    },
    

    getMessageText: function(message) {
      if(message!=null){
        return message.parts.filter(function(part) {
            return part.mimeType === 'text/plain';
        }).map(function(part) {
            return part.body;
        }).join('<br/>');
      }
    },
    
    buildConversationRow: function(conversation) {

      var metadata=conversation.metadata;
      var title = metadata.student.name;
      //console.log(metadata);
      var cssClasses = ['user'];
      var innerTextClasses = "";

      
      // Tutorial Step 5: Add Unread Message Highlighting
      if (conversation.unreadCount != 0) {
        cssClasses.push('.unread-messages');
        innerTextClasses="unread-messages";
      }



      

      var currentUser=Parse.User.current();


      var row;


      if(currentUser.attributes.counselorType==="0"){


        title=metadata.student.ID  + ", " + metadata.counselor.name;
        
        // Highlight the selected Conversation
        if (this.selectedConversation && conversation.id === this.selectedConversation.id) {
            cssClasses.push('user selected-user');
            $("#logo-sidebar").css("display", "block");
            //$("#preview-mssg-sidebar").css("display", "inline");
            $("#chat-name-sidebar").css("display", "inline-block");
            $('#chat-name-sidebar').html(title);
            $("#logo-sidebar").attr("src", conversation.metadata.counselor.avatarString);
            //$('#preview-mssg-sidebar').html('');
        }

        var latestMessage= conversation.lastMessage;
        
        row = $('<div/>', { class: cssClasses.join(' ') });
        row.append(
          '<section class = "user">' +
          '<div class= "circle-crop"> <img src = "'+ metadata.counselor.avatarString +'" class="logo"> </div> <span  class="chat-name ' +  innerTextClasses + ' ">' + 
          title + 
          '</span> ' +  '<span class = "time">' + this.getSentAt(latestMessage) + '</span>' + '<br>' + '<span  class="preview-mssg ' +  innerTextClasses + '">' + this.getMessageText(latestMessage) + '</span>' +
          '</section>');
      } else {


          // Highlight the selected Conversation
        if (this.selectedConversation && conversation.id === this.selectedConversation.id) {
            cssClasses.push('user selected-user');
            $("#logo-sidebar").css("display", "block");
            //$("#preview-mssg-sidebar").css("display", "inline");
            $("#chat-name-sidebar").css("display", "inline-block");
            $('#chat-name-sidebar').html(title);
            $("#logo-sidebar").attr("src", conversation.metadata.student.avatarString);
            //$('#preview-mssg-sidebar').html('');
        }

        var latestMessage= conversation.lastMessage;
              
              var row = $('<div/>', { class: cssClasses.join(' ') });
              row.append(
                '<section class = "user">' +
                '<div class= "circle-crop"> <img src = "'+ metadata.student.avatarString +'" class="logo"> </div> <span  class="chat-name ' +  innerTextClasses + ' ">' + 
                title + 
                '</span> ' +  '<span class = "time">' + this.getSentAt(latestMessage) + '</span>' + '<br>' + '<span  class="preview-mssg ' +  innerTextClasses + '">' + this.getMessageText(latestMessage) + '</span>' +
          '</section>');


      }





      

      

      

      // Click handler to trigger an event when each conversation is selected
      row.on('click', function(evt) {
          this.trigger('conversation:selected', conversation.id);
      }.bind(this));

      return row;
    },


    render: function(conversations) {
      var prependBool=false;
      if (conversations) this.conversations = conversations;
      //console.log("conversations length: " + this.conversations.length);
      this.conversations.forEach(function(conversation){
        if(conversation.metadata!=null) {
          if(conversation.metadata.student.name==""){
            prependBool=true;
            this.setStudentName(this.conversations, conversation);
          } else {
            if(treeNames.indexOf(conversation.metadata.student.name)==-1)
              treeNames.push(conversation.metadata.student.name);
          }
        }
      }, this);
      
      
      if (!prependBool) {
        this.$el.empty();
        // Iterate through conversations and append HTML Rows
        this.conversations.forEach(function(conversation) {
            if(conversation.participants.length!=0) {
              var row = this.buildConversationRow(conversation);
              this.$el.append(row);
            }
        }, this);
      } else { //prepend was added for efficiency but may cause problems on simultaneous messages or other edge cases, if so 
              //use web sdk tutorial app by layer for reference 
        if(this.conversations[0].participants.length!=0) {
          this.$el.prepend(this.buildConversationRow(this.conversations[0]));
        }
      }
      
    }
  });
})();
