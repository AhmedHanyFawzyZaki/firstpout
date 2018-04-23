<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
    <div class="well dis_tab">
    
        <?php echo $form->textFieldRow($model,'email',array('class'=>'span8','maxlength'=>255)); ?>
        
        <?php echo $form->textFieldRow($model,'ios_app_link',array('class'=>'span8','maxlength'=>255)); ?>
        
        <?php echo $form->textFieldRow($model,'android_app_link',array('class'=>'span8','maxlength'=>255)); ?>
        
        <?php //echo $form->textFieldRow($model,'product_expiration_period',array('class'=>'span8','maxlength'=>255,'append'=>'Seconds')); ?>
        
        <?php //echo $form->textFieldRow($model,'config_key',array('class'=>'span8','maxlength'=>255)); ?>
        
        <?php echo $form->fileFieldRow($model,'image',array('class'=>'span8','maxlength'=>255));
    
        if($model->isNewRecord != '1' and $model->image!='')
        {
            echo Chtml::image(Yii::app()->baseUrl.'/media/'.$model->image ,'image',array('width'=>200));
    
        }
        ?>
        <div class="clear"></div>
        <?php echo $form->fileFieldRow($model,'default_profile_pic',array('class'=>'span8','maxlength'=>255));
    
        if($model->isNewRecord != '1' and $model->default_profile_pic!='')
        {
            echo Chtml::image(Yii::app()->baseUrl.'/media/'.$model->default_profile_pic ,'default_profile_pic',array('width'=>180));
    
        }
        ?>
        <div class="clear"></div>
        <?php echo $form->fileFieldRow($model,'default_banner_image',array('class'=>'span8','maxlength'=>255));
    
        if($model->isNewRecord != '1' and $model->default_banner_image!='')
        {
            echo Chtml::image(Yii::app()->baseUrl.'/media/'.$model->default_banner_image ,'default_banner_image',array('width'=>490));
    
        }
        ?>
        
        <?php //echo $form->textAreaRow($model,'config_value',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
        
        <?php //echo $form->checkBoxRow($model,'autoload'); ?>
    
    </div>
	

	<div class="form-actions clear">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
