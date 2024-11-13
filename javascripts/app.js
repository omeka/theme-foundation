(function ($) {
  var togglePanel = function(toggleButton, targetSelector) {
    var targetElement = $(targetSelector);
    targetElement.toggleClass('open').toggleClass('closed');
    toggleButton.toggleClass('open').toggleClass('closed');

    if (targetElement.hasClass('open')) {
      toggleButton.attr('aria-expanded', 'true');
      targetElement.find(':focusable').first().focus();
    } else {
      toggleButton.attr('aria-expanded', 'false');
    }
  };

  $(document).ready(function() {
      $(document).on('click', '.search-toggle', function() {
        togglePanel($(this), '#search-container');
      });

      $(document).on('click', '.advanced-toggle', function() {
        togglePanel($(this), '#advanced-form');
      });
  });
})(jQuery)