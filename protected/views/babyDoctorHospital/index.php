<?php
$this->breadcrumbs=array(
	'Baby Doctor Hospitals'=>array('index'),
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
	$.fn.yiiGridView.update('baby-doctor-hospital-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Baby Doctor Hospitals';?>

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

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'baby-doctor-hospital-grid',
	'type'=>'striped  condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'baby_id'=>array(
                        'name'=>'baby_id',
                        'value'=>'$data->baby->username',
                        'filter'=>Helper::ListBaby(),
                ),
                'doctor_id'=>array(
                        'name'=>'doctor_id',
                        'value'=>'$data->doctor->username',
                        'filter'=>Helper::ListDoctorsAndHospitals(),
                ),
                'is_hospital'=>array(
                    'name'=>'is_hospital',
                    'value'=>  'Helper::GetStatus($data->is_hospital, "Yes", "No")',
                    'filter'=>array('1'=>'Yes','0'=>'No'),
                ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
