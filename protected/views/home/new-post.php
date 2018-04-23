<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'post-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'paddBottom0 form-wrap ajax-form width530'),
        ));
?>
<input type="hidden" name="isVideo" value="0" id="isVideo">
<h1 style="display:table;line-height:40px;font-size:14px;font-weight:100;padding-left:10px;">New Post 
<?php
	if($wrong){
		$babies = Baby::model()->findAllBySql('select * from '.Baby::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '" or id in (select baby_id from '.BabyAccessRole::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '" and role="1")');
		if($babies){
			foreach($babies as $bb){
				$arr['baby,'.$bb->id]= 'Baby "'.$bb->username.'"';
			}
		}
		$groups_ids = GroupUser::model()->findAll(array('condition' => 'user_id=' . Yii::app()->user->id));
		$ids = array(0);
		if ($groups_ids) {
			foreach ($groups_ids as $gr) {
				$ids[] = $gr->group_id;
			}
		}
		$groups = Group::model()->findAll(array('condition' => 'user_id=' . Yii::app()->user->id . ' OR id in(' . implode(',', $ids) . ')'));
		if($groups){
			foreach($groups as $bb){
				$arr['group,'.$bb->id]='Group "'.$bb->title.'"';
			}
		}
		if($arr){
			echo 'ON: &nbsp;';
			echo '<div style="width:250px;float:right;">'.CHtml::dropDownList('profile', '', $arr, array('class'=>'form-select')).'</div>';
		}
	}
?></h1>
<div id="al_title" style="display:none;">
    <hr class="noMargin light-hr">
    <input type="text" name="title" placeholder="Album name.." class="textarea-xlarge" id="alb_title">
</div>
<hr class="noMargin light-hr">
<?php echo $form->textArea($model, 'content', array('rows' => 5, 'cols' => 50, 'class' => 'textarea-xlarge', 'placeholder' => 'Enter your story text here..')); ?>
<div class="meter" id="pro-bar" style="position:relative;margin:10px 0px;top:0px;display:none;"><span style="width: 1%"></span></div>
<div class="img-area" id="show_PostImage_image">
</div>
<script>
    function readURL(input) {
		/*$('#pro-bar').css('display','block');
		var progress=0;
		$('#pro-bar').html('<span style="width: 0%"></span>');
		progress=((i+1)/input.files.length)*100;
		$('#pro-bar').html('<span style="width: '+progress+'%"></span>');*/
        for (var i = 0; i < input.files.length; i++) {

            if (input.files[i]) {
                var reader = new FileReader();
                /*var imgMeta = input.files[0];
                 var imgDate = imgMeta.lastModifiedDate;
                 var imgMonth = imgDate.getMonth() + 1;
                 var imgDay = imgDate.getDate();
                 var imgYear = imgDate.getFullYear();
                 var imgHours = imgDate.getHours();
                 var imgMin = imgDate.getMinutes();
                 var imgSec = imgDate.getSeconds();
                 $('#Post_image_date_taken').val(imgYear + '-' + imgMonth + '-' + imgDay + ' ' + imgHours + ':' + imgMin + ':' + imgSec);*/
				 reader.readAsDataURL(input.files[i]);
                 reader.onload = function(e) {
                    if ($('#isVideo').val() == 1) {
                        $('#show_PostImage_image').html('<iframe src="' + e.target.result + '" height="90" width="100" class="pull-left"></iframe>');
                    } else {
                        $('#show_PostImage_image').append('<div class="img-up-div"><img src="' + e.target.result + '" height="90" width="100" class="pull-left"><input type="hidden" name="images[]" value="' + e.target.result + '"><span class="img-up-rm" onclick="$(this).parent().remove();">X</span></div>');
                    }
					
                }
            }
        }
    }
