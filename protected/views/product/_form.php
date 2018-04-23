<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
    <div class="well dis_tab">

		<?php echo $form->textFieldRow($model,'title',array('class'=>'span8','maxlength'=>255)); ?>
    
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
            <?php echo $form->labelEx($model, 'category_id', array('class' => 'control-label')) ?>
            <?php
            $this->widget('Select2', array(
                'model' => $model,
                'attribute' => 'category_id',
                'data' => CHtml::listData(ProductCategory::model()->findAll(),'id','title'),
                'htmlOptions' => array('class' => "span6", 'empty'=>' '),
            ));
            ?>
        </div>
        
        <div class="control-group ">
            <?php echo $form->labelEx($model, 'date_of_product', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                    'model' => $model, //Model object
                    'attribute' => 'date_of_product', //attribute name
                    'language' => '',
                    'mode' => 'date', //use "time","date" or "datetime" (default)
                    'options' => array(
                        "dateFormat" => Yii::app()->params['dateFormat'],
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'showOtherMonths' => true, // Show Other month in jquery
                        'yearRange'=> "-100:+5",
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
            <?php echo $form->labelEx($model, 'date_sold', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                    'model' => $model, //Model object
                    'attribute' => 'date_sold', //attribute name
                    'language' => '',
                    'mode' => 'datetime', //use "time","date" or "datetime" (default)
                    'options' => array(
                        "dateFormat" => Yii::app()->params['dateFormat'],
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'showOtherMonths' => true, // Show Other month in jquery
                        'yearRange'=> "-100:+5",
                    ), // jquery plugin options
                    'htmlOptions' => array(
                        'style' => 'height:20px;',
                        'class' => 'span8',
                    ),
                ));
                ?>
            </div>
        </div>
    
        <?php echo $form->textFieldRow($model,'city',array('class'=>'span8','maxlength'=>255)); ?>
    
        <?php echo $form->textFieldRow($model,'full_name',array('class'=>'span8','maxlength'=>255)); ?>
    
        <?php echo $form->textFieldRow($model,'email',array('class'=>'span8','maxlength'=>255)); ?>
    
        <?php echo $form->textFieldRow($model,'phone',array('class'=>'span8','maxlength'=>255)); ?>
    
        <?php echo $form->textFieldRow($model,'comunicator',array('class'=>'span8')); ?>
    
        <?php echo $form->textFieldRow($model,'comunicator2',array('class'=>'span8')); ?>
    
        <?php //echo $form->textFieldRow($model,'approved',array('class'=>'span8')); ?>
    
    </div>
    
    <div class="well dis_tab">
        
        <?php echo $form->textAreaRow($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
        
        <?php echo $form->radioButtonListRow($model,'sell_donate',array('0'=>'Sell', '1'=>'Donate'),array('onchange'=>'sellDonate(this.value)')); ?>
        
        <?php echo $form->textFieldRow($model,'price',array('class'=>'span8','maxlength'=>10,'append'=>'$')); ?>
        
        <div class="clear"></div>
    
        <?php echo $form->checkBoxRow($model,'use_msg_only'); ?>
        
        <?php echo $form->checkboxRow($model,'sold'); ?>
        
    </div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<script>
	function sellDonate(val)
	{
		if(val==1)
		{
			document.getElementById('Product_price').value=0;
			document.getElementById('Product_price').readOnly=true;
		}
		else
		{
			document.getElementById('Product_price').readOnly="";
		}
	}
</script>