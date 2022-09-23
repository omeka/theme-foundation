<div class="exhibit record">
    <?php $thumbnailSize = (isset($thumbnailSize)) ? $thumbnailSize : 'thumbnail'; ?>
    <?php if ($exhibitImage = record_image($exhibit, $thumbnailSize)): ?>
        <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
    <?php endif; ?>
    <?php if (isset($featured)): ?>
    <span class="secondary label"><?php echo __('Featured Exhibit'); ?></span>
    <?php endif; ?>
    <div class="record-meta">
        <h3><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></h3>
        <p class="description"><?php echo snippet_by_word_count(metadata($exhibit, 'description', array('no_escape' => true))); ?></p>
    </div>
</div>
