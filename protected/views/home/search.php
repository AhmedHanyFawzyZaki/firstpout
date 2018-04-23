<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <h1 class="search-head">Search Results</h1>
    </div>
    <!-- /.page-head -->
    <section class="page-contain friends-manager-wrap">
        <!-- /.list-overview -->
        <script>
            $(function() {
                $("#tabs").tabs();
            });
        </script>
        <style>
            .li-tb{
                float:left;
                display:table;
                padding:0px !important;
                border:none !important;
                background:none !important;
                font-size:12px !important;
            }
            .ui-state-default.ui-state-active a{
                color:#3598db !important;
                font-size:12px !important;
            }
            .ui-tabs .ui-tabs-panel{
                padding:0px;
            }
        </style>
        <div id="tabs" style="padding:0px;border:none ;">
            <div class="page-head tabs-nav">
                <ul class="page-actions" style="background: #e9eaee;border: 0px;font-weight: inherit;padding-left:20px;">
                    <li class="li-tb"><a href="#friends-manager" class="profile-link">People</a></li>
                    <li class="li-tb"><a href="#groups" class="profile-link">Groups</a></li>
                    <li class="li-tb"><a href="#babies" class="profile-link">Babies</a></li>
                </ul>
            </div>
            <div id="friends-manager">
                <?php
                if ($users) {
                    foreach ($users as $us) {
                        $friends = UserFriend::model()->findAll(array('condition' => '(friend_id=' . $us->id . ' OR user_id=' . $us->id . ')  and approved=1'));
                        $his_fr = array();
                        $mutual = array();
                        $ismyfriend = UserFriend::model()->find(array('condition' => '(friend_id=' . $us->id . ' and user_id=' . Yii::app()->user->id . ') OR (user_id=' . $us->id . ' and friend_id=' . Yii::app()->user->id . ')'));
                        if ($friends) {
                            foreach ($friends as $fr) {
                                if ($fr->user_id == $us->id) {
                                    $his_fr[] = $fr->friend_id;
                                } else {
                                    $his_fr[] = $fr->user_id;
                                }
                            }
                            $mutual = UserFriend::model()->findAll(array('condition' => '(friend_id=' . Yii::app()->user->id . ' and user_id in (' . implode(',', $his_fr) . ') and approved=1) OR (user_id=' . Yii::app()->user->id . ' and friend_id in (' . implode(',', $his_fr) . ')  and approved=1)'));
                        }
                        ?>
                        <div class="friend-wrap">
                            <div class="friend-card search-card">
                                <img src="<?= $us->image ? $us->image : Yii::app()->params['default_profile_pic'] ?>" width="60" height="60" alt="" class="friend-thumb pull-left" />
                                <div class="friend-overview pull-left">
                                    <h3 class="friend-name"><a href="<?= Yii::app()->request->baseUrl ?>/userProfile/index/<?= $us->id ?>"><?= $us->username; ?></a></h3>
                                    <span class="friend-connection"><b style="font-weight:800;"><?= count($friends) ?></b> friend(s) - <b style="font-weight:800;"><?= count($mutual) ?></b> mutual friend(s)</span>
                                    <span class="friend-connection topMargin10"><?= $us->active ? 'Verified' : 'Unverified' ?> account</span>
                                </div>
                                <div class="pull-right btn-search" id="user-search-btn-<?= $us->id ?>">
                                    <?php
                                    if ($ismyfriend) { //this user is my friend or there is a pending request
                                        if ($ismyfriend->approved) { //is my friend
                                            echo '<button class="src-btn red" onclick="unfriend(' . $us->id . ')">Unfriend</button>';
                                        } elseif ($ismyfriend->user_id == Yii::app()->user->id) { //i have invited him
                                            echo '<button class="src-btn blue" onclick="uninvite(' . $us->id . ')">unInvite</button>';
                                        } else { //he has invited me
                                            echo '<button class="src-btn yellow" onclick="accept(' . $us->id . ')">ACCEPT</button><div class="arrow" onclick="$(\'#reject_fr_' . $us->id . '\').toggle()"><span class="arrow-down-yellow"></span></div><span class="src-btn red reject" style="display:none;" id="reject_fr_' . $us->id . '" onclick="reject(' . $us->id . ')">Reject</span>';
                                        }
                                    } else {
                                        echo '<button class="src-btn grey" onclick="invite(' . $us->id . ')">Invite</button>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="friend-wrap">
                    <div class="friend-card search-card">
					No users found matching your search keyword.</div>
                </div>';
                }
                ?>
            </div>

            <div id="groups">
                <?php
                if ($groups) {
                    foreach ($groups as $gr) {
                        ?>
                        <div class="friend-wrap">
                            <div class="friend-card search-card">
                                <img src="<?= $gr->banner ? $gr->banner : Yii::app()->params['default_banner_image'] ?>" width="60" height="60" alt="" class="friend-thumb pull-left" />
                                <div class="friend-overview pull-left">
                                    <h3 class="friend-name"><?= $gr->title; ?></h3>
                                    <span class="friend-connection"><?= count(GroupUser::model()->findAll(array('condition' => 'group_id=' . $gr->id))) + 1 ?> member(s)</span>
                                    <span class="friend-connection topMargin10"><?= $gr->privacy ? 'Private' : 'Public' ?></span>
                                </div>
                                <div class="pull-right btn-search">
                                    <button class="src-btn blue" onclick="window.location = '<?= Yii::app()->request->baseUrl ?>/groups/index/<?= $gr->id ?>'">VIEW</button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="friend-wrap">
                    <div class="friend-card search-card">
					No groups found matching your search keyword.</div>
                </div>';
                }
                ?>
            </div>

            <div id="babies">
                <?php
                if ($babies) {
                    foreach ($babies as $ba) {
                        ?>
                        <div class="friend-wrap">
                            <div class="friend-card search-card">
                                <img src="<?= $ba->banner ? $ba->banner : Yii::app()->params['default_banner_image'] ?>" width="60" height="60" alt="" class="friend-thumb pull-left" />
                                <div class="friend-overview pull-left">
                                    <h3 class="friend-name"><?= $ba->username; ?></h3>
                                    <span class="friend-connection"><?= $ba->gender == 2 ? 'Female' : 'Male' ?> - <?= Helper::age($ba->date_of_birth) ?></span>
                                    <span class="friend-connection topMargin10"><?= $gr->privacy ? 'Private' : 'Public' ?></span>
                                </div>
                                <div class="pull-right btn-search">
                                    <button class="src-btn blue" onclick="window.location = '<?= Yii::app()->request->baseUrl ?>/babyProfile/index/<?= $ba->id ?>'">VIEW</button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="friend-wrap">
                    <div class="friend-card search-card">
					No babies found matching your search keyword.</div>
                </div>';
                }
                ?>
            </div>
            <!-- /#friends-manager -->
        </div>
    </section>
    <!-- /.page-contain -->
</div>

<script>
    function uninvite(id) {
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl ?>/controlPanel/invite?id=" + id,
            success: function(data) {
                if (data) {
                    $('#user-search-btn-' + id).html('<button class="src-btn grey" onclick="invite(' + id + ')">Invite</button>');
                }
            }
        });
    }
    function invite(id) {
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl ?>/controlPanel/invite?id=" + id,
            success: function(data) {
                if (data) {
                    $('#user-search-btn-' + id).html('<button class="src-btn blue" onclick="uninvite(' + id + ')">unInvite</button>');
                }
            }
        });
    }
    function unfriend(id) {
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl ?>/controlPanel/invite?id=" + id,
            success: function(data) {
                if (data) {
                    $('#user-search-btn-' + id).html('<button class="src-btn grey" onclick="invite(' + id + ')">Invite</button>');
                }
            }
        });
    }
    function accept(id) {
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl ?>/controlPanel/acceptFriend?id=" + id,
            success: function(data) {
                if (data) {
                    $('#user-search-btn-' + id).html('<button class="src-btn red" onclick="unfriend(' + id + ')">unfriend</button>');
                }
            }
        });
    }
    function reject(id) {
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl ?>/controlPanel/invite?id=" + id,
            success: function(data) {
                if (data) {
                    $('#user-search-btn-' + id).html('<button class="src-btn grey" onclick="invite(' + id + ')">Invite</button>');
                }
            }
        });
    }
</script>