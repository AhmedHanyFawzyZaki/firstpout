<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Post "'. $model->title.'"'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'baby_id'=>array(
			'name'=>'baby_id',
			'value'=>$model->baby->username,
		),
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'title',
		'content'=>array(
			'name'=>'content',
			'type'=>'raw',
			'value'=>$model->content?$model->content:'<span class="null">No Text</span>',
		),
		array(
				'name'=>'image',
				'type'=>'raw',
				'value'=>CHtml::image(Yii::app()->request->baseUrl.'/media/posts/'.$model->image,'No Image',array('width'=>150)),
		),
		'image_date_taken'=>array(
			'name'=>'image_date_taken',
			'type'=>'raw',
			'value'=>$model->image_date_taken !='0000-00-00 00:00:00'? $model->image_date_taken:'<span class="null">No Image</span>',
		),
		'video'=>array(
			'name'=>'video',
			'type'=>'raw',
			'value'=>Helper::ShowVideo($model->video),
		),
		'date_created',
		'date_updated',
	),
)); ?>
