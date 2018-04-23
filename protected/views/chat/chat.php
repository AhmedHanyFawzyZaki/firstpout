<script>
    function chatWith(iden){
        $('#Chat_to_id').val(iden);
        $.ajax({
            url:'<?=Yii::app()->request->baseUrl?>/chat/loadMessages?id='+iden,
            success: function(data){
                $('#chat-content').html(data);
				$('#chat-content').scrollTop(100000);
				$('.user-div').each(function(index, element) {
                    $('#'+element.id).removeClass('active');
                });
				setTimeout(function(){
					$('.msg-cont').removeClass('new');
				},2000);
				$('#chat_user_'+iden).addClass('active');
				$('#counter_'+iden).fadeOut(2000,function(){$('#counter_'+iden).remove();});
            }
        });
    }
	
	function doAjaxSubmit(){
		var data=$('#chat-form').serialize();
		if($('#Chat_to_id').val()){
			$.ajax({
				url:"<?=Yii::app()->request->baseUrl?>/chat/sendMsg",
				data:data,
				type:"POST",
				success: function(response){
					chatWith($('#Chat_to_id').val());
					document.getElementById('chat-form').reset();
				}
			});
		}else{
			alert("Please select the user you want to chat with.");
		}
	}
</script>
<div class="row-fluid">
    <div class="span4 chat-users-div">
        <?php
        $users = User::model()->findAll(array('condition' => 'groups_id!=6'));
        if ($users) {
            foreach ($users as $user) {
                $notif_no = '';
                $count = count(Chat::model()->findAll(array('condition' => 'seen=0 and admin=1 and from_id=' . $user->id)));
                if ($count > 0)
                    $notif_no = '<span class="label label-warning pull-right" id="counter_'.$user->id.'">' . $count . '</span>';
                echo '<div class="user-div" onclick="chatWith('.$user->id.')" id="chat_user_'.$user->id.'"><span><img src="' . $user->image . '" width="15%" class="img-polaroid"><label class="chat-name">' . $user->username . ' ' . $notif_no . '</label></span></div>';
            }
        }
        ?>
    </div>
    <div class="span8">
        <div id="chat-content" class="chat-content-div"><span class="empty-chat">Select user from the left panel to view his messages.</span></div>
        <div class="send-form">
            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'chat-form',
                'enableAjaxValidation' => false,
                'type' => 'vertical',
            ));
            ?>

            <?php echo $form->hiddenField($model, 'to_id'); ?>

            <?php echo $form->textAreaRow($model, 'msg', array('rows' => 5, 'class' => 'span12')); ?>

            <?php echo $form->checkBoxRow($model, 'imp'); ?>

            <div class="pull-right">
            	<input type="button" value="Send" class="btn btn-primary" onclick="doAjaxSubmit()">
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>