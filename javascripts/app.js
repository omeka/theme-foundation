(function ($) {
  $(document).ready(function() {
      $('.search-toggle').click(function() {
        $('#search-container').toggleClass('open').toggleClass('closed');
      })
  });
})(jQuery)