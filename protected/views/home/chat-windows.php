<?php
$chat_users = User::model()->findAllBySql('select * from '.User::model()->tableSchema->name.' where id!=' . Yii::app()->user->id . ' and (id in (select user_id from '.UserFriend::model()->tableSchema->name.' where friend_id=' . Yii::app()->user->id . '  and approved=1) or id in (select friend_id from '.UserFriend::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ' and approved=1))');
//$chat_users=User::model()->findAllBySql('select * from '.User::model()->tableSchema->name.' where id!='.Yii::app()->user->id.' or id in (select user_id from '.UserFriend::model()->tableSchema->name.' where friend_id='.Yii::app()->user->id.') or user_id in (select friend_id from '.UserFriend::model()->tableSchema->name.' where user_id='.Yii::app()->user->id.') order by rand()');
//$chat_users = User::model()->findAll(array('condition' => 'id!=' . Yii::app()->user->id));
if ($chat_users) {
    foreach ($chat_users as $c_u) {
        //open boxes of users chatting me
        $not_seen = Chat::model()->findAllByAttributes(array('seen' => '0', 'to_id' => Yii::app()->user->id, 'from_id' => $c_u->id, 'admin' => 0));
        $style = '';
        if ($not_seen || (Yii::app()->user->hasState('openBoxes') && in_array($c_u->id, Yii::app()->user->getState('openBoxes')))) {
            $style = 'style="display:block;"';
        }
        $chat_records = Chat::model()->findAllBySql('select * from '.Chat::model()->tableSchema->name.' where admin=0 and (to_id="' . Yii::app()->user->id . '" and from_id="' . $c_u->id . '") OR (from_id="' . Yii::app()->user->id . '" and to_id="' . $c_u->id . '")');
        ?>
        <div id="chat-userid-<?= $c_u->id ?>" class="chat-window" <?= $style ?> onClick="$.get('<?= Yii::app()->request->baseUrl ?>/home/setSeen/<?= $c_u->id ?>');" >
            <a href="#" class="close-window" onClick="$.get('<?= Yii::app()->request->baseUrl ?>/home/unSetOpenBox/<?= $c_u->id ?>');">close X</a>
            <h3 class="chat-title">Chat window with <a href="#"><?= $c_u->username ?></a></h3>
            <div class="conversation-wrap replace-chat-div" id="replace-chat-userid-<?= $c_u->id ?>" >
                <?php
                if ($chat_records) {
                    foreach ($chat_records as $c_r) {
                        if ($c_r->msg_type == 0)
                            $msg = nl2br($c_r->msg);
                        else {
                            if (strpos(strtolower($c_r->msg), '.png') || strpos(strtolower($c_r->msg), '.jpg') || strpos(strtolower($c_r->msg), '.gif') || strpos(strtolower($c_r->msg), '.jpeg')) {
                                $msg = '<img src="' . Yii::app()->request->baseUrl . '/media/chat/' . $c_r->msg . '" width="200">';
                            } else {
								if (strpos(strtolower($c_r->msg), '.docx') || strpos(strtolower($c_r->msg), '.doc') || strpos(strtolower($c_r->msg), '.odt') || strpos(strtolower($c_r->msg), '.dotm')){
									$msg='<img src="'.Yii::app()->request->baseUrl.'/img/docx.png" class="pull-left" width="24" height="24">';
								}elseif (strpos(strtolower($c_r->msg), '.csv') || strpos(strtolower($c_r->msg), '.xls') || strpos(strtolower($c_r->msg), '.xlsx') || strpos(strtolower($c_r->msg), '.odm')){
									$msg='<img src="'.Yii::app()->request->baseUrl.'/img/csv.png" class="pull-left" width="24" height="24">';
								}elseif (strpos(strtolower($c_r->msg), '.txt') || strpos(strtolower($c_r->msg), '.xml') || strpos(strtolower($c_r->msg), '.html') || strpos(strtolower($c_r->msg), '.sql') || strpos(strtolower($c_r->msg), '.css')){
									$msg='<img src="'.Yii::app()->request->baseUrl.'/img/notepad.png" class="pull-left" width="24" height="24">';
								}elseif (strpos(strtolower($c_r->msg), '.pdf')){
									$msg='<img src="'.Yii::app()->request->baseUrl.'/img/pdf.png" class="pull-left" width="24" height="24">';
								}
                                $msg .= '<a href="' . Yii::app()->request->baseUrl . '/home/download?name=' . $c_r->msg . '" class="pull-left chat-download">' . explode('---', $c_r->msg)[1] . '</a>';
                            }
                        }
                        $cl = 'has-reciever';
                        if ($c_r->from_id == Yii::app()->user->id)
                            $cl = 'has-sender';
                        ?>
                        <div class="message-wrap <?= $cl ?>">
                            <a href="javascript:void(0)" class="person-thumb-wrap">
                                <img src="<?= $c_r->from->image ?>" alt="" class="person-thumb" />
                            </a>
                            <div class="message-content">
                                <div class="person-overview">
                                    <h3 class="person-name"><?= $c_r->from->username ?></h3>
                                    <span class="message-date"><?= Helper::ago($c_r->date_created) ?></span>
                                </div>
                                <div class="message-plain">
                                    <p>
                                        <?php
                                        echo $msg;
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <form action="?" enctype="multipart/form-data" id="reply-form-<?= $c_u->id ?>" class="reply-form">
                <textarea name="reply" onkeypress="if (event.keyCode == 13 && event.shiftKey === false) {
                            $('#btn-sb-<?= $c_u->id ?>').click();
                        }"></textarea>
                <div class="form-actions">
                    <input type="file" id="file-<?= $c_u->id ?>" style="display:none;" onChange="replyFile(this,<?= $c_u->id ?>)">
                    <a href="javascript:void(0)" onClick="$('#file-<?= $c_u->id ?>').click();" class="attach-file">Attach a file</a>
                    <button type="button" id="btn-sb-<?= $c_u->id ?>" onClick="$.post('<?= Yii::app()->request->baseUrl ?>/home/replySubmit/<?= $c_u->id ?>', $('#reply-form-<?= $c_u->id ?>').serialize());
                            document.getElementById('reply-form-<?= $c_u->id ?>').reset();
                            CheckChatBoxes();">Send</button>
                </div>
            </form>
        </div>
        <?php
    }
}
?>

<script>
    function replyFile(input, window_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#reply-form-' + window_id).prepend('<div class="meter" id="pro-bar' + window_id + '"><span style="width: 5%"></span></div>');
                var files = input.files;
                var fd = new FormData();
                fd.append('file', files[0]);
                var uploadURL = "<?= Yii::app()->request->baseUrl ?>/home/fileUpload/" + window_id; //Upload URL
                var extraData = {}; //Extra Data.
                var jqXHR = $.ajax({
                    url: uploadURL,
                    type: "POST",
                    contentType: false,
                    processData: false,
                    cache: false,
                    data: fd,
                    xhr: function() {  // custom xhr
                        myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) { // check if upload property exists
                            myXhr.upload.addEventListener('progress', function(e) {
                                var pc = parseInt((e.loaded / e.total * 100));
                                $('#pro-bar' + window_id).html('<span style="width: ' + pc + '%"></span>');
                            }, false);
                        }
                        return myXhr;
                    },
                    success: function(data) {
                        CheckChatBoxes();
                        setTimeout(function() {
                            $('#pro-bar' + window_id).slideUp(2000, function() {
                                $('#pro-bar' + window_id).remove();
                            });
                        }, 1000);
                    }
                });
            }
            reader.readAsDataURL(input.files[0]);
        }

    }
</script>