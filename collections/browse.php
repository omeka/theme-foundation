<?php
$layout = (get_theme_option('item_browse_layout') !== null) ? get_theme_option('item_browse_layout') : 'list';
$thumbnailSize = (get_theme_option('thumbnail_size') !== null) ? get_theme_option('thumbnail_size') : 'square_thumbnail';
$hideThumbnails = (get_theme_option('browse_hide_thumbnails') == 1);
$gridState = ($layout == 'togglegrid') ? 'disabled' : '';
$listState = ($layout == 'togglelist') ? 'disabled': '';
$isGrid = (!isset($layout) || strpos($layout, 'grid') !== false) ? true : false;

$truncateDescription = (get_theme_option('truncate_body_property') !== null) ? get_theme_option('truncate_body_property') : 'full'; 
$pageTitle = __('Browse Collections');
queue_js_file('browse');
echo head(array('title' => $pageTitle, 'bodyclass' => 'collections browse'));
?>

<h1><?php echo $pageTitle; ?> <?php echo __('(%s total)', $total_results); ?></h1>

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
    <div class="top-bar-right">
        <?php if ($total_results > 0): ?>        
        <?php
        $sortLinks[__('Title')] = 'Dublin Core,Title';
        $sortLinks[__('Creator')] = 'Dublin Core,Creator';
        $sortLinks[__('Date Added')] = 'added';
        ?>
        <div id="sort-links">
            <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
        </div>
        
        <?php endif; ?>
    </div>
</div>

<ul class="resources <?php echo ($isGrid) ? 'resource-grid' : 'resource-list'; ?>">

<?php foreach (loop('collections') as $collection): ?>

<li class="collection resource <?php echo ($isGrid) ? '' : 'media-object'; ?>">
    <?php if (($collectionImage = record_image('collection', $thumbnailSize)) && !$hideThumbnails): ?>
    <div class="resource-image <?php echo ($isGrid) ? '' : 'media-object-section'; ?>">
        <?php echo link_to_collection($collectionImage, array('class' => 'thumbnail')); ?>
    </div>
    <?php endif; ?>
    <div class="resource-meta <?php echo ($isGrid) ? '' : 'media-object-section'; ?>">
        <h4>
            <?php echo link_to_collection(); ?>
            <?php if ($hideThumbnails && isset($collectionImage)): ?>
            <span class="has-media" aria-label="<?php echo __('Has media'); ?>" title="<?php echo __('Has media'); ?>"></span>
            <?php endif; ?>
        </h4>
    
        <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
        <div class="collection-description">
            <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet' => 150))); ?>
        </div>
        <?php endif; ?>
        <?php if ($collection->hasContributor()): ?>
        <div class="collection-contributors">
            <p>
            <strong><?php echo __('Contributors'); ?>:</strong>
            <?php echo metadata('collection', array('Dublin Core', 'Contributor'), array('all' => true, 'delimiter' => ', ')); ?>
            </p>
        </div>
        <?php endif; ?>
    
        <?php echo link_to_items_browse(__('View the items in %s', metadata('collection', array('Dublin Core', 'Title'))), array('collection' => metadata('collection', 'id')), array('class' => 'view-items-link')); ?>
    
        <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>
    </div>
    
</li><!-- end class="collection" -->
<?php endforeach; ?>

</ul>

<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_collections_browse', array('collections' => $collections, 'view' => $this)); ?>

<?php echo foot(); ?>
