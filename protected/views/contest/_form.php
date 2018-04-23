<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contest-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
    <div class="well dis_tab">

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span8','maxlength'=>255)); ?>
    
        <?php echo $form->textFieldRow($model,'price',array('class'=>'span8','maxlength'=>10,'append'=>'$')); ?>

	<?php echo $form->textAreaRow($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->fileFieldRow($model,'image',array('class'=>'span8','maxlength'=>255,'onchange'=>'readURL(this)'));
    
	if($model->isNewRecord != '1' and $model->image!='')
	{
		//echo '<br>'.Chtml::image(Yii::app()->baseUrl.'/media/contests/contest'.$model->id.'/'.$model->image ,'image',array('id'=>'img','width'=>150,'class'=>'text-center pull-left width50per'));
		echo '<br>'.Chtml::image(Yii::app()->baseUrl.'/media/contests/'.$model->image ,'image',array('id'=>'img','width'=>150,'class'=>'text-center pull-left width50per'));

	}
	else
	{
		echo '<span id="img" class="text-center pull-left width50per">No Image</span>';
	}
	?>
    
    </div>
    <div class="well dis_tab clear widt96per">
    
	<div class="control-group ">
            <?php echo $form->labelEx($model, 'date_start', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                    'model' => $model, //Model object
                    'attribute' => 'date_start', //attribute name
                    'language' => '',
                    'mode' => 'datetime', //use "time","date" or "datetime" (default)
                    'options' => array(
                        "dateFormat" => Yii::app()->params['dateFormat'],
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'showOtherMonths' => true, // Show Other month in jquery
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
            <?php echo $form->labelEx($model, 'date_end', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                    'model' => $model, //Model object
                    'attribute' => 'date_end', //attribute name
                    'language' => '',
                    'mode' => 'datetime', //use "time","date" or "datetime" (default)
                    'options' => array(
                        "dateFormat" => Yii::app()->params['dateFormat'],
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'showOtherMonths' => true, // Show Other month in jquery
                    ), // jquery plugin options
                    'htmlOptions' => array(
                        'style' => 'height:20px;',
                        'class' => 'span8',
                    ),
                ));
                ?>
            </div>
    </div>
    
    <?php echo $form->checkBoxRow($model,'active'); ?>
    
    </div>

	<div class="form-actions clear">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			var imgMeta=input.files[0];
			reader.onload = function (e) {
				$('#img').html('<img src="'+e.target.result+'" width="150">');
			}
			reader.readAsDataURL(input.files[0]);
		}
		
	}
</script>