<?php 
$pageTitle = get_theme_option('Homepage Title');
if (!isset($pageTitle) || $pageTitle == '') {
  $pageTitle = sprintf(__('Welcome to %s'), option('site_title'));
}
$backgroundColor = ((get_theme_option('homepage_background_color') !== null) && (get_theme_option('homepage_background_color') !== '')) ? get_theme_option('homepage_background_color') : 'FFFFFF';
$backgroundImage = ((get_theme_option('homepage_background') !== null) && get_theme_option('homepage_background') !== '') ? "url('" . foundation_homepage_intro_background() . "')" : '';
queue_css_string("#intro { background: center/cover $backgroundImage $backgroundColor; }");
?>
<?php echo head(array('bodyid' => 'home')); ?>

  <div id="intro">
      <h1><?php echo $pageTitle; ?></h1>
      <?php echo get_theme_option('Homepage Text'); ?>
  </div>

  <div class="featured-records">
      <?php $mainFeaturedRecordType = (get_theme_option('home_main_featured') !== null) ? get_theme_option('home_main_featured') : 'item'; ?>
      <!-- Featured Collection -->
      <div class="main featured">
          <?php if (($mainFeaturedRecordType == 'exhibit') && !plugin_is_active('ExhibitBuilder')): ?>
            <?php echo __('Exhibit Builder is not installed.'); ?>
          <?php else: ?>
            <?php echo foundation_random_featured_records_html($mainFeaturedRecordType); ?>
          <?php endif; ?>
      </div><!-- end featured collection -->
      
      
      <div class="supporting featured">
          <?php $secondFeaturedRecordType = (get_theme_option('home_second_featured') !== null) ? get_theme_option('home_second_featured') : 'item'; ?>
          <!-- Featured Collection -->
          <?php if (($secondFeaturedRecordType == 'exhibit') && !plugin_is_active('ExhibitBuilder')): ?>
            <?php echo __('Exhibit Builder is not installed.'); ?>
          <?php else: ?>
            <?php echo foundation_random_featured_records_html($secondFeaturedRecordType); ?>
          <?php endif; ?>

          <?php $thirdFeaturedRecordType = (get_theme_option('home_third_featured') !== null) ? get_theme_option('home_third_featured') : 'item'; ?>
          <!-- Featured Collection -->
          <?php if (($thirdFeaturedRecordType == 'exhibit') && !plugin_is_active('ExhibitBuilder')): ?>
            <?php echo __('Exhibit Builder is not installed.'); ?>
          <?php else: ?>
            <?php echo foundation_random_featured_records_html($thirdFeaturedRecordType); ?>
          <?php endif; ?>
      </div>
  </div>

  <hr>
  
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
