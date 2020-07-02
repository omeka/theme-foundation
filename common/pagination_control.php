<?php
if ($this->pageCount > 1):
    $getParams = $_GET;
?>
<nav class="pagination-nav" aria-label="<?php echo __('Pagination'); ?>">
    <div class="page-input">
    <form action="<?php echo html_escape($this->url()); ?>" method="get" accept-charset="utf-8">
    <?php
    $hiddenParams = array();
    $entries = explode('&', http_build_query($getParams));
    foreach ($entries as $entry) {
        if (!$entry) {
            continue;
        }
        list($key, $value) = explode('=', $entry);
        $hiddenParams[urldecode($key)] = urldecode($value);
    }

    foreach ($hiddenParams as $key => $value) {
        if ($key != 'page') {
            echo $this->formHidden($key, $value);
        }
    }

    // Manually create this input to allow an omitted ID
    $pageInput = '<input type="text" name="page" title="'
                . html_escape(__('Current Page'))
                . '" value="'
                . html_escape($this->current) . '"><span class="total-count">';
    echo __('%s of %s', $pageInput, $this->last);
    echo "</span>";
    ?>
    </form>
    </div>
    
    <div class="button-group">
        <?php if (isset($this->previous)): ?>
        <!-- Previous page link -->
        <div class="pagination_previous">
            <?php $getParams['page'] = $previous; ?>
            <a rel="prev" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>" aria-label="<?php echo __('Previous Page'); ?>" title="<?php echo __('Previous Page'); ?>" class="button"><i class="fas fa-caret-left"></i></a>
        </div>
        <?php endif; ?>
    
        <?php if (isset($this->next)): ?>
        <!-- Next page link -->
        <div class="pagination_next">
            <?php $getParams['page'] = $next; ?>
            <a rel="next" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>" aria-label="<?php echo __('Next Page'); ?>" title="<?php echo __('Next Page'); ?>" class="button"><i class="fas fa-caret-right"></i></a>
        </div>
        <?php endif; ?>
    </div>
</nav>

<?php endif; ?>
