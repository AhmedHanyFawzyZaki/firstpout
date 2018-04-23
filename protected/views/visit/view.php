<?php
$this->breadcrumbs=array(
	'Visits'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Visit "'. $model->title.'"'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'baby_id'=>array(
			'name'=>'baby_id',
			'value'=>$model->baby->username,
			'type'=>'raw',
		),
		'date_of_visit',
		'doctor_id'=>array(
			'name'=>'doctor_id',
			'value'=>$model->doctor->username,
		),
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'note',
		'diagonise',
		'medication',
		'desage',
		'frequency',
		'bage_on',
		'prescription',
		//'next_medication',
		//'realized',
		//'date_created',
		//'date_updated',
	),
)); ?>
