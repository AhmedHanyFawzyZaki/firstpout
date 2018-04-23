<?php
	switch(Yii::app()->controller->action->id){
       case 'info':
			$info='current';
			$members='';
			$time='';
			break;
		case 'members':
			$info='';
			$members='current';
			$time='';
			break;
		default:
			$info='';
			$members='';
			$time='current';
			break;
	}
?>
<div class="page-head">
    <div class="page-actions family-tabs"><!--profile-tabs vs family-tabs---->
        <a href="<?=Yii::app()->request->urlReferrer?>" class="back">Back</a>
        <a href="<?=Yii::app()->request->baseUrl?>/groups/members/<?=$id?>" class="<?=$members?>">Members</a>
        <a href="<?=Yii::app()->request->baseUrl?>/groups/info/<?=$id?>" class="<?=$info?>">Information</a>
        <a href="<?=Yii::app()->request->baseUrl?>/groups/index/<?=$id?>" class="<?=$time?>">Timeline</a>
        <a href="<?= Yii::app()->request->baseUrl ?>/home/newPost?group=<?=$id?>" class="new-post fancybox prof-new-post">New post</a>
    </div>
</div>