(function ($) {
  var togglePanel = function(event, toggleButton, targetSelector) {
    var targetElement = $(targetSelector);
    targetElement.toggleClass('closed');
    toggleButton.toggleClass('closed');

    if (targetElement.hasClass('closed')) {
      toggleButton.attr('aria-expanded', 'false');
    } else {
      toggleButton.attr('aria-expanded', 'true');
      targetElement.find(':focusable').first().trigger('focus');
    }

    event.stopPropagation();

    $(document).on('click focusin', function(e) {
        if (!$.contains(targetElement[0], e.target) && (e.target !== toggleButton[0])) {
            if (e.type !== 'focusin') {
                toggleButton.trigger('focus');
            }
            toggleButton.attr('aria-expanded', 'false').addClass('closed');
            targetElement.addClass('closed');
            $(document).off(e);
        }
    });

    $(document).on('keydown', function(e) {
        if (e.key == 'Escape') {
            toggleButton.attr('aria-expanded', 'false').trigger('focus');
            targetElement.addClass('closed');
            $(document).off(e);
        };
    });
  };

  $(document).ready(function() {
      $('.horizontal-menu header').on('click', '.search-toggle', function(e) {
          togglePanel(e, $(this), '#search-container');
      });

      $('.vertical-menu header').on('click', '.advanced-toggle', function(e) {
          togglePanel(e, $(this), '#advanced-form');
      });
  });
})(jQuery)