<?php
$layout = (get_theme_option('item_browse_layout') !== null) ? get_theme_option('item_browse_layout') : 'list';
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

<div class="browse-controls">
    <div class="top-bar-left">
        <?php echo pagination_links(); ?>
    </div>
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

<?php if ($layout == 'grid'): ?>
    <div id="resource-list" class="grid-x grid-margin-x grid-layout">
    <?php foreach (loop('items') as $item): ?>
    <div class="item cell small-12 medium-6 large-3">
        <?php if (metadata('item', 'has files')): ?>
            <?php echo link_to_item(item_image(), array('class' => 'item-image')); ?>
        <?php endif; ?>    
        <div class="item-meta">
            <h4><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class' => 'permalink')); ?></h4>        
            <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet' => 250))): ?>
            <div class="item-description">
                <?php echo $description; ?>
            </div>
            <?php endif; ?>
            <?php if (metadata('item', 'has tags')): ?>
            <div class="tags"><span class="tags label"><?php echo __('Tags'); ?></span> <?php echo tag_string('items'); ?></div>
            <?php endif; ?>
            <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' => $item)); ?>
        </div>
    </div>
    <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="resource-list list-layout">
    <?php foreach (loop('items') as $item): ?>
    <div class="item">
        <h2><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class' => 'permalink')); ?></h2>
        <?php if (metadata('item', 'has files')): ?>
        <?php echo link_to_item(item_image()); ?>
        <?php endif; ?>
        <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet' => 250))): ?>
        <div class="item-description">
            <?php echo $description; ?>
        </div>
        <?php endif; ?>

        <?php if (metadata('item', 'has tags')): ?>
        <div class="tags"><span class="tags label"><?php echo __('Tags'); ?></span> <?php echo tag_string('items'); ?></div>
        <?php endif; ?>
    
        <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' => $item)); ?>
    </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php echo pagination_links(); ?>

<div id="outputs">
    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
    <?php echo output_format_list(false); ?>
</div>

<?php fire_plugin_hook('public_items_browse', array('items' => $items, 'view' => $this)); ?>

<?php echo foot(); ?>
