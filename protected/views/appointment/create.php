<?php
$this->breadcrumbs=array(
	'Appointments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Appointment';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>