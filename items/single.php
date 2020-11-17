<div class="item record">
  <?php
  $title = metadata($item, 'display_title');
  $description = metadata($item, array('Dublin Core', 'Description'), array('snippet' => 150));
  $thumbnailSize = (isset($thumbnailSize)) ? $thumbnailSize : 'thumbnail';
  ?>
  <?php if (metadata($item, 'has files')) {
      echo link_to_item(
          item_image($thumbnailSize, array(), 0, $item),
          array('class' => 'image'), 'show', $item
      );
  }
  ?>
  <?php if (isset($featured)): ?>
  <span class="secondary label"><?php echo __('Featured Item'); ?></span>
  <?php endif; ?>
  <div class="record-meta">
    <h3><?php echo link_to($item, 'show', $title); ?></h3>
    <?php if ($description): ?>
        <p class="description"><?php echo $description; ?></p>
    <?php endif; ?>
  </div>
</div>
