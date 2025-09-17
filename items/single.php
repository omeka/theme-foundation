<?php
$title = metadata($item, 'display_title');
$description = metadata($item, array('Dublin Core', 'Description'), array('snippet' => 150));
$thumbnailSize = (isset($thumbnailSize)) ? $thumbnailSize : 'thumbnail';
$hasThumbnail = metadata($item, 'has files');
$itemThumbnail = item_image($thumbnailSize, array(), 0, $item);
?>
<?php if ($hasThumbnail): ?>
<div class="item record" <?php echo (isset($featured)) ? 'style="background-image:url(\'' . html_escape(record_image_url($item, 'fullsize')) . '\')"' : ''; ?>>
  <?php echo $itemThumbnail; ?>
<?php else: ?>
<div class="item record empty">
<?php endif; ?>
  <div class="record-meta">
    <?php if (isset($featured)): ?>
    <span class="secondary label"><?php echo __('Featured Item'); ?></span>
    <?php endif; ?>
    <h2><?php echo link_to($item, 'show', $title); ?></h2>
    <?php if ($description): ?>
        <p class="description"><?php echo $description; ?></p>
    <?php endif; ?>
  </div>
</div>
