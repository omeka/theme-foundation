<?php echo head(array('bodyid' => 'home')); ?>

<div class="grid-container">
  <div class="featured-records">
      <?php if (get_theme_option('Display Featured Collection') !== '0'): ?>
      <!-- Featured Collection -->
      <div class="main featured">
          <?php echo foundation_random_featured_records_html('collection'); ?>
      </div><!-- end featured collection -->
      <?php endif; ?>
      
      
      <div class="supporting featured">
      <?php if (get_theme_option('Display Featured Item') !== '0'): ?>
      <!-- Featured Item -->    <?php echo foundation_random_featured_records_html('item'); ?>
      <?php endif; ?>
      
      <?php if ((get_theme_option('Display Featured Exhibit') !== '0')
              && plugin_is_active('ExhibitBuilder')
              && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
      <!-- Featured Exhibit -->
      <div id="featured-exhibit">
        <?php echo foundation_random_featured_records_html('exhibit'); ?>
      </div>
      <?php endif; ?>
      </div>
  </div>
  
  <?php if (get_theme_option('Homepage Text')): ?>
      <?php $introBg = (get_theme_option('Homepage Intro Background') ? 'style="background-image:url(' . foundation_homepage_intro_background() . ')"' : '' ); ?>
      <div id="intro" class="text-center" <?php echo $introBg; ?>>
          <?php echo get_theme_option('Homepage Text'); ?>
      </div>
      <hr>
  <?php endif; ?>
  
  <?php
  $recentItems = get_theme_option('Homepage Recent Items');
  if ($recentItems === null || $recentItems === ''):
      $recentItems = 6;
  else:
      $recentItems = (int) $recentItems;
  endif;
  if ($recentItems):
  ?>
  <div class="supporting-content">
      <h2 class="text-center"><?php echo __('Recently Added Items'); ?></h2>
      <hr>
      <div class="recent-items">
          <?php echo recent_items($recentItems); ?>
          <p class="view-items-link"><a href="<?php echo html_escape(url('items')); ?>"><?php echo __('View All Items'); ?></a></p>
      </div>
      <div class="other">
        <div class="item total">
          <span class="count"><?php echo total_records('item'); ?></span> <?php echo __('items'); ?>
        </div>
        <div class="collection total">
          <span class="count"><?php echo total_records('collections'); ?></span> <?php echo __('collections'); ?>
        </div>
        <?php if (plugin_is_active('ExhibitBuilder')): ?>
        <div class="exhibit total">
          <span class="count"><?php echo total_records('exhibits'); ?></span> <?php echo __('exhibits'); ?>
        </div>
        <?php endif; ?>
      </div>
  </div><!--end recent-items -->
  <?php endif; ?>
  
  <?php fire_plugin_hook('public_home', array('view' => $this)); ?>
  
  <?php echo foot(); ?>
</div>