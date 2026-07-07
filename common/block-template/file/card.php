<?php
$position = isset($options['file-position'])
    ? html_escape($options['file-position'])
    : 'left';
$size = isset($options['file-size'])
    ? html_escape($options['file-size'])
    : 'fullsize';
$captionPosition = isset($options['captions-position'])
    ? html_escape($options['captions-position'])
    : 'center';
?>
<div class="exhibit-items <?php echo $position; ?> <?php echo $size; ?> captions-<?php echo $captionPosition; ?>">
    <?php foreach ($attachments as $attachment): ?>
        <div class="card">
            <?php if ($file = $attachment->getFile()): ?>
                <?php echo file_image($size, [], $file); ?>
            <?php endif; ?>
            <div class="card-section">
                <?php echo $this->exhibitAttachmentCaption($attachment); ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
