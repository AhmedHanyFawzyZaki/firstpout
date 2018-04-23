<?php
$this->breadcrumbs=array(
	'Appointments'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Appointment "'. $model->title.'"'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'baby_id'=>array(
			'name'=>'baby_id',
			'value'=>$model->baby->username,
		),
		'doctor_id'=>array(
			'name'=>'doctor_id',
			'value'=>$model->doctor->username,
		),
		'hospital_id'=>array(
			'name'=>'hospital_id',
			'value'=>$model->hospital->username,
		),
		'visit_id'=>array(
			'name'=>'visit_id',
			'value'=>$model->visit->title,
		),
		
		//'realized',
		'date_of_visit',
		'date_created',
		'date_updated',
	),
)); ?>
