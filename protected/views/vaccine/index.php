<?php
$this->breadcrumbs=array(
	'Vaccines'=>array('index'),
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
	$.fn.yiiGridView.update('vaccine-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Vaccines';?>

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
	'id'=>'vaccine-grid',
	'type'=>'striped  condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'title',
		'date_of_vaccine',
		'visit_id'=>array(
			'name'=>'visit_id',
			'value'=>'$data->visit->title',
			'type'=>'raw',
			'filter'=>CHtml::listData(Visit::model()->findAll(),'id','title'),
		),
		'baby_id'=>array(
			'name'=>'baby_id',
			'value'=>'$data->baby->username',
			'type'=>'raw',
			'filter'=>CHtml::listData(Baby::model()->findAll(),'id','username'),
		),
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>'$data->user->username',
			'type'=>'raw',
			'filter'=>Helper::ListUsers(),
		),
                'country_id'=>array(
			'name'=>'country_id',
			'value'=>'$data->country->country_name',
			'type'=>'raw',
			'filter'=>CHtml::listData(AllCountries::model()->findAll(),'country_id','country_name'),
		),
		'realized'=>array(
			'name'=>'realized',
			'value'=>'Helper::GetStatus($data->realized,"Realized","Unrealized")',
			'filter'=>array('0'=>'Unrealized','1'=>'Realized')
		),
		//'desc',
		//'next_vaccine_id',
		/*
		'realized',
		'user_id',
		'baby_id',
		'date_created',
		'date_updated',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
