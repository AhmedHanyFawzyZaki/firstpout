<?php
$this->breadcrumbs=array(
	'Contest Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create ContestUser';?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'model_image'=>$model_image)); ?>