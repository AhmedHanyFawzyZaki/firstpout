<?php
$this->breadcrumbs=array(
	'Babies'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Baby "'. $model->username.'"'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'user_id',
			'value'=>$model->user->username
		),
		'username',
		array(
			'name'=>'gender',
			'value'=>Helper::GetGender($model->gender)
		),
		'date_of_birth',
		'birth_place',
		'date_of_pergacy',
		array(
			'name'=>'sun_sign',
			'value'=>$model->sunSign->title
		),
		'blood_type',
		'height',
		'weight',
		'body_mass',
		'date_created',
		'date_updated',
		array(
			'name'=>'image',
			'type'=>'raw',
			'value'=>CHtml::image($model->image,"No Profile Image"),
		),
		array(
			'name'=>'banner',
			'type'=>'raw',
			'value'=>CHtml::image($model->banner,"No Profile Banner",array('class'=>'img-var')),
		),
		
	),
)); ?>


<!--Who can access baby profile-->
<div class="clear topMargin30">
    <header class="acc_col_head navy-bg">
        <div class="icons"><i class="icon-eye-open"></i></div>
        <h5>Who can access <?=$model->username?>'s profile</h5>
        <div class="toolbar">
            <ul class="nav">
                <li class="widthAuto">
                    <a class="fancyElm" href="<?=Yii::app()->request->baseUrl?>/babyAccessRole/create?baby=<?=$model->id?>">
                        <i class="icon-plus-sign-alt"></i>
                    </a>
                </li>
                <li class="widthAuto">
                    <a href="#access" data-toggle="collapse" class="accordion-toggle minimize-box collapsed">
                        <i class="icon-chevron-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="collapse" style="height: 0px;" id="access">
    	<?php $this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'baby-access-role-grid',
	'type'=>'striped  condensed',
			'dataProvider'=>new CActiveDataProvider('BabyAccessRole', array(
				'criteria' => array('condition'=>'baby_id='.$model->id),
			)),
			'columns'=>array(
				'user_id'=>array(
					'name'=>'user_id',
					'value'=>'$data->user->username',
					'filter'=>Helper::ListUsers(),
				),
				'role'=>array(
					'name'=>'role',
					'value'=>'Helper::GetStatus($data->role,"Read/Write","Read")',
					'filter'=>array('0'=>'Read','1'=>'Read/Write'),
				),
			),
		)); ?>
    </div>
</div>

<!--Baby Family-->
<div class="clear topMargin30">
    <header class="acc_col_head navy-bg">
        <div class="icons"><i class="icon-eye-open"></i></div>
        <h5><?=$model->username?>'s Family</h5>
        <div class="toolbar">
            <ul class="nav">
                <li class="widthAuto">
                    <a class="fancyElm" href="<?=Yii::app()->request->baseUrl?>/babyFamily/create?baby=<?=$model->id?>">
                        <i class="icon-plus-sign-alt"></i>
                    </a>
                </li>
                <li class="widthAuto">
                    <a href="#family" data-toggle="collapse" class="accordion-toggle minimize-box collapsed">
                        <i class="icon-chevron-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="collapse" style="height: 0px;" id="family">
    	<?php $this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'baby-access-role-grid',
                        'type'=>'striped  condensed',
			'dataProvider'=>new CActiveDataProvider('BabyFamily', array(
				'criteria' => array('condition'=>'baby_id='.$model->id),
			)),
			'columns'=>array(
                                'user_id'=>array(
                                    'name'=>'user_id',
                                    'value'=>'$data->user->username',
                                    'filter'=>Helper::ListUsers(),
				),
				'connection_id'=>array(
                                    'name'=>'connection_id',
                                    'value'=>'$data->connection->title',
                                    'filter'=>  Connection::model()->findAll(),
				),
			),
		)); ?>
    </div>
</div>

<!--Baby doctors and hospitals-->
<div class="clear topMargin30">
    <header class="acc_col_head navy-bg">
        <div class="icons"><i class="icon-eye-open"></i></div>
        <h5><?=$model->username?>'s Doctors and Hospitals</h5>
        <div class="toolbar">
            <ul class="nav">
                <li class="widthAuto">
                    <a class="fancyElm" href="<?=Yii::app()->request->baseUrl?>/babyDoctorHospital/create?baby=<?=$model->id?>">
                        <i class="icon-plus-sign-alt"></i>
                    </a>
                </li>
                <li class="widthAuto">
                    <a href="#doc" data-toggle="collapse" class="accordion-toggle minimize-box collapsed">
                        <i class="icon-chevron-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="collapse" style="height: 0px;" id="doc">
    	<?php $this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'baby-access-role-grid',
                        'type'=>'striped  condensed',
			'dataProvider'=>new CActiveDataProvider('BabyDoctorHospital', array(
				'criteria' => array('condition'=>'baby_id='.$model->id),
			)),
			'columns'=>array(
				
                                'doctor_id'=>array(
                                        'name'=>'doctor_id',
                                        'value'=>'$data->doctor->username',
                                ),
                                'is_hospital'=>array(
                                    'name'=>'is_hospital',
                                    'value'=>  'Helper::GetStatus($data->is_hospital, "Yes", "No")',
                                ),
			),
		)); ?>
    </div>
</div>