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
            <?php if ($prevPage = $exhibit_page->previousOrParent()): ?>
            <div id="exhibit-nav-prev">
            <?php 
              $prevLabel = 'Previous: ' . metadata($prevPage, 'menu_title');
              echo exhibit_builder_link_to_previous_page(' ', array(
                  'aria-label' => $prevLabel,
                  'class' => 'previous-page',
                  'title' => $prevLabel,
              ));
            ?>
            </div>
            <?php endif; ?>
            <?php if ($nextPage = $exhibit_page->firstChildOrNext()): ?>
            <div id="exhibit-nav-next">
            <?php 
              $nextLabel = 'Next: ' . metadata($nextPage, 'menu_title');
              echo exhibit_builder_link_to_next_page(' ', array(
                    'aria-label' => $nextLabel,
                    'class' => 'next-page',
                    'title' => $nextLabel,
              )); 
            ?>
            </div>
            <?php endif; ?>
        </div>
    
    </div>

</div>
<?php echo foot(); ?>
