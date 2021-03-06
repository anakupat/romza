<div class="form">

<?php $form=$this->beginWidget('CustomForm', array(
	'id'=>$this->modelName.'-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class' => 'well form-disable-button-after-submit'),
)); ?>

	<p class="note"><?php echo Yii::t('common', 'Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model); ?>

    <?php
    $this->widget('application.modules.lang.components.langFieldWidget', array(
    		'model' => $model,
    		'field' => 'page_title',
            'type' => 'string',
    	));
    ?>
    <br/>

    <?php
    $this->widget('application.modules.lang.components.langFieldWidget', array(
    		'model' => $model,
    		'field' => 'page_body',
            'type' => 'text-editor'
    	));
    ?>

	<div class="form-group buttons">
		<?php
			echo AdminLteHelper::getSubmitButton($model->isNewRecord ? tc('Add') : tc('Save'));
		?>
	</div>

<?php $this->endWidget(); ?>

    <div class="clear"></div>
	<?php
	if (issetModule('seo') && !$model->isNewRecord) {
		$this->widget('application.modules.seo.components.SeoWidget', array(
			'model' => $model,
		));
	} ?>

</div><!-- form -->

