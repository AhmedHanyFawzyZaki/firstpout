<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'baby-doctor-hospital-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="well dis_tab" style="width: 96%;">
            <div class="control-group ">
                <?php echo $form->labelEx($model, 'baby_id', array('class' => 'control-label')) ?>
                <?php
                $this->widget('Select2', array(
                    'model' => $model,
                    'attribute' => 'baby_id',
                    'data' => Helper::ListBaby(),
                    'htmlOptions' => array('class' => "span6", 'empty' => ' '),
                ));
                ?>
            </div>
            <div class="control-group ">
                <?php echo $form->labelEx($model, 'doctor_id', array('class' => 'control-label')) ?>
                <?php
                $this->widget('Select2', array(
                    'model' => $model,
                    'attribute' => 'doctor_id',
                    'data' => Helper::ListDoctorsAndHospitals(),
                    'htmlOptions' => array('class' => "span6", 'empty' => ' '),
                ));
                ?>
            </div>
            <?php echo $form->checkBoxRow($model,'is_hospital'); ?>
        </div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
