<?php
$this->breadcrumbs=array(
	'Product Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create ProductImage';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>