<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( $description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->

    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>


    <!-- Stylesheets -->
    <?php
    $stylesheetOption = (get_theme_option('stylesheet')) ? get_theme_option('stylesheet') : 'default';
    queue_css_file(array('iconfonts'));
    queue_css_file($stylesheetOption);
    echo head_css();

    echo theme_header_background();
    ?>

    <!-- JavaScripts -->
    <?php
    queue_js_file(array('globals', 'app'));
    queue_js_url('//kit.fontawesome.com/22a8f33cc1.js');
    queue_js_url('//cdn.jsdelivr.net/npm/foundation-sites@6.5.3/dist/js/foundation.min.js', array(
      'integrity' => 'sha256-/PFxCnsMh+nTuM0k3VJCRch1gwnCfKjaP8rJNq5SoBg= sha384-9ksAFjQjZnpqt6VtpjMjlp2S0qrGbcwF/rvrLUg2vciMhwc1UJJeAAOLuJ96w+Nj sha512-UMSn6RHqqJeJcIfV1eS2tPKCjzaHkU/KqgAnQ7Nzn0mLicFxaVhm9vq7zG5+0LALt15j1ljlg8Fp9PT1VGNmDw==',
      'crossorigin' => 'anonymous',
    ));
    echo head_js();
    ?>
</head>
<?php $navLayout = get_theme_option('navigation_layout'); ?>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass . ' ' . $navLayout . '-menu')); ?>
    <a href="#content" id="skipnav"><?php echo __('Skip to main content'); ?></a>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <div id="offCanvas" class="off-canvas position-left" data-off-canvas>
        <?php echo use_foundation_navigation('vertical'); ?>
    </div>
    <div class="off-canvas-content" data-off-canvas-content>
    <header role="banner">
    <?php if ($navLayout !== 'vertical'): ?>
        <?php echo common('header-dropdown'); ?>
    <?php else: ?>
        <?php echo common('header-vertical'); ?>
    <?php endif; ?>
    </header>

    <div id="search-container" role="search" class="closed">
        <?php if (get_theme_option('use_advanced_search') === null || get_theme_option('use_advanced_search')): ?>
        <?php echo search_form(array('show_advanced' => true, 'form_attributes' => array('class' => 'grid-x'))); ?>
        <?php else: ?>
        <?php echo search_form(); ?>
        <?php endif; ?>
    </div>

    <div id="content" role="main">


        <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
