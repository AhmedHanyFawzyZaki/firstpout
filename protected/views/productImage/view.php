<?php
$this->breadcrumbs=array(
	'Product Images'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View ProductImage "'. $model->product->title.'\'s Images"'; ?>

<?php
$imageUrl=Yii::app()->request->baseUrl.'/media/products/';
?>


<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'product_id'=>array(
			'name'=>'product_id',
			'value'=>$model->product->title,
		),
		'image'=>array(
			'name'=>'image',
			'type'=>'raw',
			'value'=>CHtml::image($imageUrl.$model->image,"No Image", array("style"=>"width:100px")),
			'filter'=>''
		),
		'main_image'=>array(
			'name'=>'main_image',
			'value'=>Helper::getStatus($model->main_image),
		),
	),
)); ?>
