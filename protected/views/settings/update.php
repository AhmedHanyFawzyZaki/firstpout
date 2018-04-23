<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'View','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage','url'=>array('admin')),
);
?>

<?php $this->pageTitlecrumbs = 'Update Site Settings' ?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>