<?php
	switch(Yii::app()->controller->action->id){
		case 'albums':
			$info='';
			$albums='current';
			$friends='';
			$time='';
			break;
		case 'info':
			$info='current';
			$albums='';
			$friends='';
			$time='';
			break;
		case 'friends':
			$info='';
			$albums='';
			$friends='current';
			$time='';
			break;
		default:
			$info='';
			$albums='';
			$friends='';
			$time='current';
			break;
	}
?>
<div class="page-head">
    <div class="page-actions family-tabs"><!--profile-tabs vs family-tabs---->
        <a href="<?=Yii::app()->request->baseUrl?>/userProfile/albums/<?=$id?>" class="<?=$albums?>">Albums</a>
        <a href="<?=Yii::app()->request->baseUrl?>/userProfile/friends/<?=$id?>" class="<?=$friends?>">Friends</a>
        <a href="<?=Yii::app()->request->baseUrl?>/userProfile/info/<?=$id?>" class="<?=$info?>">Information</a>
        <a href="<?=Yii::app()->request->baseUrl?>/userProfile/index/<?=$id?>" class="<?=$time?>">Timeline</a>
        <a href="javascript:void(0)"> </a>
    </div>
</div>