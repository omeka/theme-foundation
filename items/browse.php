<?php
$pageTitle = __('Browse Items');
queue_js_url('//unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js');
queue_js_file('browse');
echo head(array('title' => $pageTitle, 'bodyclass' => 'items browse'));
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

<div id="resource-list" class="grid-x grid-margin-x">
    <?php foreach (loop('items') as $item): ?>
    <div class="item card cell small-12 medium-6 large-3">
        <div class="card-divider">
            <h2><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class' => 'permalink')); ?></h2>
        </div>
        <?php if (metadata('item', 'has files')): ?>
            <?php echo link_to_item(item_image()); ?>
        <?php endif; ?>
    
        <div class="item-meta card-section">
        
            <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet' => 250))): ?>
            <div class="item-description">
                <?php echo $description; ?>
            </div>
            <?php endif; ?>
        
            <?php if (metadata('item', 'has tags')): ?>
            <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
                <?php echo tag_string('items'); ?></p>
            </div>
            <?php endif; ?>
        
            <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' => $item)); ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php echo pagination_links(); ?>

<div id="outputs">
    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
    <?php echo output_format_list(false); ?>
</div>

<?php fire_plugin_hook('public_items_browse', array('items' => $items, 'view' => $this)); ?>

<?php echo foot(); ?>
