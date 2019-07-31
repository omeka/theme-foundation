<?php
$layout = (get_theme_option('item_browse_layout') !== null) ? get_theme_option('item_browse_layout') : 'list';
$pageTitle = __('Browse Items');
if ($layout == 'grid') {
  queue_js_url('//unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js');  
}
queue_js_file('browse');
$itemTypes = revolution_get_item_type_icons();
$sortedTags = revolution_get_sorted_tags();
echo head(array('title' => $pageTitle, 'bodyclass' => 'items browse ' . $layout));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<nav class="items-nav navigation secondary-nav">
    <div class="top-bar-left">
        <?php echo item_search_filters(); ?>
    </div>
</nav>

<div id="revolution-wrap">
    <div id="revolution-filters">
        <ul>
            <li>Browse by type
                <ul>
                    <?php foreach ($itemTypes as $itemTypeName => $itemTypeClass): ?>
                    <li><a href="<?php echo html_escape(url('items/browse', array('tags' => $itemTypeName))); ?>"><i class="<?php echo $itemTypeClass; ?>"></i> <?php echo $itemTypeName; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li>Browse by chapter
                <ul>
                    <?php foreach ($sortedTags['chapters'] as $chapterTag): ?>
                    <li><a href="<?php echo html_escape(url('items/browse', array('tags' => $chapterTag['name']))); ?>"><?php echo $chapterTag['name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li>Browse by topic
                <ul>
                    <?php foreach ($sortedTags['topics'] as $topicTag): ?>
                    <li><a href="<?php echo html_escape(url('items/browse', array('tags' => $topicTag['name']))); ?>"><?php echo $topicTag['name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
    </div>

<div class="resources">
<div class="browse-controls">
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
      <?php echo pagination_links(); ?>
</div>


<?php if ($layout == 'grid'): ?>
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
            <div class="tags"><span class="tags label"><?php echo __('Tags'); ?></span> <?php echo tag_string('items'); ?></div>
            <?php endif; ?>
        
            <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' => $item)); ?>
        </div>
    </div>
    <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="resource-list list">
    <?php foreach (loop('items') as $item): ?>
    <?php $itemTypeTags = revolution_match_tags($item, $itemTypes); ?>
    <div class="item">
        <?php if (metadata('item', 'has files')): ?>
        <?php echo link_to_item(item_image(), array('class' => 'item-image')); ?>
        <?php endif; ?>
        <div class="item-meta">
        <h2>
            <?php foreach ($itemTypeTags as $itemTypeMatch => $itemTypeTag): ?>
            <i class="<?php echo $itemTypes[$itemTypeTag]; ?>"></i>
            <?php endforeach; ?>
            <?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class' => 'permalink')); ?>
        </h2>

        <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet' => 250))): ?>
        <div class="item-description">
            <?php echo $description; ?>
        </div>
        <?php endif; ?>

        <?php if (metadata('item', 'has tags')): ?>
        <div class="tags"><span class="tags secondary label"><?php echo __('Tags'); ?></span> <?php echo tag_string('item', 'items/browse', ' '); ?></div>
        <?php endif; ?>
        <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' => $item)); ?>
        </div>
    </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="browse-controls">
    <?php echo pagination_links(); ?>
</div>

</div>
</div>


<div id="outputs">
    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
    <?php echo output_format_list(false); ?>
</div>

<?php fire_plugin_hook('public_items_browse', array('items' => $items, 'view' => $this)); ?>

<?php echo foot(); ?>
