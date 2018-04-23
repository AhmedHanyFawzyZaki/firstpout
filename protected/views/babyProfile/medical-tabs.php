<?php
switch(Yii::app()->controller->action->id){
	case 'appointments':
		$vac='';
		$ap='current';
		$vis='';
		$medical='';
		break;
	case 'vaccines':
		$vac='current';
		$ap='';
		$vis='';
		$medical='';
		break;
	case 'visits':
		$vac='';
		$ap='';
		$vis='current';
		$medical='';
		break;
	default:
		$vac='';
		$ap='';
		$vis='';
		$medical='current';
		break;
}
?>

<div class="page-actions family-tabs">
    <a href="<?= Yii::app()->request->baseUrl ?>/babyProfile/info/<?= $id ?>" class="back">Back</a>
    <a href="<?= Yii::app()->request->baseUrl ?>/babyProfile/medicalRecords/<?= $id ?>" class="profile-link <?=$medical?>">
        Medical Records
    </a>
    <a href="<?= Yii::app()->request->baseUrl ?>/babyProfile/appointments/<?= $id ?>" class="profile-link <?=$ap?>">
        Appointments
    </a>
    <a href="<?= Yii::app()->request->baseUrl ?>/babyProfile/vaccines/<?= $id ?>" class="profile-link <?=$vac?>">
        Vaccines
    </a>
    <a href="<?= Yii::app()->request->baseUrl ?>/babyProfile/visits/<?= $id ?>" class="profile-link <?=$vis?>">
        Visits
    </a>
    <a href="javascript:void(0)"></a>
</div>