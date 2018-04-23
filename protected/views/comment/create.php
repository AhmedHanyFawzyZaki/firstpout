<?php
$this->breadcrumbs=array(
	'Comments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Comment';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>