<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'baby-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
        ));
?>
<script src="<?=Yii::app()->request->baseUrl?>/js/select2/select2.js"></script>
<link href="<?=Yii::app()->request->baseUrl?>/js/select2/select2.css" rel="stylesheet">
    <?php
    echo $form->dropDownListRow($model,'user_id',  Helper::ListUsers(),array('options'=>Helper::listUsersImages()));
?>

<script>
    $(document).ready(function() {
        /*setTimeout(function() {
         $("#Baby_user_id").select2("readonly", true);
         }, 10);*/
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

            return "<img class='pull-left' width='40' height='40' src='"+$(originalOption).attr('image')+"'/><span class='pull-left'>" + state.text+"</span>";
        }
    });
</script>


<!--<div class="control-group ">
        <?php /*echo $form->labelEx($model, 'user_id', array('class' => 'control-label')) ?>
        <?php
        $this->widget('Select2', array(
            'model' => $model,
            'attribute' => 'user_id',
            'data' => Helper::ListUsers(),
            'htmlOptions' => array('class' => "span6", 'empty' => ' '),
        ));*/
        ?>
    </div>-->
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

<?php $this->endWidget(); ?>