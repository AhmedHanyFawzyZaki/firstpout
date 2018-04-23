<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
        'type'=>'horizontal',
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'baby_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date_of_visit',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'diagonise',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'medication',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'desage',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'frequency',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'bage_on',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'doctor_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'prescription',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'next_medication',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'note',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'realized',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date_created',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date_updated',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
