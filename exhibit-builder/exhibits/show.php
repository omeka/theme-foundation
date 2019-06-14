<?php
echo head(array(
    'title' => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
    'bodyclass' => 'exhibits show'));
?>

<div class="grid-x">

    <nav id="exhibit-pages" class="cell small-2" data-sticky-container>
        <div class="exhibit-tree-container sticky" data-sticky data-anchor="exhibit-content">
        <h4><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></h4>
        <?php echo exhibit_builder_page_tree($exhibit, $exhibit_page); ?>
        </div>
    </nav>
    
    <div id="exhibit-content" class="cell small-8 right small-offset-1">
    
        <h1><span class="exhibit-page"><?php echo metadata('exhibit_page', 'title'); ?></span></h1>
        
        <div id="exhibit-blocks">
        <?php exhibit_builder_render_exhibit_page(); ?>
        </div>
        
        <div id="exhibit-page-navigation">
            <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
            <div id="exhibit-nav-prev">
            <?php echo $prevLink; ?>
            </div>
            <?php endif; ?>
            <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
            <div id="exhibit-nav-next">
            <?php echo $nextLink; ?>
            </div>
            <?php endif; ?>
            <div id="exhibit-nav-up">
            <?php echo exhibit_builder_page_trail(); ?>
            </div>
        </div>
    
    </div>

</div>
<?php echo foot(); ?>
