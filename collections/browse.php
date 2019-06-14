<?php
$pageTitle = __('Browse Collections');
echo head(array('title' => $pageTitle, 'bodyclass' => 'collections browse'));
?>

<h1><?php echo $pageTitle; ?> <?php echo __('(%s total)', $total_results); ?></h1>
<div class="browse-controls">
    <div class="top-bar-left">
        <?php echo pagination_links(); ?>
    </div>
    <div class="top-bar-right">
        <?php if ($total_results > 0): ?>        
        <?php
        $sortLinks[__('Title')] = 'Dublin Core,Title';
        $sortLinks[__('Date Added')] = 'added';
        ?>
        <div id="sort-links">
            <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
        </div>
        
        <?php endif; ?>
    </div>
</div>

<?php foreach (loop('collections') as $collection): ?>

<div class="collection hentry media-object grid-x">
    <div class="media-object-section cell small-3">
    <?php if ($collectionImage = record_image('collection')): ?>
        <?php echo link_to_collection($collectionImage, array('class' => 'thumbnail')); ?>
    <?php endif; ?>
    </div>

    <div class="collection-meta media-object-section cell small-9">
        <h2><?php echo link_to_collection(); ?></h2>
    
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
    
</div><!-- end class="collection" -->

<?php endforeach; ?>

<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_collections_browse', array('collections' => $collections, 'view' => $this)); ?>

<?php echo foot(); ?>
