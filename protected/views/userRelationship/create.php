<?php
$this->breadcrumbs=array(
	'User Relationships'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create UserRelationship';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>