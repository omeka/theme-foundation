<?php echo $this->form('search-form', $options['form_attributes']); ?>
    <?php if ($options['show_advanced']): ?>
    <div id="advanced-form" class="closed">
        <fieldset id="query-types" aria-label="<?php echo __('Search using this query type:'); ?>">
            <?php echo $this->formRadio('query_type', $filters['query_type'], null, $query_types, ""); ?>
        </fieldset>
        <?php if ($record_types): ?>
        <fieldset id="record-types" aria-label="<?php echo __('Search only these record types:'); ?>">
            <?php foreach ($record_types as $key => $value): ?>
            <?php echo $this->formCheckbox('record_types[]', $key, array('checked' => in_array($key, $filters['record_types']), 'id' => 'record_types-' . $key)); ?> <?php echo $this->formLabel('record_types-' . $key, $value);?>
            <?php endforeach; ?>
        </fieldset>
        <?php elseif (is_admin_theme()): ?>
            <p><a href="<?php echo url('settings/edit-search'); ?>"><?php echo __('Go to search settings to select record types to use.'); ?></a></p>
        <?php endif; ?>
        <p><?php echo link_to_item_search(__('Advanced Search (Items only)')); ?></p>
    </div>
    <?php else: ?>
        <?php echo $this->formHidden('query_type', $filters['query_type']); ?>
        <?php foreach ($filters['record_types'] as $type): ?>
        <?php echo $this->formHidden('record_types[]', $type); ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php echo $this->formText('query', $filters['query'], array('title' => __('Query'), 'aria-label' => __('Query'), 'placeholder' => __('Enter a search term'), 'class' => 'cell large-11')); ?>
    <?php echo $this->formButton('submit_search', $options['submit_value'], array('type' => 'submit', 'class' => 'button cell large-1')); ?>
</form>
