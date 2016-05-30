'use strict';
/**
 * The Message List class renders a list of Message Views and insures
 * we stay scrolled to the bottom of the Message List.
 */
(function() {
  var layerSampleApp = window.layerSampleApp;
  layerSampleApp.MessageList = Backbone.View.extend({
    el: '.chat-content-wrapper',
    initialize: function() {

      this.$el.append('<div class="welcome"> <img class="rootsicon" src="../img/teamrootsicon.png"/> <div class="welcometext" id="welcometext">  </div> </div>');
    },

    render: function(messages) {


      // Tutorial Step 3: Render messages here
      this.$el.empty();

      if(messages==null || messages.length==0)
        return;

      // NOTE: Do NOT modify the query.data i.e. messages array
      // Create a copy of the array and reverse the order so that most recent message is at the bottom
      var messages = messages.concat().reverse();
      var previousSender = messages[0].sender.userId;
      console.log(messages);
      var previousTime = messages[0].sentAt;
      // //Append the header with name of coversation
      // this.$el.append(
      //   '<section id="chat-content-header">' +
      //   '<span id="name-chatting-to-header">' + layerSampleApp.Identities.getDisplayName(layerSampleApp.client.userId) + '</span>' +
      //   '</section> '
      // );
      this.$el.append(
          '<div class="container-time">' + this.getSentAt(messages[0]) + '</div>'
      );
      this.$el.append(

         // Render each message view
         messages.forEach(function(message) {

          var messageView = new layerSampleApp.Message();
          
          var diffMs= message.sentAt - previousTime;
         
          var diffHrs = Math.round((diffMs % 86400000) / 3600000); 
          var diffDays = Math.round(diffMs / 86400000);
          
          console.log("Diff Hrs: " + diffHrs);
          console.log("Diff Days: " + diffDays);

          if(diffHrs>1 || diffDays>0){
            this.$el.append(
              '<div class="container-time">' + this.getSentAt(message) + '</div>'
            );
          }
          console.log("sender: " + previousSender);
          if(previousSender!=message.sender.userId)
            this.$el.append(
              '<div class="separator">' +  '</div>'
            );
          messageView.render(message, previousSender);
          previousSender = message.sender.userId;
          previousTime = message.sentAt; 
          

          this.$el.append(messageView.$el);
        }, this)

      );

    
      this.scrollBottom();
      console.log("this runs");
      $(".class-bubble").linkify({
        target: "_blank"
      });
    },
     getSentAt: function(message) {
      var now = new Date();
      var date = message.sentAt;

      if (date.toLocaleDateString() === now.toLocaleDateString()) {
          return date.toLocaleTimeString();
      }
      else {
          return date.toLocaleDateString();
      }
    },



    /**
     * Scroll to the bottom of the list so the most recent Message is visible.
     */
    scrollBottom: function() {
      this.el.scrollTop = this.el.scrollHeight;
    }
  });
})();
