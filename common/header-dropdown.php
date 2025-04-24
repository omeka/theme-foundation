<?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
<div class="top-bar">
    <div class="top-bar-left">
        <nav class="title-bar" data-responsive-toggle="primary-nav" data-hide-for="large" aria-label="<?php echo $this->translate('Mobile navigation'); ?>">
            <button class="menu-toggle" type="button" data-toggle="offCanvas" aria-label="<?php echo $this->translate('Menu'); ?>"><i class="fas fa-bars"></i></button>
        </nav>
        <div class="site-title">
            <?php echo link_to_home_page(theme_logo(), array('class' => 'site-title hide-for-small-only', 'title' => "Logo")); ?>
            <?php echo link_to_home_page(foundation_mobile_theme_logo(), array('class' => 'show-for-small-only', 'title' => "Logo")); ?>
        </div>
    </div>
    <nav id="primary-nav" class="top-bar-right" aria-label="<?php echo $this->translate('Main'); ?>">
        <div class="flex-fix">
          <?php echo use_foundation_navigation('dropdown'); ?>
        </div>
    </nav>
    <button type="button" class="search-toggle closed button" aria-controls="search-form" aria-expanded="false" aria-label="<?php echo __('Search'); ?>"><i class="fas fa-search"></i></button>
</div>