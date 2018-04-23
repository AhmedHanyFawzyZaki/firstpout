<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => true,
    'type' => 'horizontal',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>


<p class="help-block">Fields with <span class="required">*</span> are required.</p><br><br>

<?php echo $form->errorSummary($model); ?>

<?php
$hosp = '';
if (!$model->isNewRecord && $model->groups_id == 3) {
    $hosp = 'hosp';
}
?>

<div class="well dis_tab">

    <div class="control-group">
        <?php echo $form->labelEx($model, 'groups_id', array('class' => 'control-label')) ?>
        <?php
        $this->widget('Select2', array(
            'model' => $model,
            'attribute' => 'groups_id',
            'data' => UserGroups::model()->getGroups(),
            'htmlOptions' => array('class' => "span6", 'onchange' => 'toggleHospital(this.value)'),
        ));
        ?>
    </div>

    <?php echo $form->textFieldRow($model, 'fname', array('class' => 'span8', 'maxlength' => 50)); ?>
    <?php echo $form->textFieldRow($model, 'lname', array('class' => 'span8', 'maxlength' => 50)); ?>
    <?php echo $form->textFieldRow($model, 'username', array('class' => 'span8', 'maxlength' => 100)); ?>
    <?php echo $form->textFieldRow($model, 'email', array('class' => 'span8', 'maxlength' => 50)); ?>

    <?php
    if ($model->isNewRecord) {
        echo '<div class="ch ' . $hosp . '">' . $form->passwordFieldRow($model, 'password', array('class' => 'span8', 'maxlength' => 90)) . '</div>';
    }
    ?>

    <div class="control-group ch <?= $hosp ?>">
        <?php echo $form->labelEx($model, 'gender', array('class' => 'control-label')) ?>
        <?php
        $this->widget('Select2', array(
            'model' => $model,
            'attribute' => 'gender',
            'data' => array('1' => 'Male', '2' => 'Female'), //array('1'=>'Male','2'=>'Female','3'=>'Other'),
            'htmlOptions' => array('class' => "span6"),
        ));
        ?>
    </div>

    <div class="control-group ch <?= $hosp ?>">
        <?php echo $form->labelEx($model, 'connection_id', array('class' => 'control-label')) ?>
        <?php
        $this->widget('Select2', array(
            'model' => $model,
            'attribute' => 'connection_id',
            'data' => CHtml::listData(Connection::model()->findAll(), 'id', 'title'),
            'htmlOptions' => array('class' => "span6"),
        ));
        ?>
    </div>

    <div class="control-group ch <?= $hosp ?>">
        <?php echo $form->labelEx($model, 'date_of_birth', array('class' => 'control-label')) ?>
        <div class="controls">
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model, //Model object
                'attribute' => 'date_of_birth', //attribute name
                'language' => '',
                'mode' => 'date', //use "time","date" or "datetime" (default)
                'options' => array(
                    "dateFormat" => Yii::app()->params['dateFormat'],
                    'changeMonth' => 'true',
                    'changeYear' => 'true',
                    'showOtherMonths' => true, // Show Other month in jquery
                    'yearRange' => "-100:+0",
                ), // jquery plugin options
                'htmlOptions' => array(
                    'style' => 'height:20px;',
                    'class' => 'span8',
                ),
            ));
            ?>
        </div>
    </div>

    <?php echo $form->textFieldRow($model, 'phone', array('class' => 'span8', 'maxlength' => 255)); ?>

    <?php echo $form->textFieldRow($model, 'street', array('class' => 'span8', 'maxlength' => 255)); ?>

    <?php echo $form->textFieldRow($model, 'city', array('class' => 'span8', 'maxlength' => 255)); ?>

    <?php echo $form->textFieldRow($model, 'post_code', array('class' => 'span8', 'maxlength' => 255)); ?>

    <?php echo $form->textFieldRow($model, 'country', array('class' => 'span8', 'maxlength' => 255)); ?>

    <?php echo $form->checkBoxRow($model, 'active'); ?>

</div>

<div class="well dis_tab ch <?= $hosp ?>" style="width: 96.5%;">
    <!--<div class="control-group " style="width: 100%;">
    <?php //echo $form->labelEx($model, 'banner', array('class' => 'control-label'))  ?>
    <?php //echo $form->hiddenField($model, 'banner') ?>
        <div class="controls">
    <?php
    /* if (!$model->isNewRecord && $model->banner) {
      echo '<div id="bannerCandy"><img src="' . $model->banner . '" class="croppedImg"></div>';
      } else {
      echo '<div id="bannerCandy"></div>';
      } */
    ?>
        </div>
    </div>-->

    <div class="control-group " >
        <?php echo $form->labelEx($model, 'image', array('class' => 'control-label')) ?>
        <?php echo $form->hiddenField($model, 'image') ?>
        <div class="controls">
            <?php
            if (!$model->isNewRecord && $model->image) {
                echo '<div id="cropContainerEyecandy"><img src="' . $model->image . '" class="croppedImg"></div>';
            } else {
                echo '<div id="cropContainerEyecandy"></div>';
            }
            ?>
        </div>
    </div>

    <?php echo $form->textAreaRow($model, 'desc', array('rows' => 8, 'cols' => 50, 'class' => 'span8')); ?>
</div>

<div class="clear form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
    <?php
    if (!$model->isNewRecord && $model->groups_id != 3) {
        echo '<a href="' . Yii::app()->request->baseUrl . '/user/changePassword/' . $model->id . '" class="btn btn-info s_frame">Change Password</a>';
    }
    ?>
</div>

<?php $this->endWidget(); ?>
<script>
    function toggleHospital(val)
    {
        if (val == 3)
        {
            $('.ch').each(function (index, element) {
                element.style.display = "none";
            });
        }
        else
        {
            $('.ch').each(function (index, element) {
                element.style.display = "table";
            });
        }
    }
</script>