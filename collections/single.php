<?php
$title = metadata($collection, 'display_title');
$description = metadata($collection, array('Dublin Core', 'Description'), array('snippet' => 150));
$thumbnailSize = (isset($thumbnailSize)) ? $thumbnailSize : 'thumbnail';
$collectionImage = record_image($collection, $thumbnailSize);
?>
<?php if ($collectionImage): ?>
<div class="collection record" <?php echo (isset($featured)) ? 'style="background-image:url(\'' . html_escape(record_image_url($collection, 'fullsize')) . '\')"' : ''; ?>>
  <?php echo $collectionImage; ?>
<?php else: ?>
<div class="collection record empty">
<?php endif; ?>
    <div class="record-meta">
        <?php if (isset($featured)): ?>
        <span class="secondary label"><?php echo __('Featured Collection'); ?></span>
        <?php endif; ?>
        <?php echo (isset($featured)) ? '' : link_to($this->collection, 'show', $collectionImage, array('class' => 'image')); ?>
        <h2><?php echo link_to($this->collection, 'show', $title); ?></h2>
        <?php if ($description): ?>
            <p class="description"><?php echo $description; ?></p>
        <?php endif; ?>
    </div>
</div>
