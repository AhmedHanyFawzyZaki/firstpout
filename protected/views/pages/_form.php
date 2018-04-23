<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'pages-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'type' => 'vertical',
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 255)); ?>

<div class="clear"></div>

<?php
echo '<div class="control-group"';
echo $form->labelEx($model, 'intro', array('rows' => 6, 'cols' => 100));
echo '<div class="controls">';
$this->widget('application.extensions.eckeditor.ECKEditor', array(
    'model' => $model,
    'attribute' => 'intro',
));
echo '</div></div>';
?>

<div class="clear"></div>

<?php
echo '<div class="control-group"';
echo $form->labelEx($model, 'details', array('rows' => 6, 'cols' => 100));
echo '<div class="controls">';
$this->widget('application.extensions.eckeditor.ECKEditor', array(
    'model' => $model,
    'attribute' => 'details',
));
echo '</div></div>';
?>

<div class="clear"></div>

<?php
echo $form->checkBoxRow($model, 'publish');
?>

<div class="form-actions clear">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
