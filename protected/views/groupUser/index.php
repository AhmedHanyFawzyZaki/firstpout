<?php
$this->breadcrumbs=array(
	'Group Users'=>array('index'),
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
	$.fn.yiiGridView.update('group-user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Group Users';?>

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
	'id'=>'group-user-grid',
	'type'=>'striped  condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'group_id'=>array(
			'name'=>'group_id',
			'value'=>'$data->group->title',
			'type'=>'raw',
			'filter'=>CHtml::listData(Group::model()->findAll(),'id','title'),
		),
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>'$data->user->username',
			'type'=>'raw',
			'filter'=>Helper::ListUsers(),
		),
		'role'=>array(
			'name'=>'role',
			'value'=>'Helper::GetStatus($data->role,"Administrator","User")',
			'filter'=>array("0"=>'User','1'=>'Administrator'),
		),
		'date_created',
		//'date_created',
		/*
		'date_updated',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
