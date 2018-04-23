<?php
if (Yii::app()->user->isGuest) {
    $this->redirect(array("login/index"));
} elseif (isset($_REQUEST['id']) && strtolower(Yii::app()->controller->id) == 'babyprofile' && Baby::IsBabyAccess($_REQUEST['id'], Yii::app()->user->id)) {
    $user=Baby::model()->findByPk($_REQUEST['id']);
} else {
    $user = User::model()->findByPk(Yii::app()->user->id);
}
?>
<aside id="sidebar">
    <div class="current-profile">
        <div class="profile-avatar-contain">
            <a href="<?= Yii::app()->request->baseUrl ?>/home" class="profile-avatar">
                <img src="<?= $user->image ? $user->image : Yii::app()->params['default_profile_pic'] ?>" alt="" width="180" height="180"/>
            </a>
        </div>
        <!-- /.profile-avatar-contain -->
        <div class="profile-contest">
            <p>Your contest entry:</p>
            <?php
            $contest = Contest::model()->find(array('condition' => 'active=1'));
            if ($contest) {
                $entries = ContestUser::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id, 'contest_id' => $contest->id));
                $all_votes = ContestUser::model()->findAllByAttributes(array('contest_id' => $contest->id));
                $votes = array('0' => 0);
                if ($all_votes) {
                    foreach ($all_votes as $tv) {
                        if (array_key_exists($tv->user_id, $votes)) {
                            $votes[$tv->user_id]+=$tv->num_of_votes;
                        } else {
                            $votes[$tv->user_id] = $tv->num_of_votes;
                        }
                    }
                }
                $total_votes = 0;
                $total_likes = 0;

                if ($entries) {
                    foreach ($entries as $entry) {
                        echo '<strong class="contest-entry">"' . $entry->baby->username . '"</strong>';
                        $total_votes+=$entry->num_of_votes;
                        $total_likes+=$entry->num_of_likes;
                    }
                } else {
                    echo '<strong class="contest-entry">No Entries</strong>';
                }
                ?>
                <div class="circle-counter-wrap">
                    <div class="circle-stats circliful" data-dimension="125" data-width="10" data-percent="46" data-fgcolor="#e74c3c" data-bgcolor="#fff" data-total="<?php echo max($votes) ?>" data-part="<?= $total_votes ?>" data-border="inline">
                        <span class="circle-text circle-stats-overview">
                            You have <strong><?= $total_votes ?></strong> votes
                        </span>
                    </div>
                    <span class="time-left"><?php echo round((strtotime($contest->date_end) - time()) / (60 * 60 * 24)) ?> days left</span>
                </div>
                <!-- /.circle-counter-wrap -->
                <div class="contest-stats">
                    <a href="javascript:void(0)" class="contest-votes">
                        <i><?= $total_votes ?></i>
                        <span>votes</span>
                    </a>
                    <a href="javascript:void(0)" class="contest-entries">
                        <i><?= $total_likes ?></i>
                        <span>likes</span>
                    </a>
                </div>
                <!-- /.contest-stats -->
                <a href="javascript:void(0)" class="share-contest">
                    <i></i>
                    Share Your contest
                </a>
                <!-- /.share-contest -->
                <?php
            } else {
                echo '<strong class="contest-entry">No Contests available</strong>';
            }
            ?>
        </div>
        <!-- /.profile-contest -->
    </div>
    <!-- /.current-profile -->

    <nav id="bpmenu">
        <div class="widget menu-links">
            <h3 class="widget-title">Menu</h3>
            <ul class="menu" id="left_menu">
                <li>
                    <a onclick="$('.menu_cp').toggle()" href="javascript:void(0)">Control panel</a>
                    <ul class="menu menu_cp">
                        <li><a href="<?= Yii::app()->request->baseurl ?>/controlPanel/editProfile">Edit Profile</a></li>
                        <li><a href="<?= Yii::app()->request->baseurl ?>/controlPanel/createProfile">Create Profile</a></li>
                        <li><a href="<?= Yii::app()->request->baseurl ?>/controlPanel/viewProfiles">View Profiles</a></li>
                    </ul>
                </li>
                <li>
                    <a onclick="$('.menu_sd').toggle()" href="javascript:void(0)">Sell/donate</a>
                    <ul class="menu menu_sd">
                        <li><a href="<?= Yii::app()->request->baseUrl ?>/home/market">All Items</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl ?>/home/myProducts">My items</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl ?>/home/addProduct">Add item</a></li>
                    </ul>
                </li>
                <li>
                    <a onclick="$('.menu_fr').toggle()" href="javascript:void(0)">Friends</a>
                    <ul class="menu menu_fr">
                        <li><a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/inviteFriends">Invite friends</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/manageFriends">Manage friends</a></li>
                    </ul>
                </li>
                <li>
                    <a onclick="$('.menu_al').toggle()" href="javascript:void(0)">Albums</a>
                    <ul class="menu menu_al">
                        <li><a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/albums">My Albums</a></li>
                        <!--<li><a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/createAlbum">Create Album</a></li>-->
                    </ul>
                </li>
                <li>
                    <a onclick="$('.menu_con').toggle()" href="javascript:void(0)">Photo contest</a>
                    <ul class="menu menu_con">
                        <li><a href="<?= Yii::app()->request->baseUrl ?>/home/contest">Show contest</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl ?>/home/contestEntry">Submit entry</a></li>
                    </ul>
                </li>
                <li>

                </li>
            </ul>
        </div>
        <!-- /.widget -->
        <div class="widget profiles-links">
            <h3 class="widget-title">Profiles</h3>
            <ul class="menu">
                <!--<li>
                    <a href="#">View all profiles</a>
                </li>-->
                <?php
                $babies = Baby::model()->findAllBySql('select * from '.Baby::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '" or id in (select baby_id from '.BabyAccessRole::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '" and role="1")');
                if ($babies) {
                    foreach ($babies as $baby) {
                        echo '<li>
                            <a onclick="$(\'.menu_baby_' . $baby->id . '\').toggle();" href="javascript:void(0)">' . $baby->username . '</a>
                                <ul class="menu menu_baby menu_baby_' . $baby->id . '">
									<li><a href="' . Yii::app()->request->baseUrl . '/babyProfile/index/' . $baby->id . '">Timeline</a></li>
                                    <li><a href="' . Yii::app()->request->baseUrl . '/babyProfile/info/' . $baby->id . '">Information</a></li>
									<li><a href="' . Yii::app()->request->baseUrl . '/babyProfile/family/' . $baby->id . '">Family</a></li>
									<li><a href="' . Yii::app()->request->baseUrl . '/babyProfile/medicalRecords/' . $baby->id . '">Medical Records</a></li>
									<li><a href="' . Yii::app()->request->baseUrl . '/babyProfile/appointments/' . $baby->id . '">Appointments</a></li>
									<li><a href="' . Yii::app()->request->baseUrl . '/babyProfile/vaccines/' . $baby->id . '">Vaccines</a></li>
									<li><a href="' . Yii::app()->request->baseUrl . '/babyProfile/visits/' . $baby->id . '">Visits</a></li>
									<li><a href="' . Yii::app()->request->baseUrl . '/babyProfile/albums/' . $baby->id . '">Albums</a></li>
                                    <li><a href="' . Yii::app()->request->baseUrl . '/controlPanel/UpdateBabyProfile/' . $baby->id . '">Edit</a></li>
                                    <li><a href="' . Yii::app()->request->baseUrl . '/controlPanel/createAlbum?id=' . $baby->id . '&type=baby">Create Album</a></li>
                                </ul>
</li>';
                    }
                }
                ?>
                <li>
                    <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/createBabyProfile">Create New Baby Profile</a>
                </li>
            </ul>
        </div>
        <!-- /.widget -->
        <div class="widget groups-links">
            <h3 class="widget-title">Groups</h3>
            <ul class="menu">
                <?php
                $groups_ids = GroupUser::model()->findAll(array('condition' => 'user_id=' . Yii::app()->user->id));
                $ids = array(0);
                if ($groups_ids) {
                    foreach ($groups_ids as $gr) {
                        $ids[] = $gr->group_id;
                    }
                }
                $groups = Group::model()->findAll(array('condition' => 'user_id=' . Yii::app()->user->id . ' OR id in(' . implode(',', $ids) . ')'));
                if ($groups) {
                    foreach ($groups as $grp) {
                        $edit = '';
                        if (Group::IsGroupAdmin($grp->id, Yii::app()->user->id)) {
                            $edit = '<a class="pull-right edit-icon" href="' . Yii::app()->request->baseUrl . '/controlPanel/editGroup/' . $grp->id . '"></a>';
                        }
                        echo '<li>
							<a href="' . Yii::app()->request->baseUrl . '/groups/index/' . $grp->id . '">' . $grp->title . ' </a>
							' . $edit . '
						</li>';
                    }
                }
                ?>
                <li>
                    <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/createGroup">Create New Group</a>
                </li>
            </ul>
        </div>
        <!-- /.widget -->
        <!--<div class="widget other-links">
            <h3 class="widget-title">Other</h3>
            <ul class="menu">
                <li>
                    <a href="#">Other menu item</a>
                </li>
                <li>
                    <a href="#">Other menu</a>
                </li>
                <li>
                    <a href="#">Other menu item</a>
                </li>
            </ul>
        </div>-->
        <!-- /.widget -->
    </nav>
</aside>
<!-- /#sidebar -->