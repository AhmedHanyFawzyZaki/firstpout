<style>
    img{
        max-width:2000px !important;
    }
</style>
<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <div class="page-actions family-tabs">
            <a href="<?= Yii::app()->request->baseUrl ?>/home" class="back">Back</a>
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/editProfile" class="profile-link">
                Edit Profile
            </a>
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/linkSocial" class="profile-link">
                Social Accounts
            </a>
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/viewProfiles" class="profile-link current">
                View Profiles
            </a>
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/createProfile" class="create-profile">Create user profile</a>
        </div>
    </div>

    <!-- /.page-head -->
    <section class="page-contain">
    	<?php
        if (Yii::app()->user->hasFlash("WrongGroup")) {
            echo '<div class="alert alert-success">' . Yii::app()->user->getFlash("WrongGroup") . '</div>';
        }
        ?>
        <div class="form-wrap cp-forms">
            <h1>Your profiles!</h1>
            <fieldset>
                <div class="social-registrator">
                	<div class="clear marginTop20 dis-tab width90per">
                        <a href="javascript:void(0)" class="social-link large-social" style="padding:0px;">
                            <img src="<?=$user->image?>" title="<?=$user->username?>" alt="<?=$user->username?>" width="108">
                        </a>
                        <?php
                        	if($user->dummy){
						?>
                        <a class="btn conn-btn margin10" href="<?=Yii::app()->request->baseUrl?>/controlPanel/activateProfile">
                            Activate
                        </a>
                        <?php
							}else{
						?>
                        		<a class="btn conn-btn margin10" href="<?=Yii::app()->request->baseUrl?>/controlPanel/deactivateProfile">Deactivate</a>
                        <?php
							}
						?>
                        <a class="btn conn-btn margin10" href="<?=Yii::app()->request->baseUrl?>/controlPanel/editProfile">
                            Edit
                        </a>
                    </div>
                	<?php
					if($profiles){
                    	foreach($profiles as $user){
					?>
                            <div class="clear marginTop20 dis-tab width90per">
                                <a href="javascript:void(0)" class="social-link large-social" style="padding:0px;">
                                	<img src="<?=$user->image?>" title="<?=$user->username?>" alt="<?=$user->username?>" width="108">
                                </a>
                                <a class="btn conn-btn margin10" href="<?=Yii::app()->request->baseUrl?>/controlPanel/deleteProfile/<?=$user->id?>">
                                    Delete
                                </a>
                                <a class="btn conn-btn margin10" href="<?=Yii::app()->request->baseUrl?>/controlPanel/createProfile/<?=$user->id?>">
                                    Edit
                                </a>
                            </div>
                    <?php
						}
					}
					
					if($babies){
                    	foreach($babies as $user){
					?>
                            <div class="clear marginTop20 dis-tab width90per">
                                <a href="javascript:void(0)" class="social-link large-social" style="padding:0px;">
                                	<img src="<?=$user->image?>" title="<?=$user->username?>" alt="<?=$user->username?>" width="108">
                                </a>
                                <a class="btn conn-btn margin10" href="<?=Yii::app()->request->baseUrl?>/controlPanel/deletebaby/<?=$user->id?>">
                                    Delete
                                </a>
                                <a class="btn conn-btn margin10" href="<?=Yii::app()->request->baseUrl?>/controlPanel/updateBabyProfile/<?=$user->id?>">
                                    Edit
                                </a>
                            </div>
                    <?php
						}
					}
					?>
                </div>
            </fieldset>
        </div>
    </section>
    <!-- /.page-contain -->
</div>