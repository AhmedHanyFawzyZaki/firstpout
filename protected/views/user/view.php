<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username.' Profile',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View User "'. $model->username.'"'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'groups_id',
			'type'=>'raw',
			'value'=>$model->usergroup->group_title
		),
		'username',
		'fname',
		'lname',
		array(
			'name'=>'connection_id',
			'type'=>'raw',
			'value'=>$model->connection->title
		),
		'email',
		'phone',
		'date_of_birth',
		'desc',
		'city',
		'street',
		'post_code',
		'country',
		'date_created',
		'date_updated',
		array(
			'name'=>'image',
			'type'=>'raw',
			'value'=>CHtml::image($model->image,"No Profile Image"),
		),
		/*array(
			'name'=>'banner',
			'type'=>'raw',
			'value'=>CHtml::image($model->banner,"No Profile Banner",array('class'=>'img-var')),
		),*/
		
	),
)); ?>

<?php
    if($model->groups_id=='1'){
?>
<!--User Relationships-->
<div class="clear topMargin30">
    <header class="acc_col_head navy-bg">
        <div class="icons"><i class="icon-eye-open"></i></div>
        <h5><?=$model->username?>'s Relationships</h5>
        <div class="toolbar">
            <ul class="nav">
                <li class="widthAuto">
                    <a class="fancyElm" href="<?=Yii::app()->request->baseUrl?>/UserRelationship/create?user=<?=$model->id?>">
                        <i class="icon-plus-sign-alt"></i>
                    </a>
                </li>
                <li class="widthAuto">
                    <a href="#rs" data-toggle="collapse" class="accordion-toggle minimize-box collapsed">
                        <i class="icon-chevron-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="collapse" style="height: 0px;" id="rs">
    	<?php $this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'user-relationship-grid',
			'type'=>'striped  condensed',
			'dataProvider'=>new CActiveDataProvider('UserRelationship', array(
				'criteria' => array('condition'=>'me_id='.$model->id),
			)),
			'columns'=>array(
				'user_id'=>array(
					'name'=>'user_id',
					'value'=>'$data->user->username',
				),
				'connection_id'=>array(
					'name'=>'connection_id',
					'value'=>'$data->connection->title',
				),
			),
		)); ?>
    </div>
</div>

<!--User Friends-->
<div class="clear topMargin30">
    <header class="acc_col_head navy-bg">
        <div class="icons"><i class="icon-eye-open"></i></div>
        <h5><?=$model->username?>'s Friends</h5>
        <div class="toolbar">
            <ul class="nav">
                <li class="widthAuto">
                    <a class="fancyElm" href="<?=Yii::app()->request->baseUrl?>/UserFriend/create?user=<?=$model->id?>">
                        <i class="icon-plus-sign-alt"></i>
                    </a>
                </li>
                <li class="widthAuto">
                    <a href="#fr" data-toggle="collapse" class="accordion-toggle minimize-box collapsed">
                        <i class="icon-chevron-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="collapse" style="height: 0px;" id="fr">
    	<?php $this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'user-friend-grid',
			'type'=>'striped  condensed',
			'dataProvider'=>new CActiveDataProvider('UserFriend', array(
				'criteria' => array('condition'=>'user_id='.$model->id.' OR friend_id='.$model->id),
			)),
			'columns'=>array(
				'friend_id'=>array(
				'name'=>'friend_id',
				'value'=>'UserFriend::Friend($data->friend_id, '.$model->id.', $data->user_id)',
			),
			'approved'=>array(
				'name'=>'approved',
				'value'=>'Helper::GetStatus($data->approved,"Approved", "Not approved")',
			),
			'date_created',
			),
		)); ?>
    </div>
</div>

<!--Who can access baby profile-->
<div class="clear topMargin30">
    <header class="acc_col_head navy-bg">
        <div class="icons"><i class="icon-eye-open"></i></div>
        <h5><?=$model->username?> can access</h5>
        <div class="toolbar">
            <ul class="nav">
                <li class="widthAuto">
                    <a class="fancyElm" href="<?=Yii::app()->request->baseUrl?>/babyAccessRole/create?user=<?=$model->id?>">
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
				'criteria' => array('condition'=>'user_id='.$model->id),
			)),
			'columns'=>array(
				'baby_id'=>array(
					'name'=>'baby_id',
					'value'=>'$data->baby->username',
					'filter'=>Helper::ListBaby(),
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

    <?php }?>