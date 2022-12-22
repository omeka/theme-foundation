<?php
$layout = (get_theme_option('item_browse_layout') !== null) ? get_theme_option('item_browse_layout') : 'list';
$gridState = ($layout == 'togglegrid') ? 'disabled' : '';
$listState = ($layout == 'togglelist') ? 'disabled': '';
$isGrid = (!isset($layout) || strpos($layout, 'grid') !== false) ? true : false;
$truncateDescription = (get_theme_option('truncate_body_property') !== null) ? get_theme_option('truncate_body_property') : 'full';
queue_js_file('browse');

$collectionTitle = metadata('collection', 'display_title');
$totalItems = metadata('collection', 'total_items');
?>

<?php echo head(array('title' => $collectionTitle, 'bodyclass' => 'collections show')); ?>

<h1><?php echo $collectionTitle; ?></h1>

<?php echo all_element_texts('collection'); ?>

<div id="collection-items">

    <h3><?php echo __('Collection Items'); ?></h3>
    <?php if ($totalItems > 0): ?>
    <div class="browse-control-mobile">
    <button type="button" class="browse-toggle closed">Tools</button>
    </div>

    <div class="browse-controls closed">
        <?php if (strpos($layout, 'toggle') !== false): ?>
        <div class="layout-toggle">
            <button type="button" aria-label="<?php echo __('Grid'); ?>" title="<?php echo __('Grid'); ?>" class="grid o-icon-grid" <?php echo $gridState; ?>></button>
            <button type="button" aria-label="<?php echo __('List'); ?>" title="<?php echo __('List'); ?>" class="list o-icon-list" <?php echo $listState; ?>></button> 
        </div>
        <?php endif; ?>
    </div>
    <ul class="resources <?php echo ($isGrid) ? 'resource-grid' : 'resource-list'; ?>">
        <?php foreach (loop('items') as $item): ?>
            <li class="item resource <?php echo ($isGrid) ? '' : 'media-object'; ?>">
                <?php if (metadata('item', 'has files')): ?>
                    <div class="resource-image <?php echo ($isGrid) ? '' : 'media-object-section'; ?>">
                        <?php echo link_to_item(item_image(), array('class' => 'thumbnail')); ?>
                    </div>
                    <?php endif; ?>
                    <div class="resource-meta <?php echo ($isGrid) ? '' : 'media-object-section'; ?>">
                        <h4><?php echo link_to_item(metadata('item','rich_title', array('no_escape' => true)), array('class' => 'permalink')); ?></h4>
                        <?php if ($description = metadata('item', array('Dublin Core', 'Description'))): ?>
                            <div class="description <?php echo $truncateDescription; ?>"><?php echo $description; ?></div>
                            <?php endif; ?>
                            <?php if (metadata('item', 'has tags')): ?>
                                <div class="tags"><span class="tags label"><?php echo __('Tags'); ?></span> <?php echo tag_string('items'); ?></div>
                                <?php endif; ?>    
            <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' => $item)); ?>
        </div>
    </li>
    <?php endforeach; ?>
    </ul>
    <div id="item-list-footer">
        <?php echo link_to_items_browse(__(plural('View item', 'View all %s items', $totalItems), $totalItems), array('collection' => metadata('collection', 'id')), array('class' => 'view-items-link')); ?>
    </div>
</div><!-- end collection-items -->
<?php else: ?>
    <p><?php echo __('You have no items.'); ?></p>
<?php endif; ?>

<?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>

<?php echo foot(); ?>
