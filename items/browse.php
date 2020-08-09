<?php
$layout = (get_theme_option('item_browse_layout') !== null) ? get_theme_option('item_browse_layout') : 'list';
$gridState = ($layout == 'togglegrid') ? 'disabled' : '';
$listState = ($layout == 'togglelist') ? 'disabled': '';
$isGrid = (!isset($layout) || strpos($layout, 'grid') !== false) ? true : false;

$truncateDescription = (get_theme_option('truncate_body_property') !== null) ? get_theme_option('truncate_body_property') : 'full'; 
$pageTitle = __('Browse Items');
queue_js_file('browse');
echo head(array('title' => $pageTitle, 'bodyclass' => 'items browse ' . $layout));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<nav class="items-nav navigation secondary-nav">
    <div class="top-bar-left">
        <?php echo public_nav_items(); ?>
    </div>
    <div class="top-bar-right">
        <?php echo item_search_filters(); ?>
    </div>
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
        <button type="button" aria-label="Grid" class="grid o-icon-grid" <?php echo $gridState; ?>></button>
        <button type="button" aria-label="List" class="list o-icon-list" <?php echo $listState; ?>></button>        
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
<?php foreach (loop('items') as $item): ?>
<li class="item resource <?php echo ($isGrid) ? '' : 'media-object'; ?>">
    <?php if (metadata('item', 'has files')): ?>
    <div class="resource-image <?php echo ($isGrid) ? '' : 'media-object-section'; ?>">
        <?php echo link_to_item(item_image(), array('class' => 'thumbnail')); ?>
    </div>
    <?php endif; ?>
    <div class="resource-meta <?php echo ($isGrid) ? '' : 'media-object-section'; ?>">
        <h4><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class' => 'permalink')); ?></h4>
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
<div class="browse-controls">
<?php echo pagination_links(); ?>
</div>
<div id="outputs">
    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
    <?php echo output_format_list(false); ?>
</div>

<?php fire_plugin_hook('public_items_browse', array('items' => $items, 'view' => $this)); ?>

<?php echo foot(); ?>
