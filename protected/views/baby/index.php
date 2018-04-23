<?php
$this->breadcrumbs=array(
	'Babies'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('baby-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Babies';?>

<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/select2/select2.js"></script>
<link href="<?=Yii::app()->request->baseUrl?>/js/select2/select2.css" rel="stylesheet"/>
<script>$(document).ready(function() { $('[name="Baby[user_id]"]').select2(); });</script>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'baby-grid',
	'type'=>'striped  condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
		//'id',
		'username',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>'$data->user->username',
			'filter'=>Helper::ListUsers(),
		),
		'gender'=>array(
			'name'=>'gender',
			'value'=>Helper::GetGender($model->gender),
			'filter'=>array('1'=>'Male','2'=>'Female','3'=>'Other')
		),
		array(
            'name' => 'date_of_birth',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model, 
                'attribute'=>'date_of_birth', 
                'language' => 'ja',
                'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
                'htmlOptions' => array(
                    'id' => 'datepicker_for_due_date',
                    'size' => '10',
                ),
                'defaultOptions' => array(  // (#3)
                    'showOn' => 'focus', 
                    'dateFormat' => 'yy-mm-dd',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
					'yearRange'=> "-100:+5",
                )
            ), 
            true), // (#4)
        ),
		//'birth_place',
		/*
		'date_of_pergacy',
		'image',
		'banner',
		'sun_sign',
		'blood_type',
		'height',
		'weight',
		'body_mass',
		'date_created',
		'date_updated',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
));
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_due_date').datepicker();
	$('[name=\"Baby[user_id]\"]').select2();
}
");
 ?>
