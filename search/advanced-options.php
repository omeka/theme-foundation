<div id="advanced-form" class="closed">
    <fieldset id="query-types">
        <legend><?php echo __('Search using this query type:'); ?></legend>
        <?php echo $this->formRadio('query_type', $filters['query_type'], null, $query_types, ""); ?>
    </fieldset>
    <?php if ($record_types): ?>
    <fieldset id="record-types">
        <legend><?php echo __('Search only these record types:'); ?></legend>
        <?php foreach ($record_types as $key => $value): ?>
            <label class="record-type-option"><?php echo $this->formCheckbox('record_types[]', $key, array('checked' => in_array($key, $filters['record_types']), 'id' => 'record_types-' . $key)); ?> <?php echo $value; ?></label>
        <?php endforeach; ?>
    </fieldset>
    <?php elseif (is_admin_theme()): ?>
        <p><a href="<?php echo url('settings/edit-search'); ?>"><?php echo __('Go to search settings to select record types to use.'); ?></a></p>
    <?php endif; ?>
    <p><?php echo link_to_item_search(__('Advanced Search (Items only)')); ?></p>
</div>
