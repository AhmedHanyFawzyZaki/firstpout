<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
        'type'=>'horizontal',
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'category',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'image',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'banner',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'privacy',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'other',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); ?>

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
