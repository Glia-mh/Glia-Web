'use strict';
/**
 * The MessageComposer class lets the user type in a message and hit Send
 */
(function() {
  window.layerSampleApp.MessageComposer = Backbone.View.extend({
    el: '.class-message-box-container',

    /**
     * Render the static content: Render the input
     */
    initialize: function() {
      this.$el.append('<textarea id="comments" class="message-box txtstuff" class="common" placeholder="Enter a message..."></textarea>');
      this.$el.append('<input type="submit" class="button" id="send-button" value="Send"/>')
      this.$el.find('textarea').on('keypress', this.inputAction.bind(this));
    },

    /**
     * Handle each keypress; keyCode of 13 means ENTER key,
     * on ENTER: trigger an event to send the message.
     */
    inputAction: function(e) {
      var text = e.target.value.trim();
      if (e.keyCode !== 13 || !text) return true;

      this.trigger('message:new', text);
      console.log("entered");
      this.clear();
    },

    /**
     * Clear the text and insure focus remains on the input
     */
    clear: function() {
      this.$el.find('textarea').val('').focus();
    }
  });
})();