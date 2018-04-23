<?php
$this->breadcrumbs=array(
	'Baby Access Roles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create BabyAccessRole';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>