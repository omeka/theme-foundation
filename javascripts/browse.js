(function($) {
    $(document).ready(function() {
        $('.layout-toggle button').click(function() {
            $('.layout-toggle button:disabled').removeAttr('disabled');
            $(this).attr('disabled', true);
            $('.resources').toggleClass('resource-list').toggleClass('resource-grid');
            $('.resources .resource').toggleClass('media-object');
            $('.resource-meta, .resource-image').toggleClass('media-object-section');
        });
        
        $('.browse-toggle').click(function() {
            var browseToggle = $(this);
            $('.browse-controls').toggleClass('closed');
            browseToggle.toggleClass('closed');
            if (browseToggle.attr('aria-expanded') == 'true') {
                browseToggle.attr('aria-expanded', 'false');
            } else {
                browseToggle.attr('aria-expanded', 'true');
            }
        });
    });
})(jQuery)