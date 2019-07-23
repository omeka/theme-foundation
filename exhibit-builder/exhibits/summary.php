<?php echo head(array('title' => metadata('exhibit', 'title'), 'bodyclass'=>'exhibits summary')); ?>

<div class="grid-x">
  <?php
$pageTree = exhibit_builder_page_tree();
if ($pageTree):
?>
    <nav id="exhibit-pages" class="cell small-2" data-sticky-container>
        <div class="exhibit-tree-container sticky" data-sticky data-anchor="exhibit-content">
        <?php echo exhibit_builder_page_tree($exhibit); ?>
        </div>
    </nav>
<?php endif; ?>


<div id="exhibit-content" class="cell small-8 right small-offset-1">

<h1><?php echo metadata('exhibit', 'title'); ?></h1>

<?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
<div class="exhibit-description">
    <?php echo $exhibitDescription; ?>
</div>
<?php endif; ?>

<?php if (($exhibitCredits = metadata('exhibit', 'credits'))): ?>
<div class="exhibit-credits">
    <h3><?php echo __('Credits'); ?></h3>
    <p><?php echo $exhibitCredits; ?></p>
</div>
<?php endif; ?>

<?php echo exhibit_builder_page_nav(); ?>
</div>
</div>

<?php echo foot(); ?>
