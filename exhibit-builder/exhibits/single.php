<?php $exhibitImage = record_image($exhibit, $thumbnailSize); ?>
<?php if ($exhibitImage): ?>
<div class="exhibit record" <?php echo (isset($featured)) ? 'style="background-image:url(\'' . html_escape(record_image_url($exhibit, 'fullsize')) . '\')"' : ''; ?>>
  <?php echo $exhibitImage; ?>
<?php else: ?>
<div class="exhibit record empty">
<?php endif; ?>
    <?php $thumbnailSize = (isset($thumbnailSize)) ? $thumbnailSize : 'thumbnail'; ?>
    <?php if ($exhibitImage): ?>
        <?php echo (isset($featured)) ? '' : exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
    <?php endif; ?>
    <div class="record-meta">
        <?php if (isset($featured)): ?>
        <span class="secondary label"><?php echo __('Featured Exhibit'); ?></span>
        <?php endif; ?>
        <h2><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></h2>
        <p class="description"><?php echo snippet_by_word_count(metadata($exhibit, 'description', array('no_escape' => true))); ?></p>
    </div>
</div>
