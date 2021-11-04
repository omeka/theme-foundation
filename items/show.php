<?php 
$layout = (get_theme_option('item_show_columns') !== null) ? get_theme_option('item_show_columns') : 'single';
$mediaPosition = (get_theme_option('media_position') !== null) ? get_theme_option('media_position') : 'top';
if (get_theme_option('item_show_media_display') == 'lightgallery') {
    queue_css_file('lightgallery-bundle.min');
    queue_js_file(array('show', 'lightgallery.min', 'lg-thumbnail.min', 'lg-video.min', 'lg-pager.min', 'lg-zoom.min'));
}
$showLayout = get_theme_option('item_show_inline_metadata');
echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'resource items show ' . $layout)); 
?>
<div class="resource-title">
    <h2><?php echo metadata('item','rich_title', array('no_escape' => true)); ?></h2>
    <h3 class="label"><?php echo __('Item'); ?></h3>
</div>
<div class="wrap">
    <?php if (metadata('item', 'has files') && (($mediaPosition == 'top') || ($layout == 'double'))): ?>
        <?php echo foundation_display_attached_media($item); ?>
    <?php endif; ?>

    <!-- Items metadata -->
    <div id="resource-values" class="<?php echo ($showLayout == 1) ? 'inline' : 'stack'; ?>">
        <?php echo all_element_texts('item'); ?>

        <?php if (metadata('item', 'has files') && ($mediaPosition == 'embedded') && ($layout == 'single')): ?>
        <div id="itemfiles" class="element">
            <h3><?php echo __('Files'); ?></h3>
            <div class="element-text"><?php echo foundation_display_attached_media($item); ?></div>
        </div>
        <?php endif; ?>

        <?php if(metadata('item','Collection Name')): ?>
          <div id="collection" class="element">
            <h3><?php echo __('Collection'); ?></h3>
            <div class="element-text"><?php echo link_to_collection_for_item(); ?></div>
          </div>
        <?php endif; ?>
        
         <!-- The following prints a list of all tags associated with the item -->
        <?php if (metadata('item','has tags')): ?>
        <div id="item-tags" class="element">
            <h3><?php echo __('Tags'); ?></h3>
            <div class="element-text"><?php echo tag_string('item'); ?></div>
        </div>
        <?php endif;?>
        
        <!-- The following prints a citation for this item. -->
        <div id="item-citation" class="element">
            <h3><?php echo __('Citation'); ?></h3>
            <div class="element-text"><?php echo metadata('item','citation',array('no_escape'=>true)); ?></div>
        </div>

       <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>

       <?php if (metadata('item', 'has files') && (($mediaPosition == 'bottom') && ($layout == 'single'))): ?>
        <?php echo foundation_display_attached_media($item); ?>
        <?php endif; ?>
    </div>

    <div class="item-pagination navigation">
        <div id="previous-item" class="previous"><?php echo link_to_previous_item_show(null, array('class' => 'button')); ?></div>
        <div id="next-item" class="next"><?php echo link_to_next_item_show(null, array('class' => 'button')); ?></div>
    </div>
</div> <!-- End of Primary. -->

 <?php echo foot(); ?>
