<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <div class="page-actions admin-tabs">
            <a href="<?= Yii::app()->request->baseUrl ?>/home" class="back">Back</a>
            <a href="javascript:void(0)" class="current">All messages</a>
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/createBabyProfile">Create baby profile</a>
        </div>
    </div>
    <!-- /.page-head -->
    <section class="page-contain">
        <div class="messages-wrap">
            <?php
            if ($messages) {
                $msg_count = count($messages);
                $i=1;
                foreach ($messages as $msg) {
                    $imp='';
                    $owner='Admin';
                    $class='';
                    $admin_id=$msg->from_id;
                    $fav_msg='act-favorite';
                    if(!$msg->seen && $msg->from_id!=Yii::app()->user->id){ //admin message not seen
                        $class='unread';
                        $msg->seen=1;
                        $msg->save(false);
                    }
                    if($msg->from_id==Yii::app()->user->id){
                        $owner='My';
                        $admin_id=$msg->to_id;
                    }
                    if($msg->imp){
                        $imp='IMPORTANT!';
                    }
                    if($msg->fav){
                        $fav_msg='isfav';
                    }
                    ?>
                    <div class="message-wrap expanded <?=$class?>">
                        <div class="message-contain">
                            <span class="message-sender"><?=$owner?> message</span>
                            <div class="message-overview">
                                <h4 class="message-title">
                                    <a href="javascript:void(0)"><?=$imp?></a>
                                </h4>
                                <div class="message-summary">
                                    <p><?=$msg->msg?></p>
                                </div>
                            </div>
                            <?php
                            if ($i == $msg_count) { //last message
                                ?>
                                <div class="reply-form-wrap">
                                    <form action="?" method="post" id="reply-form">
                                        <p>
                                            <textarea name="reply" id="admin-reply"></textarea>
                                            <input type="hidden" name="admin" value="1">
                                        </p>
                                        <p>
                                            <!--<label class="checkbox">
                                                <input type="radio" name="update-me" />
                                                <span>Send me confirmation of receipt</span
                                            </label>>-->
                                            <button class="btn btn-default btn-submit" onclick="$.post('<?= Yii::app()->request->baseUrl ?>/home/replySubmit/<?= $admin_id ?>', $('#reply-form').serialize());
                                    document.getElementById('reply-form').reset();window.location='?';" type="button">Send</button>
                                        </p>
                                    </form>
                                </div>
                                <!-- /.leave-a-reply -->
                                <?php
                            }
                            ?>
                        </div>
                        <div class="message-actions">
                            <a href="<?=Yii::app()->request->baseUrl?>/controlPanel/favMsg/<?=$msg->id?>" class="<?=$fav_msg?>">&nbsp;</a>
                            <!--<a href="#" class="act-edit">&nbsp;</a>-->
                            <a href="<?=Yii::app()->request->baseUrl?>/controlPanel/delMsg/<?=$msg->id?>" class="act-delete">&nbsp;</a>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
            }else{
                echo 'No messages found!';
            }
            ?>

        </div>
    </section>
    <!-- /.page-contain -->
</div>
