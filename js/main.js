var $ = jQuery;

( function( $ ) {
  var Neu = Neu || {};

  $.fn.formFunctions = function(options) {
      return this.each(function() {
          var formFunctions = Object.create(Neu.formFunctions);
          formFunctions.init(this, options);
      });
  };

  $.fn.formFunctions.options = {
      otherField: ".other"
  };

  Neu.formFunctions = {
      init: function(elem, options) {
          var self = this;
          self.$container = $(elem);
          self.options = $.extend({}, $.fn.formFunctions.options, options);
          self.bindElements();
          self.bindEvents();
      },
      bindElements: function() {
        var self = this;

        self.$otherField = self.$container.find(self.options.otherField);
        self.$otherTextField = self.$otherField.find("input[type='text']");
        self.$select = self.$container.find("select");
    },
    bindEvents: function() {
      var self = this;
      
      self.$select.on("change", function() {
        var selectedVal = $(this).find("option:selected");
        var text = selectedVal.text();
        
        if ( text === "Other") {
          self.$otherField.css("visibility", "visible");
          self.$otherTextField.focus();
        } else {
          self.$otherField.css("visibility", "hidden");
          self.$otherTextField.val("");
        }
      });
    }
  };

}( $ ) );

(function init () {
  $(document).ready(function() {
    $(".flags-form").formFunctions();
  });
})();
