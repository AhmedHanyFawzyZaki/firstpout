<?php
$this->breadcrumbs=array(
	'Post Medias'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PostMedia','url'=>array('index')),
	array('label'=>'Create PostMedia','url'=>array('create')),
	array('label'=>'Update PostMedia','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete PostMedia','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View PostMedia #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'post_id',
		'media',
	),
)); ?>
