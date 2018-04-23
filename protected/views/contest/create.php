<?php
$this->breadcrumbs=array(
	'Contests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Contest';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>