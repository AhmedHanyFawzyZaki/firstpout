<?php
$this->breadcrumbs=array(
	'Baby Families'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'View','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update "'. $model->baby->username.'"\'s Family Member'; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>