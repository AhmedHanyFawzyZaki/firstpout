<?php
$this->breadcrumbs=array(
	'Visits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Visit';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>