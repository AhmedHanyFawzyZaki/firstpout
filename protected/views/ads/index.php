<?php
$this->breadcrumbs=array(
	'Ads'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Ads','url'=>array('index')),
	array('label'=>'Create Ads','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ads-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Ads';?>

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

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'ads-grid',
	'type'=>'striped  condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'title',
		'content',
		'url',
		'image'=>array(
			'header'=>'image',
			'type'=>'html',
			'filter'=>'',
			'value'=>'(!empty($data->image))?CHtml::image(Yii::app()->request->baseUrl."/media/ads/".$data->image,"",array("style"=>"width:100px;height:75px;")):"no image"',
		) ,
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
