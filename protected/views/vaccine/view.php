<?php
$this->breadcrumbs=array(
	'Vaccines'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Vaccine "'. $model->title.'"'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'date_of_vaccine',
		'desc',
		'next_vaccine_id'=>array(
			'name'=>'next_vaccine_id',
			'value'=>$model->nextVaccine->title,
		),
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'baby_id'=>array(
			'name'=>'baby_id',
			'value'=>$model->baby->username,
		),
		'visit_id'=>array(
			'name'=>'visit_id',
			'value'=>$model->visit->title,
		),
                'country_id'=>array(
			'name'=>'country_id',
			'value'=>$model->country->country_name,
		),
		'realized'=>array(
			'name'=>'realized',
			'value'=>Helper::GetStatus($model->realized,"Realized","Unrealized")
		),
		'date_created',
		'date_updated',
	),
)); ?>
