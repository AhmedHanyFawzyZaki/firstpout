<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Create','url'=>array('create')),
);
?>



<?php $this->pageTitlecrumbs = 'View Page "'.$model->title.'"';?> 

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(

		'title',
		array(
			'name'=>'publish',
			'value'=>$model->getStatus($model->publish),
		),
		array(
			'name'=>'intro',
			'type'=>'raw',
		),
		array(
			'name'=>'details',
			'type'=>'raw',
		),
	),
)); ?>


