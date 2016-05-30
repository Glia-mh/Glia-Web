'use strict';
/**
 * The MessageView Class renders a single Message which consists of
 * * Sender: Displayable name of the participant or service that sent the Message
 * * Read Status: Has the Message been read by none, some or all recipients
 * * Sent Date: Today's time, or prior days date + time
 * * Message Text: What was said
 */
(function() {
  var layerSampleApp = window.layerSampleApp;
  layerSampleApp.Message = Backbone.View.extend({
    tagName: 'div',
    className: 'message-item',

    getSentAt: function(message) {
      var now = new Date();
      var date = message.sentAt;

      if (date.toLocaleDateString() === now.toLocaleDateString()) {
          return date.toLocaleTimeString();
      }
      else {
          return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
      }
    },


    getSenderName: function(message) {
      if (message.sender.name) {
        return message.sender.name;
      } else {
        return layerSampleApp.Identities.getDisplayName(message.sender.userId);
      }
    },


    getMessageText: function(message) {
      return message.parts.filter(function(part) {
          return part.mimeType === 'text/plain';
      }).map(function(part) {
          return part.body;
      }).join('<br/>');
    },


    getMessageStatus: function(message) {
      var status = '';
      if (message.sender.userId === layerSampleApp.client.userId) {
          switch (message.readStatus) {
            case layer.Constants.RECIPIENT_STATE.NONE:
              status = 'unread';
              break;
            case layer.Constants.RECIPIENT_STATE.SOME:
              status = 'read by some';
              break;
            case layer.Constants.RECIPIENT_STATE.ALL:
              status = 'read';
              break;
            default:
              status = 'unread';
              break;
          }
      }
      return '<span class="message-status">' + status + '</span>';
    },



    /**
     * Render the Message.
     */
    render: function(message, prevSenderId) {

      if(prevSenderId != message.sender.userId) {
        console.log("entered the clear div");
        this.$el.append(
          '<div class="clear">' + '</div>'
        );
      }
      

      if(Parse.User.current().attributes.counselorType!=0) {
        if (message.sender.userId == layerSampleApp.client.userId) {
          this.$el.append(
            '<section class="class-chat-list-container class-from-me">' +
            '<div class="class-bubble">' + this.getMessageText(message) + '</div>' + 
            '</section>' + '<div class="clear">' + '</div>'
          );

        } else {
          this.$el.append(
            '<section class="class-chat-list-container class-from-them">' +
            '<div class="class-bubble">' + this.getMessageText(message) + '</div>' + 
            '</section>' + '<div class="clear">' + '</div>'
          );
        }
      } else {
        if (message.sender.userId == layerSampleApp.client.getConversation(message.conversationId).metadata.counselor.ID) {
          
          
          this.$el.append(
            '<section class="class-chat-list-container class-from-me">' +
            '<div class="class-bubble">' + this.getMessageText(message) + '</div>' + 
            '</section>' + '<div class="clear">' + '</div>'
          );
        } else if (message.sender.userId == layerSampleApp.client.getConversation(message.conversationId).metadata.student.ID) {
          this.$el.append(
            '<section class="class-chat-list-container class-from-them">' +
            '<div class="class-bubble">' + this.getMessageText(message) + '</div>' + 
            '</section>' + '<div class="clear">' + '</div>'
          );
        }
      }
      message.isRead = true;
    }

  });
})();
