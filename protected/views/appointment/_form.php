<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'appointment-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="well">
    <?php echo $form->textFieldRow($model, 'title', array('class' => 'span8', 'maxlength' => 255)); ?>

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
                    'yearRange' => "-10:+5",
                ), // jquery plugin options
                'htmlOptions' => array(
                    'style' => 'height:20px;',
                    'class' => 'span8',
                ),
            ));
            ?>
        </div>
    </div>
</div>

<div class="well dis_tab widt96per">
    <div class="control-group ">
        <?php echo $form->labelEx($model, 'baby_id', array('class' => 'control-label')) ?>
        <?php
        $this->widget('Select2', array(
            'model' => $model,
            'attribute' => 'baby_id',
            'data' => CHtml::listData(Baby::model()->findAll(), 'id', 'username'),
            'htmlOptions' => array('class' => "span6", 'empty' => ' '),
        ));
        ?>
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
    <div class="control-group ">
        <?php echo $form->labelEx($model, 'visit_id', array('class' => 'control-label')) ?>
        <?php
        $this->widget('Select2', array(
            'model' => $model,
            'attribute' => 'visit_id',
            'data' => CHtml::listData(Visit::model()->findAll(), 'id', 'title'),
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
            'data' => CHtml::listData(User::model()->findAll(array('condition' => 'groups_id=2')), 'id', 'username'),
            'htmlOptions' => array('class' => "span6", 'empty' => ' '),
        ));
        ?>
    </div>
    <div class="control-group ">
        <?php echo $form->labelEx($model, 'hospital_id', array('class' => 'control-label')) ?>
        <?php
        $this->widget('Select2', array(
            'model' => $model,
            'attribute' => 'hospital_id',
            'data' => CHtml::listData(User::model()->findAll(array('condition' => 'groups_id=3')), 'id', 'username'),
            'htmlOptions' => array('class' => "span6", 'empty' => ' '),
        ));
        ?>
    </div>

</div>

<?php //echo $form->textFieldRow($model,'realized',array('class'=>'span5'));  ?>

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
