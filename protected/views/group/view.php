<?php
$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Group "'. $model->title.'"'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
			'type'=>'raw',
		),
		//'category',
		'category'=>array(
			'name'=>'category',
			'value'=>$model->category0->title,
		),
		'privacy'=>array(
			'name'=>'privacy',
			'value'=>Helper::GetStatus($model->privacy,"Private","Public"),
		),
		'image'=>array(
			'name'=>'image',
			'type'=>'html',
			'value'=>(!empty($model->image))?CHtml::image($model->image,"",array("style"=>"width:100px;height:75px;")):"No image",
		),
		'date_created',
		'date_updated',
	),
)); ?>
