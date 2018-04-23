<?php
$this->breadcrumbs=array(
	'User Friends'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create UserFriend';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>