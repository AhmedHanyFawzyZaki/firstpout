<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
        'type'=>'horizontal',
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'from_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'to_id',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'msg',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'msg_type',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'seen',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date_created',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'admin',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fav',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'imp',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'show',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
