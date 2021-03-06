<?php
$this->breadcrumbs=array(
	'Baby Families'=>array('index'),
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
	$.fn.yiiGridView.update('baby-family-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Baby Families';?>

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
	'id'=>'baby-family-grid',
	'type'=>'striped  condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>'$data->user->username',
			'filter'=>Helper::ListUsers(),
		),
		'baby_id'=>array(
			'name'=>'baby_id',
			'value'=>'$data->baby->username',
			'filter'=>Helper::ListBaby(),
		),
		'connection_id'=>array(
			'name'=>'connection_id',
			'value'=>'$data->connection->title',
			'filter'=>  CHtml::listData(Connection::model()->findAll(),'id','title'),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
