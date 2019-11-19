<?php
$pageTitle = __('Browse Items');
queue_js_file('browse');
$itemTypes = revolution_get_item_type_icons();
$sortedTags = revolution_get_sorted_tags();
$currentTags = revolution_get_current_tags();
$filterState = ($currentTags !== '') ? 'collapse' : 'expand';
echo head(array('title' => $pageTitle, 'bodyclass' => 'items browse '));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<nav class="items-nav navigation secondary-nav">
    <div class="top-bar-left"><?php echo item_search_filters(); ?></div>
</nav>

<div id="revolution-wrap">
    <div id="revolution-filters" data-current-filters="<?php echo $currentTags; ?>">
      
        <h2>Filter by</h2>
        <ul>
            <li><a href="#" class="revolution-filter <?php echo $filterState; ?>">Type <i class="fas fa-caret-right"></i></a>
                <ul>
                    <?php foreach ($itemTypes as $itemTypeName => $itemTypeClass): ?>
                    <?php $activeClass = (strpos($currentTags, $itemTypeName) !== false) ? 'class="active"' : ''; ?>
                    <li><a href="#" <?php echo $activeClass; ?> data-filter="<?php echo $itemTypeName; ?>"><i class="<?php echo $itemTypeClass; ?>"></i> <?php echo $itemTypeName; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li><a href="#" class="revolution-filter <?php echo $filterState; ?>">Topic <i class="fas fa-caret-right"></i></a>
                <ul>
                    <?php foreach ($sortedTags['topics'] as $topicTag): ?>
                    <?php $activeClass = (strpos($currentTags, $topicTag['name']) !== false) ? 'class="active"' : ''; ?>
                    <li><a href="#" <?php echo $activeClass; ?> data-filter="<?php echo $topicTag['name']; ?>"><?php echo $topicTag['name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
        <?php echo link_to_items_browse('Apply filters', array(), array('class' => 'apply-filters button')); ?>
        <?php echo link_to_items_browse('Clear filters', array(), array('class' => 'clear-all button')); ?>
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


<div class="resource-list list">
<?php foreach (loop('items') as $item): ?>
<div class="item">
    <?php if (metadata('item', 'has files')): ?>
    <?php echo link_to_item(item_image(), array('class' => 'item-image')); ?>
    <?php endif; ?>
    <div class="item-meta">
    <h2>
        <?php echo revolution_display_item_type_icons($item); ?>
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
