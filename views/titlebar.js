'use strict';
/**
 * The Titlebar View class simply renders the participant names of the selected Conversation.
 * @type {Object}
 */
(function() {
  var layerSampleApp = window.layerSampleApp;
  layerSampleApp.Titlebar = Backbone.View.extend({
    el: '#chat-content-header',

    /**
     * Render the title for the current Conversation.
     * Use the Identity Service's getDisplayName to turn userIds
     * into displayable names.
     */
    render: function(conversation) {
        var title = '';

        if (conversation) {
            title = conversation.metadata.student.name;

        }
        else {
            //Parse.initialize("pya3k6c4LXzZMy6PwMH80kJx4HD2xF6duLSSdYUl", "nsAogGRd3LmObBE5jk1E3pilVTDbPGAEHpTZwvob");
            //title = 'Logged in as: ' + Parse.User.current().attributes.name;
            title= '';
              $("#logo-sidebar").css("display", "none");
              $("#preview-mssg-sidebar").css("display", "none");
              $("#chat-name-sidebar").css("display", "none");
        }

        this.$el.html('<span id="name-chatting-to-header">' + title + '</span>');
    }
  });

  function betterTitle(conversation) {
      return conversation.participants.map(function(userId) {
          return layerSampleApp.Identities.getDisplayName(userId);
      }).join(', ');
  }
})();
