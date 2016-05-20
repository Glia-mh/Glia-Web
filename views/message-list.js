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
      this.$el.append("Your messages will go here");
    },

    render: function(messages) {
      // Tutorial Step 3: Render messages here
      this.$el.empty();

      // NOTE: Do NOT modify the query.data i.e. messages array
      // Create a copy of the array and reverse the order so that most recent message is at the bottom
      var messages = messages.concat().reverse();
      var previousSender = 0;


      this.$el.append(

        //var messageTime = 0;
         // Render each message view
         messages.forEach(function(message) {

          var messageView = new layerSampleApp.Message();

          // //if first message then include the time
          // if (messageTime == 0)
          //   messageView.render(message, 1);
          // //if the dates/times are the same then do not incude the time
          // if (messageTime == this.getSentAt())
          //   messageView.render(message, 0);
          // if (messageTime)
          // messageTime = this.getSentAt(message);

          console.log("sender: " + previousSender);
          messageView.render(message, previousSender);
          previousSender = message.sender.userId;

          this.$el.append(messageView.$el);
        }, this)
      );


      // Make sure the user can see the last message in the list
      this.scrollBottom();
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
