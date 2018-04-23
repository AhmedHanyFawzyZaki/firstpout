<div style="width:810px;">
    <div class="img-cont">
        <img src="<?= Yii::app()->request->baseUrl ?>/media/<?= $dir ?>/<?= $image ?>" style="vertical-align:middle;">
    </div>

    <div class="right-cont">
        <div style="display:table;">
            <img src="<?= $owner->image ?>" width="64" height="64" style="float:left;border:1px dashed;border-radius:50px;">
            <span style="float:left;color:#3b5998;font-weight:bold;font-size:16px;margin-left:10px;margin-top:20px;">
                <?= $owner->username ?>
            </span>
        </div>
        <div style="margin-top: 20px;">
            <div style="color:#3b5998;cursor: pointer;">
                <span onclick="likeImage('<?=$type?>',<?= $id ?>)" id="like_unlike"><?= $i_liked ? 'Unlike' : 'Like' ?></span>
                &nbsp;.&nbsp;
                <span onclick="$('#img_reply').focus();">Comment</span>
            </div>
            <div style="width: 0; height: 0; border-left: 6px solid transparent; border-right: 6px solid transparent; border-bottom: 7px solid #e9eaed;margin-left: 20px;"></div>
            <div class="like-cont clear" style="background:#e9eaed;padding:2px;color:#3b5998;display: table;width: 100%;border-bottom: 1px solid #fff;">
                <img src="<?= Yii::app()->request->baseUrl ?>/img/like.png" width="24" style="float: left;"> 
                <span style="float: left;line-height: 22px;" id="like_img"><?= $likes ?> people</span>
                <span style="color:#000;float: left;line-height: 22px;"> &nbsp;like this.</span>
            </div>
            <div id="img_comments" style="background:#e9eaed;padding:2px;width: 100%;overflow-y: auto;max-height:195px;">
                <?php
                if ($comments) {
                    foreach ($comments as $comment) {
                        ?>
                        <div class="img-comm-cont">
                            <img src="<?= $comment->user->image ?>" width="32" height="32" class="pull-left">
                            <span class="img-comm-cont-span">
                                <p class="img-comm-cont-name"><?= $comment->user->username ?></p>
                                <p><?= nl2br($comment->comment) ?></p>
                            </span>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div style="background:#e9eaed;padding:2px;color:#3b5998;display: table;width: 100%;border-bottom: 1px solid #fff;">
                <img src="<?= User::model()->findByPk(Yii::app()->user->id)->image ?>" width="32" height="32" style="float:left;">
                <textarea id="img_reply" onkeypress="if (event.keyCode == 13 && event.shiftKey === false) {
                        commentImage('<?=$type?>',<?= $id ?>)
                    }" style="border: 0 none;border-radius: 0;float: left;margin-left: 4px;padding: 3px;resize: none;width: 229px;margin-bottom: 5px;"></textarea>
            </div>
        </div>
    </div>

    <script>
        function likeImage(type, id)
        {
            $.ajax({
                url: "<?= Yii::app()->request->baseUrl ?>/home/like?type=" + type + "&id=" + id,
                success: function(data) {
                    var arr = jQuery.parseJSON(data);
                    $('#like_img').html(arr['count'] + ' people');
                    if (arr['status'] == 2)
                        $('#like_unlike').html('Like');
                    else
                        $('#like_unlike').html('Unlike');
                }
            });
        }
        function commentImage(type, id)
        {
            var reply = $('#img_reply').val();
            $.ajax({
                url: "<?= Yii::app()->request->baseUrl ?>/home/comment",
                type: 'POST',
                data: {'reply': reply, 'id': id, 'type': type},
                success: function(data) {
                    if (data)
                    {
                        var arr = jQuery.parseJSON(data);
                        $('#img_reply').val('');
                        $('#img_comments').html(arr['comments']);
                    }
                    else
                        alert("An error has occured, pleas try again later!");
                }
            });
        }
    </script>
</div>