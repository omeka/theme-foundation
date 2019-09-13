(function ($) {
  $(window).load(function() {
      // Get tag search from URL
      // Set tag search to variable
      // Activate filters based on existence in tag search
    
      var filters = $('#revolution-filters');
      var originalFilters = filters.data('current-filters');
      var applyFiltersButton = $('.apply-filters');
      var itemBrowseBaseUrl = applyFiltersButton.attr('href').concat('?tags=');
      var newFilters = (originalFilters !== '') ? originalFilters.split(',') : [];

      $('.revolution-filter').click(function(e) {
        var currentFilter = $(this);
        e.preventDefault();
        currentFilter.toggleClass("expand collapse");
        currentFilter.find('i').first().toggleClass('fa-caret-right fa-caret-down');
      });
      
      $('#revolution-filters ul ul a').click(function(e) {
        e.preventDefault();
        var currentFilter = $(this);
        var currentFilterName = currentFilter.data('filter');
        currentFilter.toggleClass('active');
        if (currentFilter.hasClass('active') && ($.inArray(currentFilterName, newFilters) < 0)) {
          newFilters.push(currentFilterName);
        } else {
          newFilters = $.grep(newFilters, function(value) {
            return value != currentFilterName;
          });
        }
        applyFiltersButton.addClass('active');
        applyFiltersButton.attr('href', itemBrowseBaseUrl.concat(newFilters.join()));
      });
  });
})(jQuery)