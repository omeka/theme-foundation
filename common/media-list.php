<?php $linkToFileMetadata = get_option('link_to_file_metadata'); ?>
<div id="item-images" class="media-list">
<?php foreach ($files as $file): ?>
    <?php $fileUrl = ($linkToFileMetadata == '1') ? record_url($file) : $file->getWebPath('original'); ?>
    <div class="media-link">
    <a href="<?php echo $fileUrl; ?>">
    <?php echo file_image('square_thumbnail', array('class' => 'thumbnail'), $file); ?>
    <?php echo metadata($file, 'rich_title', array('no_escape' => true)); ?>
    </a>
    </div>
<?php endforeach; ?>
</div>