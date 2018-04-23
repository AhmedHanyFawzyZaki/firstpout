<?php
$this->breadcrumbs=array(
	'Connection Categories'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ConnectionCategory','url'=>array('index')),
	array('label'=>'Create ConnectionCategory','url'=>array('create')),
	array('label'=>'Update ConnectionCategory','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ConnectionCategory','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View ConnectionCategory '; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
	),
)); ?>
