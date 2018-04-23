<?php
$this->breadcrumbs=array(
	'Baby Families'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View "'. $model->baby->username.'"\'s Family Member'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'baby_id'=>array(
			'name'=>'baby_id',
			'value'=>$model->baby->username,
		),
		'connection_id'=>array(
			'name'=>'connection_id',
			'value'=>$model->connection->title,
		),
	),
)); ?>
