<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'baby-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="well dis_tab" >
    <div class="control-group" style="width: 96.5%;">
            <?php echo $form->labelEx($model, 'banner', array('class' => 'control-label')) ?>
            <?php echo $form->hiddenField($model, 'banner') ?>
        <div class="controls">
            <?php
            if (!$model->isNewRecord && $model->banner) {
                echo '<div id="babyBannerCandy"><img src="' . $model->banner . '" class="croppedImg"></div>';
            } else {
                echo '<div id="babyBannerCandy"></div>';
            }
            ?>
        </div>
    </div>

    <div class="control-group " >
            <?php echo $form->labelEx($model, 'image', array('class' => 'control-label')) ?>
            <?php echo $form->hiddenField($model, 'image') ?>
        <div class="controls">
            <?php
            if (!$model->isNewRecord && $model->image) {
                echo '<div id="babyImageCandy"><img src="' . $model->image . '" class="croppedImg"></div>';
            } else {
                echo '<div id="babyImageCandy"></div>';
            }
            ?>
        </div>
    </div>
</div>

<div class="well dis_tab">
    <?php
        //echo $form->dropDownListRow($model,'user_id',  Helper::ListUsers(),array('options'=>Helper::listUsersImages(),'class'=>'span8','style'=>'height:50px;'));
    ?>
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
    <!--<div id="search">
        <?php/*
        $this->widget('ext.myAutoComplete', array(
            'id'  => 'searchbox',
            'name'=> 'autoComplete',
            'source'=>'js: function(request, response) {
            $.ajax({
                url: "'.$this->createUrl('home/autoComplete').'",
                dataType: "json",
                data: {
                    term: request.term,
                    brand: $("#type").val()
                },
                success: function (data) {
                    response(data);
                }
            })
            }',
            'options' => array(
                'showAnim' => 'fold',
            ),
            'htmlOptions' => array(
                'placeholder' => "User",
            ),
            'methodChain'=>'.data( "autocomplete" )._renderItem = function( ul, item ) {
                return $( "<div class=\'drop_class\'></div>" )
                    .data( "item.autocomplete", item )
                    .append( "<a href=\'" + item.id + "\' style=\'display:table;width:94%;\'><div style=\'width:28%; float:left;\'><img height=50 width=50 src=\'" + item.image + "\'></div><div style=\'width:72%;float:left;\'>" +item.username +  "</div></a>" )
                    .append("<div style=\'clear:both;\'></div>")
                    .appendTo( ul );
            };'
        ));*/
        ?>
    </div>-->
    

        <?php echo $form->textFieldRow($model, 'username', array('class' => 'span8', 'maxlength' => 255)); ?>

    <div class="control-group ">
        <?php echo $form->labelEx($model, 'gender', array('class' => 'control-label')) ?>
        <?php
        $this->widget('Select2', array(
            'model' => $model,
            'attribute' => 'gender',
            'data' => array('1' => 'Male', '2' => 'Female', '3' => 'Other'),
            'htmlOptions' => array('class' => "span6"),
        ));
        ?>
    </div>

    <div class="control-group ">
            <?php echo $form->labelEx($model, 'date_of_birth', array('class' => 'control-label')) ?>
        <div class="controls">
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model, //Model object
                'attribute' => 'date_of_birth', //attribute name
                'language' => '',
                'mode' => 'datetime', //use "time","date" or "datetime" (default)
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

    <?php echo $form->textFieldRow($model, 'birth_place', array('class' => 'span8', 'maxlength' => 255)); ?>
    
    <?php echo $form->textFieldRow($model, 'date_of_pergacy', array('class' => 'span8', 'maxlength' => 255, 'placeholder'=>'months-days')); ?>

    <!--<div class="control-group ">
            <?php echo $form->labelEx($model, 'date_of_pergacy', array('class' => 'control-label')) ?>
        <div class="controls">
            <?php
            /*$this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model, //Model object
                'attribute' => 'date_of_pergacy', //attribute name
                'language' => '',
                'mode' => 'datetime', //use "time","date" or "datetime" (default)
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
            ));*/
            ?>
        </div>
    </div>-->
</div>

<div class="well dis_tab">
    <div class="control-group ">
        <?php echo $form->labelEx($model, 'sun_sign', array('class' => 'control-label')) ?>
        <?php
        $this->widget('Select2', array(
            'model' => $model,
            'attribute' => 'sun_sign',
            'data' => CHtml::listData(SunSign::model()->findAll(), 'id', 'title'),
            'htmlOptions' => array('class' => "span6", 'empty' => ' '),
        ));
        ?>
    </div>

    <?php echo $form->textFieldRow($model, 'blood_type', array('class' => 'span8', 'maxlength' => 255)); ?>

    <?php echo $form->textFieldRow($model, 'height', array('class' => 'span8', 'maxlength' => 255, 'append'=>'Cm')); ?>

    <?php echo $form->textFieldRow($model, 'weight', array('class' => 'span8', 'maxlength' => 255, 'append'=>'Kg')); ?>

	<?php echo $form->textFieldRow($model, 'body_mass', array('class' => 'span8', 'maxlength' => 255, 'append'=>'BMI')); ?>
</div>

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
<?php
    if(!$model->isNewRecord){
?>
<script>
    $(document).ready(function() { setTimeout(function(){$("#Baby_user_id").select2("readonly", true);},10); });
</script>
<?php }?>

<!--<script>
    $(document).ready(function() {
        $("#Baby_user_id").select2({
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function(m) {
                return m;
            }
        });

        function format(state) {
            var originalOption = state.element;
            console.log(originalOption);
            if (!state.id)
                return state.text; // optgroup

            return "<label style='display:table;padding-top:5px;'><img class='pull-left' width='40' height='40' src='"+$(originalOption).attr('image')+"'/><span style=\'float:left;margin-left:20px;line-height:40px;\'>" + state.text+"</span></label>";;
        }
    });
</script>-->