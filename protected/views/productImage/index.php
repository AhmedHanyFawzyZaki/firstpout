<?php
$this->breadcrumbs=array(
	'Product Images'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-image-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Product Images';?>

<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php
$imageUrl=Yii::app()->request->baseUrl.'/media/products/';
?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'product-image-grid',
	'type'=>'striped  condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'product_id'=>array(
			'name'=>'product_id',
			'value'=>'$data->product->title',
			'filter'=>CHtml::listData(Product::model()->findAll(),'id','title'),
		),
		'image'=>array(
			'name'=>'image',
			'type'=>'raw',
			'value'=>'CHtml::image("'.$imageUrl.'$data->image","No Image", array("style"=>"width:100px"))',
			'filter'=>''
		),
		'main_image'=>array(
			'name'=>'main_image',
			'value'=>'Helper::getStatus($data->main_image)',
			'filter'=>array('0'=>'No','1'=>'Yes'),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
