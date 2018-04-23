<?php
$this->breadcrumbs=array(
	'Baby Doctor Hospitals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'View','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update Baby Doctor & Hospital #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>