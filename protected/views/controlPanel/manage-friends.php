<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <div class="page-actions family-tabs">
            <a href="<?=Yii::app()->request->urlReferrer;?>" class="back">Back</a>
            <a href="<?=Yii::app()->request->baseUrl?>/controlPanel/manageFriends" class="profile-link current">
                Manage Friends
            </a>
            <a href="<?=Yii::app()->request->baseUrl?>/controlPanel/inviteFriends" class="profile-link">
                Invite Friends
            </a>
            <a href="javascript:void(0)">
            </a>
        </div>
    </div>
    <!-- /.page-head -->
    <section class="page-contain friends-manager-wrap">
        <?php
        if (Yii::app()->user->hasFlash("wrongFriend")) {
                echo '<div class="alert alert-danger">' . Yii::app()->user->getFlash("wrongFriend") . '</div>';
        }elseif (Yii::app()->user->hasFlash("doneFriend")) {
                echo '<div class="alert alert-success">' . Yii::app()->user->getFlash("doneFriend") . '</div>';
        }
        ?>
        <div class="page-head">
            <div class="page-actions filter-wrap">
                <h2 class="filter-title">Edit Your friend list</h2>
                <div class="filter-inner">
                    <select onchange="window.location = '?filter=' + this.value" id="filter-contests" class="form-select">
                        <option value="1">Show all</option>
                        <option value="2" <?=(isset($_REQUEST['filter']) && $_REQUEST['filter']=='2')?'selected="selected"':''?>>Favorite</option>
                        <option value="3" <?=(isset($_REQUEST['filter']) && $_REQUEST['filter']=='3')?'selected="selected"':''?>>Recently added</option>
                        <option value="4" <?=(isset($_REQUEST['filter']) && $_REQUEST['filter']=='4')?'selected="selected"':''?>>Administrators</option>
                        <option value="5" <?=(isset($_REQUEST['filter']) && $_REQUEST['filter']=='5')?'selected="selected"':''?>>Sub-Administrators</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- /.list-overview -->
        <div id="friends-manager">
            <?php
                if($friends){
                    foreach ($friends as $fr){
                        $fr_prof=User::model()->findByPk($fr->friend_id);//me requested his friendship
                        if($fr->friend_id==Yii::app()->user->id)
                            $fr_prof=User::model()->findByPk($fr->user_id);// s/he requested my friendship
                        
                        /***is favorite user?***/
                        $class='act-favorite';
                        if(count(Favourite::model()->findByAttributes(array('user_id'=>Yii::app()->user->id, 'item_id'=>$fr_prof->id, 'item_type'=>'4')))>0)
                            $class='isfav';
                        
                        $baby_admin=  BabyAccessRole::model()->findBySql('select * from '.BabyAccessRole::model()->tableSchema->name.' where baby_id in (select id from '.Baby::model()->tableSchema->name.' where user_id='.Yii::app()->user->id.') and user_id='.$fr_prof->id);
                        if($baby_admin){
                            if($baby_admin->role==1){
                                $access='Administrator';
                            }else{
                                $access='Sub-admin';
                            }
                        }else{
                            $access='Normal';
                        }
            ?>
            <div class="friend-wrap">
                <div class="friend-card">
                    <img src="<?=$fr_prof->image?>" width="50" alt="" class="friend-thumb" />
                    <div class="friend-overview">
                        <span class="message-date">Added: <?=date('d-m-Y',strtotime($fr->date_created));?></span>
                        <h3 class="friend-name"><?=$fr_prof->username;?></h3>
                        <span class="friend-connection"><?=$fr->connection->title;?></span>
                    </div>
                </div>
                <!--<div class="friend-info role">
                    <span class="info-label">User role:</span>
                    <strong class="info-value">Wife</strong>
                </div>-->
                <div class="friend-info acces" style="width:193px">
                    <span class="info-label">Access:</span>
                    <strong class="info-value" id="access-<?=$fr_prof->id?>"><?=$access?></strong>
                    <form id="form-<?=$fr_prof->id?>" style="display:none;" action="<?=Yii::app()->request->baseUrl?>/controlPanel/changeAccess?id=<?=$fr_prof->id?>" method="post">
                        <select name="role-<?=$fr_prof->id?>">
                            <option value="2" <?=$access=='Normal'?'selected':''?>>Normal</option>
                            <option value="0" <?=$access=='Sub-admin'?'selected':''?>>Sub-Admin</option>
                            <option value="1" <?=$access=='Administrator'?'selected':''?>>Administrator</option>
                        </select>
                        <input type="submit" class="blue save-btn" value="Save">
                    </form>
                </div>
                <div class="friend-actions">
                    <a href="javascript:void(0)" onclick="$('#form-<?=$fr_prof->id?>').show();$('#access-<?=$fr_prof->id?>').hide();" class="act-edit">Edit</a>
                    <a href="javascript:void(0)" id="fruser_<?=$fr_prof->id?>" onclick="favouriteFriend('user',<?=$fr_prof->id?>)" class="<?=$class?>">Favorite</a>
                    <a href="<?=Yii::app()->request->baseUrl?>/controlPanel/removeFriend/<?=$fr->id?>" class="act-delete">Delete</a>
                </div>
            </div>
            <?php
                    }
                }else{
					echo 'No friends found in your friend list.';
				}
            ?>

        </div>
        <!-- /#friends-manager -->
    </section>
    <!-- /.page-contain -->
</div>

<script>
    function favouriteFriend(type,id)
    {
        $.ajax({
                url:"<?=Yii::app()->request->baseUrl?>/home/favourite?type="+type+"&id="+id,
                success: function(data){
                        var arr=jQuery.parseJSON(data);
                        if(arr['status']==1)
                                $('#fruser_'+id).attr('class','isfav');
                        else
                                $('#fruser_'+id).attr('class','act-favorite');
                }
        });
    }
</script>