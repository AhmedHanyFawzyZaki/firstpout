<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'ads-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="well dis_tab">

        <?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>
        
        <?php echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>255)); ?>
        
        <?php echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

        <?php echo $form->fileFieldRow($model,'image',array('class'=>'span5','maxlength'=>255));

        if($model->isNewRecord != '1' and $model->image!='')
        {
                echo "<p>". Chtml::image(Yii::app()->baseUrl.'/media/ads/'.$model->image ,'image',array('width'=>180)) ."</p>";

        }
        ?>

	</div>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
