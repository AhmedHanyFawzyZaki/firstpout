<?php
$this->breadcrumbs=array(
	'User Friends'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View UserFriend #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'friend_id'=>array(
			'name'=>'friend_id',
			'value'=>$model->friend->username,
		),
		'approved'=>array(
			'name'=>'approved',
			'value'=>Helper::GetStatus($model->approved,'Approved', 'Not approved'),
		),
		'date_created',
	),
)); ?>
