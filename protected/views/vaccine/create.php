<?php
$this->breadcrumbs=array(
	'Vaccines'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Vaccine';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>