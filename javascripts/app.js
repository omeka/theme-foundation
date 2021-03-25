(function ($) {
  $(document).ready(function() {
      $('.search-toggle').click(function() {
        $('#search-container').toggleClass('open').toggleClass('closed');
      });

     $('.advanced-toggle').click(function() {
        $('#advanced-form').toggleClass('open');
        $(this).toggleClass('open');

        if ($(this).hasClass('open')) {
          $('#advanced-form input').first().focus();
        }
     });
  });
})(jQuery)