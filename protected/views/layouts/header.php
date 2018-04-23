<!DOCTYPE html>  
<!--[if IE 7 ]> <html lang="en" class="ie no-js ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="en" class="ie no-js ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="en" class="ie no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en" id="whole"> 
    <!--<![endif]-->
    <head>  
        <!--===========================FreiChat=======START=========================-->
        <!--	For uninstalling ME , first remove/comment all FreiChat related code i.e below code
             Then remove FreiChat tables frei_session & frei_chat if necessary
                 The best/recommended way is using the module for installation                         -->

        <?php /* $ses=null;
          if(Yii::app()->user->id)
          {
          $ses = Yii::app()->user->id; //tell freichat the userid of the current user

          setcookie("freichat_user", Yii::app()->user->id, time()+3600, "/"); // *do not change -> freichat code
          }
          else {
          $ses = null; //tell freichat that the current user is a guest

          setcookie("freichat_user", null, time()+3600, "/"); // *do not change -> freichat code
          }
          if(!function_exists("freichatx_get_hash")){
          function freichatx_get_hash($ses){

          if(is_file(Yii::app()->basePath."/../freichat/hardcode.php")){

          require Yii::app()->basePath."/../freichat/hardcode.php";

          $temp_id =  $ses . $uid;

          return md5($temp_id);

          }
          else
          {
          echo "<script>alert('module freichatx says: hardcode.php file not found!');</script>";
          }

          return 0;
          }
          }
          ?>
          <script type="text/javascript" language="javascipt" src="<?=Yii::app()->request->baseUrl?>/freichat/client/main.php?id=<?php echo $ses;?>&xhash=<?php echo freichatx_get_hash($ses); ?>"></script>
          <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/freichat/client/jquery/freichat_themes/freichatcss.php" type="text/css">
          <!--===========================FreiChatX=======END=========================-->
          <? */ ?>             
        <!-- Meta -->
        <meta charset="utf-8" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="robots" content="noindex,nofollow" />
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Titre -->
        <title><?php echo CHtml::encode($this->pageTitle); ?> </title> 
        <!-- Include stylesheets -->
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?= Yii::app()->request->baseUrl ?>/css/globals.css" />	
        <link rel="stylesheet" href="<?= Yii::app()->request->baseUrl ?>/css/main-chat.css" />	
        <link rel="stylesheet" href="<?= Yii::app()->request->baseUrl ?>/css/responsive.logged.css" />	
        <link rel="stylesheet" href="<?= Yii::app()->request->baseUrl ?>/css/new.css" />	
        <?php
        /* if(!(Yii::app()->controller->id=='home' && Yii::app()->controller->action->id=='contestEntry'))
          echo '<script type="text/javascript" src="'.Yii::app()->request->baseUrl.'/js/vendor/jquery.js"></script>'; */
        ?>
        <script type="text/javascript" src="<?= Yii::app()->request->baseUrl ?>/js/vendor/jquery.js"></script>
        <!--[if lt IE 9]>
        <script type="text/javascript" src="<?= Yii::app()->request->baseUrl ?>/js/vendor/html5shiv.js"></script>
        <![endif]-->

        <?php
        if (isset($_REQUEST['id']) && strtolower(Yii::app()->controller->id) == 'babyprofile' && Baby::IsBabyAccess($_REQUEST['id'], Yii::app()->user->id)) {
            $user = Baby::model()->findByPk($_REQUEST['id']);
            $birth_place = 'Born in ' . $user->birth_place;
        } elseif (!Yii::app()->user->isGuest) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $birth_place = 'We live in ' . $user->street . ' ' . $user->city . ',<br />' . $user->count->country_name;
        }
        ?>
        <script>
            function accept(id) {
                $.ajax({
                    url: "<?= Yii::app()->request->baseUrl ?>/controlPanel/acceptFriend?id=" + id,
                    success: function (data) {
                        if (data) {
                            window.location = '?';
                        }
                    }
                });
            }
            function reject(id) {
                $.ajax({
                    url: "<?= Yii::app()->request->baseUrl ?>/controlPanel/invite?id=" + id,
                    success: function (data) {
                        if (data) {
                            $('.user-search-btn-' + id).slideUp(1000, function () {
                                $('.user-search-btn-' + id).remove();
                            });
                        }
                    }
                });
            }
        </script>
        <script>
            function favourite(type, id)
            {
                $.ajax({
                    url: "<?= Yii::app()->request->baseUrl ?>/home/favourite?type=" + type + "&id=" + id,
                    success: function (data) {
                        var arr = jQuery.parseJSON(data);
                        if (arr['status'] == 1)
                            $('#fav_' + id).attr('class', 'full-star');
                        else
                            $('#fav_' + id).attr('class', 'like-this');
                    }
                });
            }
            function like(type, id)
            {
                $.ajax({
                    url: "<?= Yii::app()->request->baseUrl ?>/home/like?type=" + type + "&id=" + id,
                    success: function (data) {
                        var arr = jQuery.parseJSON(data);
                        /*if(arr['status']==1)
                         $('#fav_'+id).attr('class','full-star');
                         else
                         $('#fav_'+id).attr('class','like-this');*/

                        $('#likes_count_' + id).html('<i></i>' + arr['count']);
                    }
                });
            }
            function comment(type, id)
            {
                var reply = $('#reply_' + id).val();
                $.ajax({
                    url: "<?= Yii::app()->request->baseUrl ?>/home/comment",
                    type: 'POST',
                    data: {'reply': reply, 'id': id, 'type': type},
                    success: function (data) {
                        if (data)
                        {
                            var arr = jQuery.parseJSON(data);
                            $('#reply_' + id).val('');
                            $('#comments_' + id).html(arr['comments']);
                            $('#comments_count_' + id).html('<i></i>' + arr['count']);
                        }
                        else
                            alert("An error has occured, pleas try again later!");
                    }
                });
            }
        </script>

        <script>
            $(document).ready(function (e) {
                $('#logout-li').on('click', function (e) {
                    $('.admin-sett').hide();
                    $('.admin-sett').css('visibility', 'hidden');

                    $('.logout-div').toggle();
                    $('.logout-div').css('visibility', 'visible');

                    $('.admin-msg').hide();
                    $('.admin-msg').css('visibility', 'hidden');

                    $('.admin-notific').hide();
                    $('.admin-notific').css('visibility', 'hidden');
                    e.stopPropagation();
                });
                $('#notific-li').on('click', function (e) {
                    $('.admin-sett').hide();
                    $('.admin-sett').css('visibility', 'hidden');

                    $('.logout-div').hide();
                    $('.logout-div').css('visibility', 'hidden');

                    $('.admin-notific').toggle();
                    $('.admin-notific').css('visibility', 'visible');

                    $('.admin-msg').hide();
                    $('.admin-msg').css('visibility', 'hidden');

                    $.ajax({
                        url: '<?= Yii::app()->request->baseUrl ?>/home/notificationSeen',
                        success: function (data) {
                            $('.notifications-counter2').html('0');
                        }
                    });
                    e.stopPropagation();
                });
                $('#admin-msg-li').on('click', function (e) {
                    $('.admin-sett').hide();
                    $('.admin-sett').css('visibility', 'hidden');

                    $('.admin-msg').toggle();
                    $('.admin-msg').css('visibility', 'visible');

                    $('.logout-div').hide();
                    $('.logout-div').css('visibility', 'hidden');

                    $('.admin-notific').hide();
                    $('.admin-notific').css('visibility', 'hidden');
                    e.stopPropagation();
                });
                $('#settings-li').on('click', function (e) {
                    $('.admin-sett').toggle();
                    $('.admin-sett').css('visibility', 'visible');

                    $('.admin-msg').hide();
                    $('.admin-msg').css('visibility', 'hidden');

                    $('.logout-div').hide();
                    $('.logout-div').css('visibility', 'hidden');

                    $('.admin-notific').hide();
                    $('.admin-notific').css('visibility', 'hidden');
                    e.stopPropagation();
                });

                $('body').on('click', function (e) {
                    /*****logout div*****/
                    $('.logout-div').hide();
                    $('.logout-div').css('visibility', 'hidden');
                    /*****admin msg div*****/
                    $('.admin-msg').hide();
                    $('.admin-msg').css('visibility', 'hidden');
                    /*****admin sett div*****/
                    $('.admin-sett').hide();
                    $('.admin-sett').css('visibility', 'hidden');
                    /*****logout div*****/
                    $('.admin-notific').hide();
                    $('.admin-notific').css('visibility', 'hidden');
                });
                setInterval(function () {
                    $.ajax({
                        url: "<?= Yii::app()->request->baseUrl ?>/home/updateNotifications",
                        success: function (data) {
                            $('#notif-ul').html(data);
                        }
                    });
                    $.ajax({
                        url: "<?= Yii::app()->request->baseUrl ?>/home/NotificationRefresh",
                        success: function (data) {
                            var arr = jQuery.parseJSON(data);
                            if (arr['count'] > 0) {
                                var pre_count = $('.notifications-counter2').html();
                                $('.notifications-counter2').html(arr['count']);
                                if (pre_count != arr['count'])
                                    $('#notific-append').append(arr['list']);
                            }
                        }
                    });
                }, 45000);
            });
        </script>
        <script>
            if (/Android|webOS|iPhone|iPod|BlackBerry|IEMobile/i.test(navigator.userAgent)) {
                if (window.location.hash == "#desktop") {
// Stay on desktop website
                } else {
                    window.location = "http://mobile.firstpout.com";
                }

            }
        </script>
    </head>
    <body class="logged-in">
        <div id="head-container">
            <header id="header">
                <div class="header-wrap container">
                    <div class="profile-info">
                        <a href="javascript:void(0);" class="profile-avatar-small">
                            <img src="<?= $user->image ?>" alt="<?= $user->username ?>" width="80" height="80"/>
                        </a>
                        <h1 class="profile-head"><?= $user->username ?></h1>
                        <div class="profile-overview">
                            <p class="birth-data">
                                Born in <?= date('d', strtotime($user->date_of_birth)) ?>, <?= date('M', strtotime($user->date_of_birth)) ?>, <?= date('Y', strtotime($user->date_of_birth)) ?><br />
                                It was <?= date('D', strtotime($user->date_of_birth)) ?><br />
                                <?php
                                echo $user->desc;
                                /* if (date('d', strtotime($user->date_of_birth)) > 5 && date('d', strtotime($user->date_of_birth)) < 10) {
                                  echo "It was very hot day.";
                                  } elseif (date('d', strtotime($user->date_of_birth)) > 10) {
                                  echo "It was cold day.";
                                  } else {
                                  echo "It was very cold day.";
                                  } */
                                ?>
                            </p>
                            <p class="localisation-data">
                                <?= $birth_place ?>
                            </p>
                        </div>
                    </div>
                    <!-- /.profile-info -->
                    <div class="profile-actions-wrap">
                        <a href="<?= Yii::app()->request->baseUrl ?>/home" id="logo">
                            <img src="<?= Yii::app()->request->baseUrl ?>/img/common/logo.png" alt="" />
                        </a>
                        <!-- /#logo -->
                        <div id="mobile-menu-wrap">
                            <a href="#" class="mobile-actions">Toggle Menu</a>
                        </div>
                        <!-- /.mobile-menu-wrap -->
                        <ul class="profile-actions">
                            <li id="admin-msg-li">
                                <?php
                                $unread_ad_msgs = Chat::model()->findAllByAttributes(array('admin' => 1, 'seen' => 0, 'to_id' => Yii::app()->user->id, 'show' => 1));
                                $ad_msgs = Chat::model()->findAllByAttributes(array('admin' => 1, 'to_id' => Yii::app()->user->id, 'show' => 1));
                                $all_count = count($ad_msgs);
                                $requests = UserFriend::model()->findAll(array('condition' => 'friend_id=' . Yii::app()->user->id . ' and approved=0'));
                                $un_count = count($unread_ad_msgs) + count($requests);
                                ?>
                                <a href="javascript:void(0)" class="action-notifications"><span class="notifications-counter"><?= $un_count ?></span></a>
                            </li>
                            <li id="notific-li">
                                <a href="javascript:void(0)" class="action-notifications action-notifications2"><span class="notifications-counter notifications-counter2"><?= Notification::model()->count(array('condition' => 'user_id="' . Yii::app()->user->id . '" and table_name<>"vaccine" and table_name<>"appointment" and table_name<>"visit" and seen=0')); ?></span></a>
                            </li>
                            <li id="settings-li">
                                <a href="javascript:void(0)" class="action-settings">Settings</a>
                            </li>
                            <li id="logout-li">
                                <a class="action-security" href="javascript:void(0)"></a>
                            </li>
                        </ul>
                        <!-- /.profile-actions -->
                    </div>
                    <!-- /.actions-wrap -->
                </div>
                <!-- /.header-wrap -->
            </header>
            <!-- /#header -->
            <?php
            if (strtolower(Yii::app()->request->url) == Yii::app()->request->baseUrl . '/controlpanel/managefriends') {
                $cl_fr = 'current';
                $cl_tl = '';
                $cl_ms = '';
                $cl_pr = '';
            } elseif (strtolower(Yii::app()->request->url) == Yii::app()->request->baseUrl . '/controlpanel/editprofile') {
                $cl_fr = '';
                $cl_tl = '';
                $cl_ms = '';
                $cl_pr = 'current';
            } elseif (strtolower(Yii::app()->request->url) == Yii::app()->request->baseUrl . '/controlpanel/chat') {
                $cl_fr = '';
                $cl_tl = '';
                $cl_ms = 'current';
                $cl_pr = '';
            } else {
                $cl_fr = '';
                $cl_ms = '';
                $cl_tl = 'current';
                $cl_pr = '';
            }
            ?>
            <nav id="primary-menu">
                <ul class="menu container">
                    <li class="link-timeline">
                        <a class="<?= $cl_tl ?>" href="<?= Yii::app()->request->baseUrl ?>/home" title="Timeline"><i></i></a>
                    </li>
                    <li class="link-messages">
                        <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/chat" title="Messages" class="<?= $cl_ms ?>"><i></i></a>
                    </li>
                    <li class="link-friends">
                        <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/manageFriends" class="<?= $cl_fr ?>" title="Friends"><i></i></a>
                    </li>
                    <li class="link-notes">
                        <a href="<?= Yii::app()->request->baseUrl . '/controlPanel/editProfile' ?>" class="<?= $cl_pr ?>" title="Profile"><i></i></a>
                    </li>
                    <li class="link-share">
                        <a href="<?= Yii::app()->request->baseUrl ?>/home/share" class="fancybox"><i></i></a>
                    </li>
                    <li class="link-add">
                        <a href="<?= Yii::app()->request->baseUrl ?>/home/newPost<?= Helper::NewPostType() ?>" class="fancybox"><i></i></a>
                    </li>
                </ul>
                <!-- /.menu -->
            </nav>
            <!-- /#primary-menu -->
        </div>
        <!-- /#head-container -->
        <main id="main" class="container">
            <div class="admin-msg">
                <span class="arrow-up-wh"></span>
                <div class="adm-msg-head">Admin Messages <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/messages" class="pull-right all-msg">All Messages: <?= $all_count; ?></a></div>
                <div class="not-msgs">
                    <?php
                    if ($requests) {
                        foreach ($requests as $us) {
                            $friends = UserFriend::model()->findAll(array('condition' => '(friend_id=' . $us->user_id . ' OR user_id=' . $us->user_id . ')  and approved=1'));
                            $his_fr = array();
                            $mutual = array();
                            if ($friends) {
                                foreach ($friends as $fr) {
                                    if ($fr->user_id == $us->user_id) {
                                        $his_fr[] = $fr->friend_id;
                                    } else {
                                        $his_fr[] = $fr->user_id;
                                    }
                                }
                                $mutual = UserFriend::model()->findAll(array('condition' => '(friend_id=' . Yii::app()->user->id . ' and user_id in (' . implode(',', $his_fr) . ') and approved=1) OR (user_id=' . Yii::app()->user->id . ' and friend_id in (' . implode(',', $his_fr) . ')  and approved=1)'));
                            }
                            ?>
                            <div class="ad-not user-search-btn-<?= $us->user_id ?>" onClick="event.stopPropagation();">
                                <img src="<?= $us->user->image ? $us->user->image : Yii::app()->params['default_profile_pic'] ?>" width="50" height="50" alt="" class="round-img-ad pull-left" />
                                <div class="width-120 pull-left">
                                    <h3><b style="color:#8a8a8a"><?= $us->user->username; ?></b></h3>
                                    <span class="pull-left"><!--<b style="font-weight:800;"><?= count($friends) ?></b> friend(s) - --><b style="font-weight:800;"><?= count($mutual) ?></b> mutual friend(s)</span>
                                    <span class="pull-left clear"><?= $us->user->active ? 'Verified' : 'Unverified' ?> account</span>
                                </div>
                                <div class="pull-right btn-search">
                                    <?php
                                    echo '<button class="src-btn yellow bt" onclick="accept(' . $us->user_id . ')">ACCEPT</button>
                                    <br>
                                    <button class="src-btn red bt" onclick="reject(' . $us->user_id . ')">Reject</button>';
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    if ($ad_msgs) {
                        foreach ($ad_msgs as $ad_ms) {
                            $ams_cl = 'Unr';
                            if ($ad_ms->seen) {
                                $ams_cl = 'R';
                            }
                            echo '<div class="ad-not">
                                <a href="javascript:void(0)" class="not-link"><label class="' . $ams_cl . 'eaded">' . $ams_cl . 'eaded message</label><br>
                                <label class="adm-text">' . substr($ad_ms->msg, 0, 200) . '</label></a>
                            </div>';
                        }
                    }
                    ?>
                </div>
                <div class="adm-msg-foot">Admin Messages <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/messages" class="pull-right all-msg-bold">All Messages</a></div>
            </div>
            <div class="admin-notific">
                <span class="arrow-up-wh"></span>
                <div class="adm-msg-head">Notifications</div>
                <div class="not-msgs">
                    <span id="notific-append"></span>
                    <?php
                    $notifs = Notification::model()->findAll(array('condition' => 'user_id="' . Yii::app()->user->id . '" and table_name<>"vaccine" and table_name<>"appointment" and table_name<>"visit"', 'order' => 'id desc'));
                    if ($notifs) {
                        foreach ($notifs as $not) {
                            echo '<div class="ad-not"><label class="ph-has"></label><span class="Readed">' . $not->msg . '</span></div>';
                        }
                    } else {
                        echo '<div class="ad-not" style="border:0;">
						<a href="javascript:void(0)" class="not-link"><label class="Readed">No notifications found.</label></a>
					</div>';
                    }
                    ?>
                </div>
                <div class="adm-msg-foot">Notifications <a href="#" class="pull-right all-msg-bold"></a></div>
            </div>
            <div class="admin-sett">
                <span class="arrow-up-wh"></span>
                <div class="adm-msg-head">Settings <a href="#" class="pull-right all-msg"></a></div>
                <div class="sett-msgs">
                    <div class="ad-not">
                        <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/friendRequests" class="adm-text-sett">Friend Requests</a>
                    </div>
                    <div class="ad-not">
                        <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/editProfile" class="adm-text-sett">Account Settings</a>
                    </div>
                    <div class="ad-not">
                        <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/linkSocial" class="adm-text-sett">Social Accounts</a>
                    </div>
                    <div class="ad-not">
                        <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/createBabyProfile" class="adm-text-sett">Create Baby profile</a>
                    </div>
                    <div class="ad-not">
                        <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/createGroup" class="adm-text-sett">Create Group</a>
                    </div>
                    <div class="ad-not">
                        <a href="<?= Yii::app()->request->baseUrl ?>/home/market" class="adm-text-sett">Market</a>
                    </div>
                </div>
                <div class="adm-msg-foot">Settings <a href="#" class="pull-right all-msg-bold"></a></div>
            </div>
            <a href="<?= Yii::app()->request->baseUrl ?>/home/logout" class="logout-div"><span class="arrow-up"></span>LOGOUT</a>
            <?php
            $this->renderPartial('/layouts/left-side');
            ?>
            <section id="content">        