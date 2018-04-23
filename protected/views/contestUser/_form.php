<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contest-user-form',
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
        
        <div class="control-group ">
            <?php echo $form->labelEx($model, 'contest_id', array('class' => 'control-label')) ?>
            <?php
            $this->widget('Select2', array(
                'model' => $model,
                'attribute' => 'contest_id',
                'data' => CHtml::listData(Contest::model()->findAll(), 'id', 'title'),
                'htmlOptions' => array('class' => "span6", 'empty'=>' '),
            ));
            ?>
        </div>   
    
        <?php echo $form->textFieldRow($model,'num_of_votes',array('class'=>'span8')); ?>
        <?php echo $form->textFieldRow($model,'num_of_likes',array('class'=>'span8')); ?>
    
        <?php echo $form->textAreaRow($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
        
        <?php echo $form->checkboxRow($model,'winner'); ?>
    </div>

	<?php
    	if($model->isNewRecord || empty($model_image->image))
		{
	?>
	<div class="well dis_tab" style="width:96.5%;">
    	<?php 
		  $this->widget('ext.reCopy.ReCopyWidget', array(
			 'targetClass'=>'clone-div',
			 'addButtonLabel'=>'<span onclick="resetImages()">Add image</span>',
			 'addButtonCssClass'=>'btn bottomMargin20',
			 'removeButtonLabel'=>' ',
			 'removeButtonCssClass'=>'icon-remove',
			 'limit'=> 3,
		  )); 
		?>
        <span class="red-txt">First image is the main image of the album.</span>
    	<div class="clone-div">
        	<?php echo $form->textField($model_image,'title[]',array('placeholder'=>'Image Title', 'required'=>'required'));?>
            <?php echo $form->textArea($model_image,'desc[]',array('placeholder'=>'Image Description'));?>
            <?php echo $form->fileField($model_image,'image[]',array('required'=>'required','onchange'=>'readURL(this)'));?>
            <span id="show_ContestUserImage_image"></span>
            <?php echo $form->hiddenField($model_image,'date_taken[]',array('id'=>'hiddenTakenDate_ContestUserImage_image','class'=>'haveImg'));?>
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
        	<?php echo $form->textField($model_image,'title[]',array('placeholder'=>'Image Title', 'required'=>'required','value'=>$title,'id'=>'ContestUserImage_title'.$id,'readonly'=>'readonly'));?>
            <?php echo $form->textArea($model_image,'desc[]',array('placeholder'=>'Image Description','value'=>$desc,'id'=>'ContestUserImage_desc'.$id,'readonly'=>'readonly'));?>
            <?php echo $form->fileField($model_image,'image[]',array('onchange'=>'readURL(this)','value'=>$mg,'id'=>'ContestUserImage_image'.$id,'disabled'=>'disabled'));?>
            <!--<span id="show_ContestUserImage_image<?=$id?>"><img src="<?=Yii::app()->request->baseUrl?>/media/contests/contest<?=$model->contest_id?>/<?=$model->user_id?>/<?=$mg?>" width="50" class="pull-left"></span>-->
            <span id="show_ContestUserImage_image<?=$id?>"><img src="<?=Yii::app()->request->baseUrl?>/media/contests/<?=$mg?>" width="50" class="pull-left"></span>
            <?php echo $form->hiddenField($model_image,'date_taken[]',array('id'=>'hiddenTakenDate_ContestUserImage_image'.$id,'class'=>'haveImg', 'value'=>$date_taken));?>
            <a onclick="removeImage(<?=$id?>,'<?=$mg?>',<?=$model->id?>)" href="javascript:void(0)" class="icon-remove pull-right"> </a>
        </div>
        <?php }?>
        <div class="clone-div-up">
        	<?php echo $form->textField($model_image,'title[]',array('placeholder'=>'Image Title','id'=>'ContestUserImage_title'.($id+1)));?>
            <?php echo $form->textArea($model_image,'desc[]',array('placeholder'=>'Image Description','id'=>'ContestUserImage_desc'.($id+1)));?>
            <?php echo $form->fileField($model_image,'image[]',array('onchange'=>'readURL(this)','id'=>'ContestUserImage_image'.($id+1)));?>
            <span id="show_ContestUserImage_image<?=($id+1)?>"></span>
            <?php echo $form->hiddenField($model_image,'date_taken[]',array('id'=>'hiddenTakenDate_ContestUserImage_image'.($id+1),'class'=>'haveImg'));?>
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
		},50);
	}
	

	function removeImage(index,img,model){
		$.ajax({
			'url':"<?=Yii::app()->request->baseUrl?>/contestUser/removeContestUserImage",
			'type':"POST",
			'data':{id:model,image:img},
			'success':function(data){
				if(data=="1" && index!=0)
				{
					$('.copy'+index).remove();
				}
				else
				{
					$('#ContestUserImage_title').val('');
					$('#ContestUserImage_desc').val('');
					$('#hiddenTakenDate_ContestUserImage_image').val('');
					$('#show_ContestUserImage_image').html('');
					
				}
			}
		});
	}
</script>
<?php
    if(!$model->isNewRecord){
?>
<script>
    $(document).ready(function() { setTimeout(function(){$("#ContestUser_user_id,#ContestUser_contest_id").select2("readonly", true);},10); });
</script>
<?php }?>








