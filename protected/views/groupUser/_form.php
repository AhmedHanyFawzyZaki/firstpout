<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'group-user-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="well dis_tab widt96per">

        <div class="control-group ">
            <?php echo $form->labelEx($model, 'user_id', array('class' => 'control-label')) ?>
            <?php
            $this->widget('Select2', array(
                'model' => $model,
                'attribute' => 'user_id',
                'data' => Helper::ListUsers(),
                'htmlOptions' => array('class' => "span6", 'empty'=>' '),
            ));
            ?>
        </div>
        <div class="control-group ">
            <?php echo $form->labelEx($model, 'group_id', array('class' => 'control-label')) ?>
            <?php
            $this->widget('Select2', array(
                'model' => $model,
                'attribute' => 'group_id',
                'data' => CHtml::listData(Group::model()->findAll(),'id','title'),
                'htmlOptions' => array('class' => "span6", 'empty'=>' '),
            ));
            ?>
        </div>
        
        <?php echo $form->radioButtonListRow($model,'role',array('0'=>'User','1'=>'Administrator')); ?>
        
		<?php //echo $form->textFieldRow($model,'date_joined',array('class'=>'span8')); ?>
    </div>

	<?php //echo $form->textFieldRow($model,'date_created',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'date_updated',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
