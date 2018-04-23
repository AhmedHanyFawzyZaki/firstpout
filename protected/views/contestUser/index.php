<?php
$this->breadcrumbs=array(
	'Contest Users'=>array('index'),
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
	$.fn.yiiGridView.update('contest-user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Contest Users';?>

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
	'id'=>'contest-user-grid',
	'type'=>'striped  condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'contest_id'=>array(
			'name'=>'contest_id',
			'value'=>'$data->contest->title',
			'type'=>'raw',
			'filter'=>CHtml::listData(Contest::model()->findAll(),'id','title'),
		),
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>'$data->user->username',
			'type'=>'raw',
			'filter'=>Helper::ListUsers(),
		),
                'baby_id'=>array(
			'name'=>'baby_id',
			'value'=>'$data->baby->username?$data->baby->username:"<span style=\"color:red\">User Album</span>"',
			'type'=>'raw',
			'filter'=>Helper::ListBaby(),
		),
		'date_joined',
		'num_of_votes',
                'num_of_likes',
		'winner'=>array(
			'name'=>'winner',
			'type'=>'raw',
			'value'=>'"<span style=\"color:red\">'.Helper::GetStatus($data->winner,"Winner","No").'</span>"',
			'filter'=>array('0'=>'No','1'=>'Yes'),
		),
		/*
		'winner',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