</script>
<style>
	.stLarge{
		background:url("<?=Yii::app()->request->baseUrl?>/img/common/sprites1/social.png") no-repeat scroll 2px 17px / 20px auto rgba(0, 0, 0, 0) !important;
		width:30px !important;
		height:45px !important;
	}
	.st_sharethis_large {
	  height: 50px;
	  left: 177px;
	  position: relative;
	  top: 178px;
	  width: 174px;
	}
	.stButton {
	  float: left;
	  margin-left: 9px;
	}
</style>
<?php echo $form->hiddenField($model, 'image_date_taken'); ?>
<?php echo $form->fileField($model, 'image', array('style' => 'display:none;', 'onchange' => 'readURL(this)', 'accept' => 'image/*', 'multiple' => 'multiple')) ?>
<hr class="noMargin light-hr">
<div class="pull-left">
    <a class="upload-green" href="javascript:void(0);" onclick="$('#Post_image').click();">Upload media</a>
    <a class="share-grey">
    	Share with all
        <script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/share-this.js"></script>
<script type="text/javascript">stLight.options({publisher: "6269aa7f-a4c0-4854-9b77-73e1f74d5a30", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
        
        <span class='st_sharethis_large' displayText='ShareThis'></span>
<span class='st__large' displayText=''></span>
    </a>
</div>
<div class="pull-right">
    <button type="submit"  class="btn btn-green btn-submit height50 width179">Publish</button>
</div>
<!--<div class="social-grabber green-socials clear dark-green noMargin">
    <a href="#" class="src-picassa">
        <span>Picassa</span>
    </a>
    <a href="#" class="src-flickr">
        <span>Flickr</span>
    </a>
    <a href="javascript:void(0)" onclick="SocialPhotos('<?=Yii::app()->request->baseUrl?>/home/facebookPhotos', 'facebook')" class="fancyElm src-facebook">
        <span>Facebook</span>
    </a>
    <a href="#" class="src-instagram">
        <span>Instagram</span>
    </a>
    <a href="#" class="src-drive">
        <span>Google Drive</span>
    </a>
    <a href="#" class="src-dropbox">
        <span>Dropbox</span>
    </a>
    <a href="#" class="src-computer current">
        <span>Computer</span>
    </a>
</div>-->
<div>
    <a href="javascript:void(0);" onclick="media(0)" id="post-pic" class="new-post-pic act" >Picture</a>
    <a href="javascript:void(0);" onclick="media(1)" id="post-vid" class="new-post-pic">Video</a>
    <a href="javascript:void(0);" onclick="media(2)" id="post-alb" class="new-post-pic">Album</a>
    <script>
        function media(val) {
            $('#isVideo').val(val);
            $('#post-pic').attr('class', 'new-post-pic');
            $('#post-vid').attr('class', 'new-post-pic');
			$('#post-alb').attr('class', 'new-post-pic');
			$('#al_title').css('display','none');
			$('#alb_title').removeAttr('required');
            if (val == 1) {
                $('#post-vid').attr('class', 'new-post-pic act');
                $('#Post_image').attr('accept', 'video/*');
                $('#Post_image').removeAttr('multiple');
            } else if(val==2){
                $('#post-alb').attr('class', 'new-post-pic act');
                $('#Post_image').attr('accept', 'image/*');
                $('#Post_image').attr('multiple', 'multiple');
				$('#al_title').css('display','block');
				$('#alb_title').attr('required','required');
            }else{
				$('#post-pic').attr('class', 'new-post-pic act');
                $('#Post_image').attr('accept', 'image/*');
                $('#Post_image').attr('multiple', 'multiple');
			}
            $('#show_PostImage_image').html('');
        }
        
        function SocialPhotos(url, socialMedia){
            $.ajax({
                url:url,
                success:function(data){
                    var arr=jQuery.parseJSON(data);
                    if(arr['status']=='fail'){
                        //window.open(arr['link'],'FirstPout','width=500, height=500');
						if(arr['link']){
							if(confirm("Do you want to fetch images from your "+socialMedia+" account?")){
                        		window.location=arr['link'];
							}
						}
                    }else if(arr['status']=='success'){
                        
                    }
                }
            });
        }
    </script>
</div>
<?php $this->endWidget(); ?>