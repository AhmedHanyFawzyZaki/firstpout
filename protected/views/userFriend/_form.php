<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-friend-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php 
		if($model->user_id && $model->isNewRecord)
		{
			echo $form->hiddenField($model,'user_id');
		}
		else
		{
			?>
            <div class="control-group ">
				<?php echo $form->labelEx($model, 'user_id', array('class' => 'control-label')) ?>
                <?php
                $this->widget('Select2', array(
                    'model' => $model,
                    'attribute' => 'user_id',
                    'data' => Helper::ListUsers(),
                    'htmlOptions' => array('class' => "span6","empty"=>" "),
                ));
                ?>
            </div>
            <?php
		}
	?>

	<div class="control-group ">
		<?php echo $form->labelEx($model, 'friend_id', array('class' => 'control-label')) ?>
        <?php
        $this->widget('Select2', array(
            'model' => $model,
            'attribute' => 'friend_id',
            'data' => Helper::ListUsers($model->user_id),
            'htmlOptions' => array('class' => "span6","empty"=>" "),
        ));
        ?>
    </div>

	<?php echo $form->checkBoxRow($model,'approved'); ?>

	<?php //echo $form->textFieldRow($model,'date_created',array('class'=>'span5')); ?>

	<div class="form-actions clear">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
