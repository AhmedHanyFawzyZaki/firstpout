<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-relationship-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php 
		if($model->me_id && $model->isNewRecord)
		{
			echo $form->hiddenField($model,'me_id');
		}
		else
		{
			?>
            <div class="control-group ">
				<?php echo $form->labelEx($model, 'me_id', array('class' => 'control-label')) ?>
                <?php
                $this->widget('Select2', array(
                    'model' => $model,
                    'attribute' => 'me_id',
                    'data' => Helper::ListUsers(),
                    'htmlOptions' => array('class' => "span6","empty"=>" "),
                ));
                ?>
            </div>
            <?php
		}
	?>

	<div class="control-group ">
		<?php echo $form->labelEx($model, 'user_id', array('class' => 'control-label')) ?>
        <?php
        $this->widget('Select2', array(
            'model' => $model,
            'attribute' => 'user_id',
            'data' => Helper::ListUsers($model->me_id),
            'htmlOptions' => array('class' => "span6","empty"=>" "),
        ));
        ?>
    </div>

	<div class="control-group ">
		<?php echo $form->labelEx($model, 'connection_id', array('class' => 'control-label')) ?>
        <?php
        $this->widget('Select2', array(
            'model' => $model,
            'attribute' => 'connection_id',
            'data' => CHtml::listData(Connection::model()->findAll(),'id','title'),
            'htmlOptions' => array('class' => "span6","empty"=>" "),
        ));
        ?>
    </div>

	<div class="form-actions clear">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
