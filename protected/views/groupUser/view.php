<?php
$this->breadcrumbs=array(
	'Group Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View GroupUser '; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'group_id'=>array(
			'name'=>'group_id',
			'value'=>$model->group->title,
		),
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'role'=>array(
			'name'=>'role',
			'value'=>Helper::GetStatus($model->role,"Administrator","User"),
		),
		'date_created',
	),
)); ?>
