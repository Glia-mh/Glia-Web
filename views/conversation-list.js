'use strict';
/**
 * The ConversationList Class renders a list of Conversations and allows the user
 * to select or delete Conversations.
 */
(function() {
  var layerSampleApp = window.layerSampleApp;
  layerSampleApp.ConversationList = Backbone.View.extend({
    el: '.sidebar',

    initialize: function() {
      this.$el.append("Your conversation list goes here");
    },

    betterTitle: function(participants) {
        return participants.map(function(userId) {
            return layerSampleApp.Identities.getDisplayName(userId);
        }).join(', ');
    },

    buildConversationRow: function(conversation) {
      var title = this.betterTitle(conversation.participants);
      var cssClasses = ['user'];

      // Highlight the selected Conversation
      if (this.selectedConversation && conversation.id === this.selectedConversation.id) {
          cssClasses.push('selected-user');
      }

      // Tutorial Step 5: Add Unread Message Highlighting
      if (conversation.unreadCount) {
        cssClasses.push('unread-messages');
      }

      console.log("hello " + title);

      var row = $('<div/>', { class: cssClasses.join(' ') });
      row.append(
        '<section class = "user">' +
        '<img src = "../img/id-logo.jpg" id = "id-logo"> <span id = "chat-name">' + 
        title + 
        '</span> ' +  '<span class = "time">' + 'Time' + '</span>' + '<br>' + '<span id= "preview-mssg">' + 'This is the preview...' + '</span>' +
  '</section>');

      // Click handler to trigger an event when each conversation is selected
      row.on('click', function(evt) {
          this.trigger('conversation:selected', conversation.id);
      }.bind(this));

      return row;
    },


    render: function(conversations) {
      if (conversations) this.conversations = conversations;
      this.$el.empty();

      // Iterate through conversations and append HTML Rows
      this.conversations.forEach(function(conversation) {
          var row = this.buildConversationRow(conversation);
          this.$el.append(row);
      }, this);
    }
  });
})();
