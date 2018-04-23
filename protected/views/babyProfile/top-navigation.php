<?php
	switch(Yii::app()->controller->action->id){
		case 'medicalRecords':
			$info='';
			$albums='';
			$family='';
			$time='';
                        $medical='current';
                case 'info':
			$info='current';
			$albums='';
			$family='';
			$time='';
                        $medical='';
			break;
		case 'albums':
			$info='';
			$albums='current';
			$family='';
			$time='';
                        $medical='';
			break;
		case 'family':
			$info='';
			$albums='';
			$family='current';
			$time='';
                        $medical='';
			break;
		default:
			$info='';
			$albums='';
			$family='';
			$time='current';
                        $medical='';
			break;
	}
?>
<div class="page-head">
    <div class="page-actions family-tabs"><!--profile-tabs vs family-tabs---->
        <!--<a href="<?=Yii::app()->request->baseUrl?>/babyProfile/info/<?=$id?>" class="back">Back</a>-->
        <?php
            if(Baby::IsBabyAccess($id,Yii::app()->user->id)){
        ?>
        <a href="<?=Yii::app()->request->baseUrl?>/babyProfile/medicalRecords/<?=$id?>" class="<?=$medical?>">Medical records</a>
        <?php
            }
        ?>
        <a href="<?=Yii::app()->request->baseUrl?>/babyProfile/albums/<?=$id?>" class="<?=$albums?>">Albums</a>
        <a href="<?=Yii::app()->request->baseUrl?>/babyProfile/family/<?=$id?>" class="<?=$family?>">Family</a>
        <a href="<?=Yii::app()->request->baseUrl?>/babyProfile/info/<?=$id?>" class="<?=$info?>">Information</a>
        <a href="<?=Yii::app()->request->baseUrl?>/babyProfile/index/<?=$id?>" class="<?=$time?>">Timeline</a>
        <a href="<?= Yii::app()->request->baseUrl ?>/home/newPost?baby=<?=$id?>" class="new-post fancybox prof-new-post">New post</a>
    </div>
</div>