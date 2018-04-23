<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'visit-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
    <div class="well dis_tab widt96per">
        <div class="control-group ">
            <?php echo $form->labelEx($model, 'baby_id', array('class' => 'control-label')) ?>
            <?php
            $this->widget('Select2', array(
                'model' => $model,
                'attribute' => 'baby_id',
                'data' => CHtml::listData(Baby::model()->findAll(),'id','username'),
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
                'data' => CHtml::listData(User::model()->findAll(array('condition'=>'groups_id=2')),'id','username'),
                'htmlOptions' => array('class' => "span6", 'empty' => ' '),
            ));
            ?>
        </div>
        
        <?php echo $form->textFieldRow($model,'title',array('class'=>'span8','maxlength'=>255)); ?>
        
        <div class="control-group ">
			<?php echo $form->labelEx($model, 'date_of_visit', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                    'model' => $model, //Model object
                    'attribute' => 'date_of_visit', //attribute name
                    'language' => '',
                    'mode' => 'datetime', //use "time","date" or "datetime" (default)
                    'options' => array(
                        "dateFormat" => Yii::app()->params['dateFormat'],
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'showOtherMonths' => true, // Show Other month in jquery
                        'yearRange'=> "-10:+5",
                    ), // jquery plugin options
                    'htmlOptions' => array(
                        'style' => 'height:20px;',
                        'class' => 'span8',
                    ),
                ));
                ?>
            </div>
        </div>
         <div class="control-group ">
            <?php echo $form->labelEx($model, 'user_id', array('class' => 'control-label')) ?>
            <?php
            $this->widget('Select2', array(
                'model' => $model,
                'attribute' => 'user_id',
                'data' => Helper::ListUsers(),
                'htmlOptions' => array('class' => "span6", 'empty' => ' '),
            ));
            ?>
        </div>
        <?php echo $form->textAreaRow($model,'note',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
    </div>
    <div class="well dis_tab">
        <?php echo $form->textAreaRow($model,'diagonise',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
        <?php echo $form->textAreaRow($model,'medication',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
        <?php echo $form->textAreaRow($model,'frequency',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
        <?php echo $form->textAreaRow($model,'desage',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
        <?php echo $form->textAreaRow($model,'bage_on',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
        <?php echo $form->textAreaRow($model,'prescription',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
        <?php //echo $form->checkBoxRow($model,'realized'); ?>
    </div>
    <div class="form-actions pull-right clear">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
