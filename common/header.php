<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($author = option('author')): ?>
    <meta name="author" content="<?php echo $author; ?>" />
    <?php endif; ?>
    <?php if ($copyright = option('copyright')): ?>
    <meta name="copyright" content="<?php echo $copyright; ?>" />
    <?php endif; ?>
    <?php if ( $description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    <meta name="generator" content="Zurb Foundation 6" class="foundation-mq">
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
    $banner = get_theme_option('banner');
    $bannerWidth = (get_theme_option('banner_width')) ? get_theme_option('banner_width') : '';
    $bannerHeight = get_theme_option('banner_height_desktop');
    if (!isset($bannerHeight) || $bannerHeight == '') {
        $bannerHeight = 'auto';
    }
    $bannerHeightMobile = get_theme_option('banner_height_mobile');
    if (!isset($bannerHeightMobile) || $bannerHeightMobile == '') {
        $bannerHeightMobile = 'auto';
    }
    $bannerPosition = (get_theme_option('banner_position')) ? str_replace('_','-', get_theme_option('banner_position')) : 'center';
    queue_css_file(array('iconfonts'));
    queue_css_file($stylesheetOption);
    queue_css_string('
        .banner {
            height: ' .  $bannerHeight . ';
            background-position: ' . $bannerPosition . ';
        }

        @media screen and (max-width:640px) {
            .banner {
                height: ' . $bannerHeightMobile . ';
            }
        }'
    );
    echo head_css();

    echo theme_header_background();
    ?>

    <!-- JavaScripts -->
    <?php
    queue_js_file(array('globals', 'app'));
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
    <header aria-label="<?php echo __('Header'); ?>">
        <?php if ($navLayout !== 'vertical'): ?>
            <?php echo common('header-dropdown'); ?>
        <?php else: ?>
            <?php echo common('header-vertical'); ?>
        <?php endif; ?>
        <?php if ($banner): ?>
        <div class="banner <?php echo $bannerWidth; ?>" style="background-image:url(<?php echo foundation_theme_banner(); ?>)">
        </div>
        <?php endif; ?>
        <div id="search-container" class="grid-x closed">
            <?php if (get_theme_option('use_advanced_search') === null || get_theme_option('use_advanced_search')): ?>
            <?php echo search_form(array('show_advanced' => true, 'form_attributes' => array('role' => 'search'))); ?>
            <?php else: ?>
            <?php echo search_form(array('form_attributes' => array('role' => 'search'))); ?>
            <?php endif; ?>
        </div>
    </header>


    <div id="content" role="main" aria-label="<?php echo __('Content'); ?>">
        <?php echo link_to_home_page(theme_logo(), array('class' => 'site-title print-only', 'title' => "Logo")); ?>
        <div class="grid-container">
        <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
