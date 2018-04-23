<?php
$this->breadcrumbs=array(
	'Sun Signs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create SunSign';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>