<?php
$this->breadcrumbs=array(
	'Sun Signs'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'View','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update SunSign #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>