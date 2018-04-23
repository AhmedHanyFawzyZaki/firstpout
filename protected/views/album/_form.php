<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'album-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
    <div class="well dis_tab">
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
                'data' => CHtml::listData(Baby::model()->findAll(), 'id', 'username'),
                'htmlOptions' => array('class' => "span6", 'empty'=>' '),
            ));
            ?>
        </div>
    
        <?php echo $form->textFieldRow($model,'title',array('class'=>'span8','maxlength'=>255)); ?>
        
        <div class="control-group ">
            <?php echo $form->labelEx($model, 'date_of_album', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                    'model' => $model, //Model object
                    'attribute' => 'date_of_album', //attribute name
                    'language' => '',
                    'mode' => 'date', //use "time","date" or "datetime" (default)
                    'options' => array(
                        "dateFormat" => Yii::app()->params['dateFormat'],
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'showOtherMonths' => true, // Show Other month in jquery
						'yearRange'=> "-100:+0",
                    ), // jquery plugin options
                    'htmlOptions' => array(
                        'style' => 'height:20px;',
                        'class' => 'span8',
                    ),
                ));
                ?>
            </div>
        </div>
    
        <?php echo $form->checkBoxRow($model,'pic_date'); ?>
    
        <?php echo $form->checkBoxRow($model,'private'); ?>
    
        <?php echo $form->checkBoxRow($model,'belong_to_me'); ?>
    
        <?php echo $form->textAreaRow($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
    </div>

	<?php
    	if($model->isNewRecord || empty($model_image->image))
		{
	?>
	<div class="well dis_tab widt96per">
    	<?php 
		  $this->widget('ext.reCopy.ReCopyWidget', array(
			 'targetClass'=>'clone-div',
			 'addButtonLabel'=>'<span onclick="resetImages()">Add image</span>',
			 'addButtonCssClass'=>'btn bottomMargin20',
			 'removeButtonLabel'=>' ',
			 'removeButtonCssClass'=>'icon-remove',
			 'limit'=> 9,
		  )); 
		?>
        <span class="red-txt">First image is the main image of the album.</span>
    	<div class="clone-div">
        	<?php echo $form->textField($model_image,'title[]',array('placeholder'=>'Image Title', 'required'=>'required'));?>
            <?php echo $form->textArea($model_image,'desc[]',array('placeholder'=>'Image Description'));?>
            <?php echo $form->fileField($model_image,'image[]',array('required'=>'required','onchange'=>'readURL(this)'));?>
            <span id="show_AlbumImage_image"></span>
            <?php echo $form->hiddenField($model_image,'date_taken[]',array('id'=>'hiddenTakenDate_AlbumImage_image','class'=>'haveImg'));?>
        </div>
    </div>
    <?php }else{?>
    <div class="well dis_tab" style="width:96.5%;">
    	<?php 
		  $this->widget('ext.reCopy.ReCopyWidget', array(
			 'targetClass'=>'clone-div-up',
			 'addButtonLabel'=>'<span onclick="resetImages()">Add image</span>',
			 'addButtonCssClass'=>'btn bottomMargin20',
			 'removeButtonLabel'=>' ',
			 'removeButtonCssClass'=>'icon-remove',
			 'limit'=> 9,
		  )); 
		?>
        <span class="red-txt">First image is the main image of the album.</span>
    	<?php 
            if($model_image->image){
		foreach($model_image->image as $index=>$mg){
			$title=$model_image->title[$index];
			$desc=$model_image->desc[$index];
			$date_taken=$model_image->date_taken[$index];
		?>
        <?php 
			/*if($index==0)
			{
		?>
				<a onclick="removeImage(<?=$index?>,'<?=$mg?>',<?=$model->id?>)" href="javascript:void(0)" class="icon-remove pull-right fixed-cross"> </a>
        <?php
			}*/
			$id=$index+1;
		?>
        <div class="clone-div copy<?=$id?>">
        	<?php echo $form->textField($model_image,'title[]',array('placeholder'=>'Image Title', 'required'=>'required','value'=>$title,'id'=>'AlbumImage_title'.$id,'readonly'=>'readonly'));?>
            <?php echo $form->textArea($model_image,'desc[]',array('placeholder'=>'Image Description','value'=>$desc,'id'=>'AlbumImage_desc'.$id,'readonly'=>'readonly'));?>
            <?php echo $form->fileField($model_image,'image[]',array('onchange'=>'readURL(this)','value'=>$mg,'id'=>'AlbumImage_image'.$id,'disabled'=>'disabled'));?>
            <span id="show_AlbumImage_image<?=$id?>"><img src="<?=Yii::app()->request->baseUrl?>/media/albums/<?=$mg?>" width="50" class="pull-left"></span>
            <?php echo $form->hiddenField($model_image,'date_taken[]',array('id'=>'hiddenTakenDate_AlbumImage_image'.$id,'class'=>'haveImg', 'value'=>$date_taken));?>
            <a onclick="removeImage(<?=$id?>,'<?=$mg?>',<?=$model->id?>)" href="javascript:void(0)" class="icon-remove pull-right"> </a>
        </div>
        <?php }?>
        <div class="clone-div-up">
        	<?php echo $form->textField($model_image,'title[]',array('placeholder'=>'Image Title','id'=>'AlbumImage_title'.($id+1)));?>
            <?php echo $form->textArea($model_image,'desc[]',array('placeholder'=>'Image Description','id'=>'AlbumImage_desc'.($id+1)));?>
            <?php echo $form->fileField($model_image,'image[]',array('onchange'=>'readURL(this)','id'=>'AlbumImage_image'.($id+1)));?>
            <span id="show_AlbumImage_image<?=($id+1)?>"></span>
            <?php echo $form->hiddenField($model_image,'date_taken[]',array('id'=>'hiddenTakenDate_AlbumImage_image'.($id+1),'class'=>'haveImg'));?>
        </div>
    </div>
    <?php }
    }
    ?>
    
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
			$('#hiddenTakenDate_'+input.id).val(imgYear+'-'+imgMonth+'-'+imgDay+' '+imgHours+':'+imgMin+':'+imgSec);
			reader.onload = function (e) {
				$('#show_'+input.id).html('<img src="'+e.target.result+'" width="50" class="pull-left">');
			}
			reader.readAsDataURL(input.files[0]);
		}
		
	}
	function resetImages()
	{
		setTimeout(function(){
			$('.haveImg').each(function(index, element) {
				if(!element.value)
				{
					var elementID=element.id;
					var id=elementID.replace('hiddenTakenDate_','');
					$('#show_'+id).html('');
				}
			});
		},10);
	}
	
	function removeImage(index,img,model){
		$.ajax({
			'url':"<?=Yii::app()->request->baseUrl?>/album/removeAlbumImage",
			'type':"POST",
			'data':{id:model,image:img},
			'success':function(data){
				if(data=="1" && index!=0)
				{
					$('.copy'+index).remove();
				}
				else
				{
					$('#AlbumImage_title').val('');
					$('#AlbumImage_desc').val('');
					$('#hiddenTakenDate_AlbumImage_image').val('');
					$('#show_AlbumImage_image').html('');
					
				}
			}
		});
	}
</script>
<?php
    if(!$model->isNewRecord){
?>
<script>
    $(document).ready(function() { setTimeout(function(){$("#Album_user_id,#Album_baby_id").select2("readonly", true);},10); });
</script>
<?php }?>