<?php
$layout = (get_theme_option('item_browse_layout') !== null) ? get_theme_option('item_browse_layout') : 'list';
$thumbnailSize = (get_theme_option('thumbnail_size') !== null) ? get_theme_option('thumbnail_size') : 'square_thumbnail';
$hideThumbnails = (get_theme_option('browse_hide_thumbnails') == 1);
$gridState = ($layout == 'togglegrid') ? 'disabled' : '';
$listState = ($layout == 'togglelist') ? 'disabled': '';
$isGrid = (!isset($layout) || strpos($layout, 'grid') !== false) ? true : false;

$truncateDescription = (get_theme_option('truncate_body_property') !== null) ? get_theme_option('truncate_body_property') : 'full'; 
$title = __('Browse Exhibits');
queue_js_file('browse');
echo head(array('title' => $title, 'bodyclass' => 'exhibits browse'));
?>
<h1><?php echo $title; ?> <?php echo __('(%s total)', $total_results); ?></h1>
<?php if (count($exhibits) > 0): ?>

<nav class="navigation secondary-nav">
    <?php echo nav(array(
        array(
            'label' => __('Browse All'),
            'uri' => url('exhibits')
        ),
        array(
            'label' => __('Browse by Tag'),
            'uri' => url('exhibits/tags')
        )
    )); ?>
</nav>

<div class="browse-control-mobile">
<button type="button" class="browse-toggle closed">Tools</button>
</div>

<div class="browse-controls closed">
    <div class="top-bar-left">
        <?php echo pagination_links(); ?>
    </div>
    <?php if (strpos($layout, 'toggle') !== false): ?>
    <div class="layout-toggle">
        <button type="button" aria-label="<?php echo __('Grid'); ?>" title="<?php echo __('Grid'); ?>" class="grid o-icon-grid" <?php echo $gridState; ?>></button>
        <button type="button" aria-label="<?php echo __('List'); ?>" title="<?php echo __('List'); ?>" class="list o-icon-list" <?php echo $listState; ?>></button>
    </div>
    <?php endif; ?>
</div>

<ul class="resources <?php echo ($isGrid) ? 'resource-grid' : 'resource-list'; ?>">
<?php foreach (loop('exhibit') as $exhibit): ?>
    <li class="exhibit resource <?php echo ($isGrid) ? '' : 'media-object'; ?>">
        <?php if (($exhibitImage = record_image($exhibit, $thumbnailSize)) && !$hideThumbnails): ?>
        <div class="resource-image <?php echo ($isGrid) ? '' : 'media-object-section'; ?>">
            <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'thumbnail')); ?>
        </div>
        <?php endif; ?>
        <div class="resource-meta <?php echo ($isGrid) ? '' : 'media-object-section'; ?>">
        <h4>
            <?php echo link_to_exhibit(); ?>
            <?php if ($hideThumbnails && isset($exhibitImage)): ?>
            <span class="has-media" aria-label="<?php echo __('Has media'); ?>" title="<?php echo __('Has media'); ?>"></span>
            <?php endif; ?>
        </h4>
        </h4>
        <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
        <div class="description <?php echo $truncateDescription; ?>"><?php echo $exhibitDescription; ?></div>
        <?php endif; ?>
        <?php if ($exhibitTags = tag_string('exhibit', 'exhibits')): ?>
        <p class="tags"><?php echo $exhibitTags; ?></p>
        <?php endif; ?>
        </div>
    </li>
<?php endforeach; ?>
</ul>

<div class="browse-controls">
  <div class="top-bar-left">
    <?php echo pagination_links(); ?>
  </div>
</div>

<?php else: ?>
<p><?php echo __('There are no exhibits available yet.'); ?></p>
<?php endif; ?>

<?php echo foot(); ?>
