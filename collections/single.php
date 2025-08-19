<?php
$title = metadata($collection, 'display_title');
$description = metadata($collection, array('Dublin Core', 'Description'), array('snippet' => 150));
$thumbnailSize = (isset($thumbnailSize)) ? $thumbnailSize : 'thumbnail';
$collectionImage = record_image($collection, $thumbnailSize);
?>
<div class="collection record <?php echo ($collectionImage) ? '' : 'empty'; ?>">
    <?php if (isset($featured)): ?>
    <span class="secondary label"><?php echo __('Featured Collection'); ?></span>
    <?php endif; ?>
    <?php echo (isset($featured)) ? $collectionImage : link_to($this->collection, 'show', $collectionImage, array('class' => 'image')); ?>
    <h2><?php echo link_to($this->collection, 'show', $title); ?></h2>
    <?php if ($description): ?>
        <p class="description"><?php echo $description; ?></p>
    <?php endif; ?>
</div>
