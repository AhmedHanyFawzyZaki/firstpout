<?php
$this->breadcrumbs=array(
	'Baby Doctor Hospitals'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Baby Doctor & Hospital #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'baby_id'=>array(
			'name'=>'baby_id',
			'value'=>$model->baby->username,
		),
                'doctor_id'=>array(
			'name'=>'doctor_id',
			'value'=>$model->doctor->username,
		),
		'is_hospital'=>array(
                    'name'=>'is_hospital',
                    'value'=>  Helper::GetStatus($model->is_hospital, "Yes", "No")
                ),
	),
)); ?>
