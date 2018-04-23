<div class="profile-cover">
    <img src="<?= $model->banner?$model->banner:Yii::app()->params['default_banner_image'] ?>" alt="<?= $model->title ?>" class="profile-img" width="560" height="308"/>
    <h1 class="baby-name"><?=$model->title?></h1>
    <div style="position:absolute;right:30px;top:20px;" id="btn-fr">
    <?php
    if(!Group::IsGroupAdmin($id,Yii::app()->user->id)){
        $is_member = GroupUser::model()->findByAttributes(array('group_id'=>$id, 'user_id'=>Yii::app()->user->id));
        $is_invitee = GroupInvitee::model()->findByAttributes(array('group_id'=>$id, 'user_id'=>Yii::app()->user->id));
        if($is_member){
            echo '<a href="javascript:void(0)" onclick="leaveGroup(' . $id . ')">Leave Group</a>';
        }elseif($is_invitee){
            if($is_invitee->status==1){
                echo '<a href="javascript:void(0)" onclick="removeRequest(' . $id . ')">Remove Request</a>';
            }else{
                echo '<a href="javascript:void(0)" onclick="acceptRequest(' . $id . ')">Accept</a>';
				echo '<a href="javascript:void(0)" style="margin:0px 5px;" onclick="removeRequest(' . $id . ')">Deny</a>';
            }
        }else{
            echo '<a href="javascript:void(0)" onclick="addRequest(' . $id . ')">Join</a>';
        }
    }
    ?>
    </div>
</div>
<!-- /.profile-cover -->

<script>
	function leaveGroup(id){
		$.ajax({
			url:"<?=Yii::app()->request->baseUrl?>/groups/leaveGroup/"+id,
			success:function(data){
				$('#btn-fr').html('<a href="javascript:void(0)" onclick="addRequest(' + id + ')">Join</a>');
			}
		});
	}
	function removeRequest(id){
		$.ajax({
			url:"<?=Yii::app()->request->baseUrl?>/groups/removeRequestGroup/"+id,
			success:function(data){
				$('#btn-fr').html('<a href="javascript:void(0)" onclick="addRequest(' + id + ')">Join</a>');
			}
		});
	}
	function addRequest(id){
		$.ajax({
			url:"<?=Yii::app()->request->baseUrl?>/groups/addRequestGroup/"+id,
			success:function(data){
				$('#btn-fr').html('<a href="javascript:void(0)" onclick="removeRequest(' + id + ')">Remove Request</a>');
			}
		});
	}
	function acceptRequest(id){
		$.ajax({
			url:"<?=Yii::app()->request->baseUrl?>/groups/acceptRequestGroup/"+id,
			success:function(data){
				if(jQuery.trim(data)=='1')
					$('#btn-fr').html('<a href="javascript:void(0)" onclick="leaveGroup(' + id + ')">Leave Group</a>');
				else
					alert('Access Denied');
			}
		});
	}
</script>