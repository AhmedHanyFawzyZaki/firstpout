<?php
$this->breadcrumbs=array(
	'Chats'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Chat','url'=>array('index')),
	array('label'=>'Create Chat','url'=>array('create')),
	array('label'=>'Update Chat','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Chat','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Chat #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'from_id',
		'to_id',
		'msg',
		'msg_type',
		'seen',
		'date_created',
		'admin',
		'fav',
		'imp',
		'show',
	),
)); ?>
