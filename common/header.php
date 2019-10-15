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
    queue_css_file('app');
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
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <a href="#content" id="skipnav"><?php echo __('Skip to main content'); ?></a>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <header role="banner">
        <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
        <div id="site-title" class="top-bar-left"><?php echo link_to_home_page(theme_logo()); ?></div>
        <nav id="primary-nav" role="navigation" class="top-bar-right">
              <?php echo use_foundation_navigation(); ?>
              <button type="button" class="search-toggle button" aria-label="<?php echo __('Search'); ?>"><i class="fas fa-search"></i></button>
        </nav>
    </header>

    <div id="search-container" role="search" class="closed">
        <?php if (get_theme_option('use_advanced_search') === null || get_theme_option('use_advanced_search')): ?>
        <?php echo search_form(array('show_advanced' => true, 'form_attributes' => array('class' => 'grid-x'))); ?>
        <?php else: ?>
        <?php echo search_form(); ?>
        <?php endif; ?>
    </div>

    <div id="content" role="main" tabindex="-1">


        <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
