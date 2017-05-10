<div class="form-group">
    <?php echo $form->labelEx($model, 'obj_type_id'); ?>
    <?php echo $form->dropDownList($model, 'obj_type_id', Apartment::getObjTypesArray(), array('class' => 'span3 form-control', 'id' => 'obj_type')); ?>
    <?php echo $form->error($model, 'obj_type_id'); ?>
</div>