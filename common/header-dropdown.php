<?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
<div class="top-bar">
    <nav class="top-bar-left">
        <div class="title-bar" data-responsive-toggle="primary-nav" data-hide-for="large">
            <button class="menu-toggle" type="button" data-toggle="offCanvas" aria-label="<?php echo $this->translate('Menu'); ?>"><i class="fas fa-bars"></i></button>
        </div>
        <?php echo link_to_home_page(theme_logo(), array('class' => 'site-title', 'title' => "Logo")); ?>
    </nav>
    <nav id="primary-nav" role="navigation" class="top-bar-right">
          <?php echo use_foundation_navigation('dropdown'); ?>
          <button type="button" class="search-toggle button" aria-label="<?php echo __('Search'); ?>"><i class="fas fa-search"></i></button>
    </nav>
</div>