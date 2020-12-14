(function ($) {
  $(document).ready(function() {
      $('.search-toggle').click(function() {
        $('#search-container').toggleClass('open').toggleClass('closed');
      })
      
      $('#skipnav').keydown(function(e) {
        if (e.keyCode == 13) {
            $('#content').attr('tabindex', '-1').focus();
        }
      });
      
      $('#content').on('blur focusout', function() {
        $(this).removeAttr('tabindex');
      });
  });
})(jQuery)