<div class="collection record">
    <?php
    $title = metadata($collection, 'display_title');
    $description = metadata($collection, array('Dublin Core', 'Description'), array('snippet' => 150));
    $thumbnailSize = (isset($thumbnailSize)) ? $thumbnailSize : 'thumbnail';
    ?>
    <?php if (isset($featured)): ?>
    <span class="secondary label"><?php echo __('Featured Collection'); ?></span>
    <?php endif; ?>
    <h3><?php echo link_to($this->collection, 'show', $title); ?></h3>
    <?php if ($collectionImage = record_image($collection, $thumbnailSize)): ?>
        <?php echo link_to($this->collection, 'show', $collectionImage, array('class' => 'image')); ?>
    <?php endif; ?>
    <?php if ($description): ?>
        <p class="description"><?php echo $description; ?></p>
    <?php endif; ?>
</div>
