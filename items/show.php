<?php $layout = (get_theme_option('item_show_columns') !== null) ? get_theme_option('item_show_columns') : 'single'; ?>
<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show ' . $layout)); ?>
<div class="wrap">
    <h1><?php echo metadata('item', array('Dublin Core','Title')); ?></h1>

    <?php if (metadata('item', 'has files')): ?>
    <div id="item-images">    
        <?php if ((get_theme_option('Item File Gallery') == 1)): ?>
            <?php echo files_for_item(array('imageSize' => 'fullsize')); ?>
        <?php else: ?>
            <?php echo files_for_item(); ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Items metadata -->
    <div id="item-metadata">
        <?php echo all_element_texts('item'); ?>

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
    </div>

    <div class="item-pagination navigation">
        <div id="previous-item" class="previous"><?php echo link_to_previous_item_show(null, array('class' => 'button')); ?></div>
        <div id="next-item" class="next"><?php echo link_to_next_item_show(null, array('class' => 'button')); ?></div>
    </div>

</div> <!-- End of Primary. -->

 <?php echo foot(); ?>
