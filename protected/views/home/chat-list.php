<?php
$chat_users = User::model()->findAllBySql('select * from '.User::model()->tableSchema->name.' where id!=' . Yii::app()->user->id . ' and (id in (select user_id from '.UserFriend::model()->tableSchema->name.' where friend_id=' . Yii::app()->user->id . '  and approved=1) or id in (select friend_id from '.UserFriend::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ' and approved=1))');
//$chat_users=User::model()->findAll(array('condition'=>'id!='.Yii::app()->user->id));
if ($chat_users) {
    foreach ($chat_users as $c_u) {
        $class = $c_u->chat_status == 1 ? 'busy' : ($c_u->chat_status == 2 ? 'offline' : 'online');
        if (time() - strtotime($c_u->date_updated) > 30) { //30 sec
            $class = 'offline';
        }
        ?>
        <a class="<?= $class ?>" href="#" data-userid="<?= $c_u->id ?>" onClick="$.get('<?= Yii::app()->request->baseUrl ?>/home/setOpenBox/<?= $c_u->id ?>');">
            <div class="avatar-wrap">
                <img class="friend-avatar" src="<?= $c_u->image ?>" alt=""  width="33" height="33"/>
            </div>
            <span class="friend-overview">
                <span class="friend-name"><?= $c_u->username ?></span>
                <span class="friend-status"><?= $class ?></span>
            </span>
        </a>
        <?php
    }
} else {
    echo '<br><label style="padding: 0px 22px;">Your friend list is empty!</a>';
}
?>