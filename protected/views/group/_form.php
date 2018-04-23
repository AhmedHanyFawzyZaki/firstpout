<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'group-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
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
            <?php echo $form->labelEx($model, 'category', array('class' => 'control-label')) ?>
            <?php
            $this->widget('Select2', array(
                'model' => $model,
                'attribute' => 'category',
                'data' => CHtml::listData(GroupCategory::model()->findAll(),'id','title'),
                'htmlOptions' => array('class' => "span6", 'empty'=>' '),
            ));
            ?>
        </div>
        
		<?php echo $form->textFieldRow($model,'title',array('class'=>'span8','maxlength'=>255)); ?>

		<?php echo $form->radioButtonListRow($model,'privacy',array('0'=>'Public','1'=>'Private')); ?>
        
		<?php echo $form->fileFieldRow($model,'image',array('class'=>'span8','maxlength'=>255, 'onchange'=>'readURL(this)'));
		
        if($model->isNewRecord != '1' and $model->image!='')
        {
			echo '<p id="img_id">'. Chtml::image($model->image ,'image',array('width'=>180)) ."</p>";
        }else{
			echo '<p id="img_id"></p>';
		}
        ?>
        
    </div>

	<?php //echo $form->textFieldRow($model,'banner',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'other',array('class'=>'span5')); ?>

	<div class="form-actions">
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
			reader.onload = function (e) {
				$('#img_id').html('<img src="'+e.target.result+'" width="180" class="pull-left">');
			}
			reader.readAsDataURL(input.files[0]);
		}
		
	}
</script>