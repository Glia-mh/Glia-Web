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
      this.$el.append('<input class="button" type="button" id="send-button" value="Send"/>')
      this.$el.find('textarea').on('keypress', this.inputAction.bind(this));
      this.$el.find('input').on('click', this.inputActionButton.bind(this));
      var observe;
        if (window.attachEvent) {
          observe = function (element, event, handler) {
            element.attachEvent('on'+event, handler);
          };
        }
        else {
          observe = function (element, event, handler) {
            element.addEventListener(event, handler, false);
          };
        }
        function initTextAreaChange () {
          alert("hi");
          var text = document.getElementById('comments');
          function resize () {
            text.style.height = 'auto';
            text.style.height = text.scrollHeight+'px';
            console.log(text.scrollHeight+'px');
          }
          /* 0-timeout to get the already changed text */
          function delayedResize () {
            window.setTimeout(resize, 0);
          }
          observe(text, 'change',  resize);
          observe(text, 'cut',     delayedResize);
          observe(text, 'paste',   delayedResize);
          observe(text, 'drop',    delayedResize);
          observe(text, 'keydown', delayedResize);

          text.focus();
          text.select();
          resize();
        }

      initTextAreaChange();
      /*var thisAnonFunc= this;
      $("#send-button").click(function() {
          console.log("Send button pressed");
          console.log("Input Action:" + thisAnonFunc.inputAction);
          thisAnonFunc.inputAction.bind(this);
      });*/
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
    inputActionButton: function(e) {
      //var e=this.$el.find('textarea');
      var text = document.getElementById('comments').value.trim();
      if (!text) return true;

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