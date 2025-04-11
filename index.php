<?php echo head(array('bodyid' => 'home')); ?>

  <div class="featured-records">
      <!-- Featured Collection -->
      <div class="main featured">
          <?php $mainFeaturedRecordType = (get_theme_option('home_main_featured') !== null) ? ucfirst(get_theme_option('home_main_featured')) : 'item'; ?>
          <?php echo display_records($mainFeaturedRecordType, 1, array(), null, array('thumbnailSize' => 'fullsize')); ?>
      </div><!-- end featured collection -->
      
      
      <div class="supporting featured">
          <?php $secondFeaturedRecordType = (get_theme_option('home_second_featured') !== null) ? ucfirst(get_theme_option('home_second_featured')) : 'item'; ?>
          <?php echo display_records($secondFeaturedRecordType, 1, array(), null, array('thumbnailSize' => 'fullsize')); ?>

          <?php $thirdFeaturedRecordType = (get_theme_option('home_third_featured') !== null) ? ucfirst(get_theme_option('home_third_featured')) : 'item'; ?>
          <?php echo display_records($thirdFeaturedRecordType, 1, array(), null, array('thumbnailSize' => 'fullsize')); ?>
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
