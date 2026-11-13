<?php $advancedForm = $this->partial('search/advanced-options.php', ['filters' => $filters, 'query_types' => $query_types, 'record_types' => $record_types]); ?>
<?php echo $this->form('search-form', $options['form_attributes']); ?>
    <?php if (!$options['show_advanced']): ?>
        <?php echo $this->formHidden('query_type', $filters['query_type']); ?>
        <?php foreach ($filters['record_types'] as $type): ?>
        <?php echo $this->formHidden('record_types[]', $type); ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php echo $this->formText('query', $filters['query'], array('title' => __('Query'), 'aria-label' => __('Query'), 'placeholder' => __('Enter a search term'), 'class' => 'cell large-11')); ?>
    <?php if ($options['show_advanced']): ?>
         <?php if ($options['foundation_layout'] == 'vertical'): ?>
            <button type="button" class="advanced-toggle button closed" aria-controls="advanced-form" aria-expanded="false" aria-label="<?php echo __('Advanced options'); ?>"></button>
        <?php endif; ?>
        <?php echo $advancedForm; ?>
    <?php endif; ?>
    <button aria-label="<?php echo __('Submit'); ?>" id="submit_search" class="button cell large-1" name="submit_search" type="submit" value="<?php echo $options['submit_value']; ?>"><span class="o-icon-search" aria-hidden="true"></span></button>
</form>
