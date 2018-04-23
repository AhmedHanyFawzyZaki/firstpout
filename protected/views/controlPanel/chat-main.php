<script>
	$(document).ready(function(e) {
        $('#chat-user-div').scrollTop(100000000000);
		setInterval(function(){
			chatWith($('#Chat_to_id').val(),'0');
		},6000);
    });
	function chatWith(iden, gotobottom='1'){
        $('#Chat_to_id').val(iden);
        $.ajax({
            url:'<?=Yii::app()->request->baseUrl?>/controlPanel/loadMessages?id='+iden,
            success: function(data){
                $('#chat-user-div').html(data);
				if(gotobottom=='1')
					$('#chat-user-div').scrollTop(10000000000);
				$('.person-card').each(function(index, element) {
                    $('#'+element.id).removeClass('current-user');
                });
				$('#user-ch-'+iden).addClass('current-user');
				//$('#counter_'+iden).fadeOut(2000,function(){$('#counter_'+iden).remove();});
            }
        });
    }
</script>
<div id="timeline-board" class="page-wrap chat-wrap">
    <div class="page-head">
        <div class="page-actions family-tabs">
            <a href="<?= Yii::app()->request->baseUrl ?>/home" class="back">Back</a>
            <!--<a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/editProfile" class="profile-link">
                Edit Profile
            </a>-->
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/chat" class="profile-link current">
                Chat
            </a>
            <a></a>
            <!--<a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/linkSocial" class="profile-link">
                Social Accounts
            </a>
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/createBabyProfile" class="create-profile">Create baby profile</a>-->
        </div>
    </div>
    <!-- /.page-head -->
    <section class="page-contain">
        <div class="chat-main-wrap">
            <div class="chat-friends-list custom-scroll">
            	<?php
                	if($users){
						foreach($users as $i=>$user){
							$class='';
							if($i==0){
								$class='current-user';
								$messages=Chat::model()->findAll(array('condition'=>'(to_id='.Yii::app()->user->id.' and from_id='.$user->id.') or (from_id='.Yii::app()->user->id.' and to_id='.$user->id.')'));
								$model->to_id=$user->id;
							}
							
							$last_message=Chat::model()->find(array('condition'=>'(to_id='.Yii::app()->user->id.' and from_id='.$user->id.') or (from_id='.Yii::app()->user->id.' and to_id='.$user->id.')'));
						?>
                        <div class="person-card <?=$class?>" id="user-ch-<?=$user->id?>" style="cursor:pointer" onclick="chatWith(<?=$user->id?>)">
                            <img src="<?=$user->image?>" width="45" alt="<?=$user->username?>" class="person-thumb" />
                            <div class="person-overview">
                                <span class="message-date"><?= Helper::ago($last_message->date_created) ?></span>
                                <h3 class="person-name" style="font-size:12px;"><?=$user->username?></h3>
                                <span class="person-connection"><?=$user->connection->title?></span>
                            </div>
                        </div>
                        <?php
						}
					}else{
						echo '<div class="person-card"><h3 class="person-name">No users found.</h3></div>';
					}
				?>
            </div>
            <!-- /.chat-friends-list -->
            <div class="chat-windows-wrap">
            	<?php
                	if($messages){
				?>
                <div class="chat-window" style="z-index:0 !important;height:450px;background:#fff;overflow-y:scroll">
                    <h3 class="chat-title">Chat window with <?=$user->username?></h3>
                    <div id="chat-user-div">
                    <?php
                    	foreach($messages as $ms){
							$class='has-sender';
							if($ms->to_id==Yii::app()->user->id)
								$class='has-receiver';
							
							if ($ms->msg_type == 0)
								$msg = nl2br($ms->msg);
							else {
								if (strpos($ms->msg, '.png') || strpos($ms->msg, '.jpg') || strpos($ms->msg, '.gif') || strpos($ms->msg, '.jpeg')) {
									$msg = '<img src="' . Yii::app()->request->baseUrl . '/media/chat/' . $ms->msg . '" width="200">';
								} else {
									$msg = '<a href="' . Yii::app()->request->baseUrl . '/home/download?name=' . $ms->msg . '">' . explode('---', $ms->msg)[1] . '</a>';
								}
							}
					?>
                    <div class="message-wrap <?=$class?>">
                        <a href="javascript:void(0)" class="person-thumb-wrap">
                            <img src="<?=$ms->from->image?>" alt="<?=$ms->from->username?>" class="person-thumb" />
                        </a>
                        <div class="message-content">
                            <div class="person-overview">
                                <h3 class="person-name"><?= $ms->from->username?></h3>
                                <span class="message-date"><?= Helper::ago($ms->date_created) ?></span>
                            </div>
                            <div class="message-plain">
                                <p><?=$msg?></p>
                            </div>
                        </div>
                    </div>
                    <?php
						}
					?>
                    </div>
                </div>
                <div class="reply-form-wrap">
                    <h3>Write Your message</h3>
                    <?php
					$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
						'id' => 'reply-form',
						'enableAjaxValidation' => false,
						'type' => 'vertical',
						'htmlOptions'=>array('enctype'=>'multipart/form-data'),
					));
					?>
                    <?php echo $form->hiddenField($model, 'to_id'); ?>
                        <p>
                        	<textarea name="reply" onkeypress="if (event.keyCode == 13 && event.shiftKey === false) {$('#sb-btn-main').click();}"></textarea>
                        </p>
                        <div id="attachments-wrap">
                        	<input type="file" name="attach-file" id="aa" style="display:none;" onChange="sendFile(this)">
                            <div class="attach-file">
                                <input type="text" onclick="$('#aa').click();" class="form-uploader" />
                            </div>
                            <div class="attach-normal">
                                <input type="text" onclick="$('#aa').click();" class="form-uploader" />
                            </div>
                            <div class="attach-img">
                                <input type="text" onclick="$('#aa').click();" class="form-uploader" />
                            </div>
                        </div>
                        <button class="btn btn-default btn-submit" id="sb-btn-main" type="button" onclick="$.post('<?= Yii::app()->request->baseUrl ?>/home/replySubmit/'+$('#Chat_to_id').val(), $('#reply-form').serialize());document.getElementById('reply-form').reset();">Send</button>
					<?php $this->endWidget(); ?>
                </div>
                <?php
					}else{
						echo 'No users found.';
					}
				?>
                <!-- /.leave-a-reply -->
            </div>
            <!-- /.chat-windows-wrap -->
        </div>
    </section>
    <!-- /.page-contain -->
</div>

<script>
	function sendFile(input) {
		var window_id=$('#Chat_to_id').val();
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#reply-form').prepend('<div class="meter-main" id="pro-bar"><span style="width: 5%"></span></div>');
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
						if(myXhr.upload){ // check if upload property exists
							myXhr.upload.addEventListener('progress',function(e) {
								var pc = parseInt((e.loaded / e.total * 100));
								$('#pro-bar').html('<span style="width: '+pc+'%"></span>');
							}, false);
						}
						return myXhr;
					},
					success: function(data) {
						chatWith(window_id);
						setTimeout(function(){
							$('#pro-bar').slideUp(2000,function(){
								$('#pro-bar').remove();
							});
						},1000);
						//CheckChatBoxes();
					}
				});
			}
			reader.readAsDataURL(input.files[0]);
		}

	}
</script>