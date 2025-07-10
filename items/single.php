<?php
$title = metadata($item, 'display_title');
$description = metadata($item, array('Dublin Core', 'Description'), array('snippet' => 150));
$thumbnailSize = (isset($thumbnailSize)) ? $thumbnailSize : 'thumbnail';
$itemThumbnail = item_image($thumbnailSize, array(), 0, $item);
?>
<div class="item record">
  <?php echo (metadata($item, 'has files')) ? $itemThumbnail : link_to_item($itemThumbnail, array('class' => 'image'), 'show', $item); ?>
  <?php if (isset($featured)): ?>
  <span class="secondary label"><?php echo __('Featured Item'); ?></span>
  <?php endif; ?>
  <div class="record-meta">
    <h2><?php echo link_to($item, 'show', $title); ?></h2>
    <?php if ($description): ?>
        <p class="description"><?php echo $description; ?></p>
    <?php endif; ?>
  </div>
</div>
