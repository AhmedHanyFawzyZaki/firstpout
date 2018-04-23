<?php
$this->breadcrumbs=array(
	'Baby Families'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create BabyFamily';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>