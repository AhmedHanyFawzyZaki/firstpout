<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); 
?>

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
            <?php echo $form->labelEx($model, 'baby_id', array('class' => 'control-label')) ?>
            <?php
            $this->widget('Select2', array(
                'model' => $model,
                'attribute' => 'baby_id',
                'data' => CHtml::listData(Baby::model()->findAll(),'id','username'),
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
    </div>
    
    <div class="well dis_tab widt96per">
    
		<?php echo $form->textFieldRow($model,'title',array('class'=>'span8','maxlength'=>255)); ?>
        
        <div id="content_1">
        	<?php echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span12','id'=>'content_text')); ?>
        </div>
        <div id="content_2">
        	<?php echo $form->fileFieldRow($model,'image',array('onchange'=>'readURL(this)'));?>
            <span id="show_PostImage_image"></span>
            <?php echo $form->hiddenField($model,'image_date_taken');?>
        </div>
        <div id="content_2">
        	<?php echo $form->fileFieldRow($model,'video');?>
            <div class="pull-right">
            <?php
			if(!$model->isNewRecord && $model->video)
				Helper::ShowVideo($model->video)
			
			?>
            </div>
        </div>
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
			var imgDate=imgMeta.lastModifiedDate;
			var imgMonth=imgDate.getMonth() + 1;
			var imgDay=imgDate.getDate();
			var imgYear=imgDate.getFullYear();
			var imgHours=imgDate.getHours();
			var imgMin=imgDate.getMinutes();
			var imgSec=imgDate.getSeconds();
			$('#Post_image_date_taken').val(imgYear+'-'+imgMonth+'-'+imgDay+' '+imgHours+':'+imgMin+':'+imgSec);
			reader.onload = function (e) {
				$('#show_PostImage_image').html('<img src="'+e.target.result+'" width="50" class="pull-left">');
			}
			reader.readAsDataURL(input.files[0]);
		}
		
	}
</script>