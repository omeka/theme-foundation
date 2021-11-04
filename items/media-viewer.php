<?php 
$lightMedia = [];
$otherMedia = [];
$whitelist = ['image/bmp', 'image/gif', 'image/jpeg', 'image/png', 'image/svg+xml'];
foreach ($item->Files as $media) {
    $mediaType = $media->mime_type;
    if (in_array($mediaType, $whitelist) || (strpos($mediaType, 'video') !== false)) {
        $lightMedia[] = $media;
    } else {
        $otherMedia[] = $media;
    }
}
?>

<?php if (count($lightMedia) > 0): ?>
    <div id="itemfiles">
        <?php foreach ($lightMedia as $media): ?>
            <?php 
                $mediaType = $media->mime_type;
                $source = $media->getProperty('uri');
                $subHtml = "<div class='lg-caption'>" . $media->getProperty('display_title') . "</div>"; 
                $squareThumbnailUri = $media->getProperty('square_thumbnail_uri');
            ?>
            <?php if (strpos($mediaType, 'image') !== false): ?>
                <div data-src="<?php echo $source; ?>" data-thumb="<?php echo html_escape($squareThumbnailUri); ?>" class="media resource" data-sub-html="<?php echo $subHtml; ?>">
                    <?php echo file_markup($media); ?>
                </div>
                <?php else: ?>
                <?php
                    $trackHtml = '';
                    if ($tracksPresent) {
                        $trackHtml .=  '"tracks": [';
                        foreach ($otherMedia as $key => $media) {
                            $trackHtml .= $this->OutputTrack($media, $source);
                            unset($otherMedia[$key]);
                        }
                        $trackHtml = rtrim($trackHtml, ',');
                        $trackHtml .= '],'; 
                    }
                ?>    
                <a
                    class="media resource"
                    data-video='{"source": [{"src":"<?php echo $source; ?>", "type":"<?php echo $mediaType; ?>"}], <?php echo $trackHtml; ?> "attributes": {"preload": false, "controls": true}}'
                    data-download-url="<?php echo $source; ?>" 
                    data-poster="<?php echo $squareThumbnailUri; ?>"
                    data-sub-html="<?php echo $subHtml; ?>"
                >  
                    <img
                        class="img-responsive"
                        src="<?php echo $squareThumbnailUri; ?>"
                    />
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>