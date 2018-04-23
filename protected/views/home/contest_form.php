<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <div class="page-actions normal-tabs">
            <h2 class="page-title"><?php echo date('F',strtotime($contest->date_start))?> Contest</h2>
        </div>
    </div>
    <!-- /.page-head -->
    <section class="contest-contain">
        <?php $this->renderPartial('contest_header')?>
        <!-- /.contest-wrap -->
        <div class="contest-form form-wrap">
            <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                    'id'=>'contest-user-form',
                    'enableAjaxValidation'=>true,
                    'type'=>'horizontal',
                    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
            )); ?>
                <h2><?=$model->isNewRecord?"Add":"Edit"?> contest album!</h2>
                <?php
                	if(Yii::app()->user->hasFlash('done'))
						echo '<div class="alert alert-success">' . Yii::app()->user->getFlash("done") . '</div>';
				?>
                <div class="control-group">
                  <label class="control-label" for="baby profile">Choose baby profile:<small>Only one entry for each baby profile?</small></label>
                  <div class="controls">
                    <?php
						echo $form->error($model,'baby_id',array('class'=>'error red'));
                    	if($model->isNewRecord)
							echo $form->dropDownList($model,'baby_id',Helper::ListMyBabyProfiles(Yii::app()->user->id, ' and id not in(select baby_id from '.ContestUser::model()->tableSchema->name.')'),array('class'=>'form-select'));
						else
							echo $form->dropDownList($model,'baby_id',Helper::ListMyBabyProfiles(Yii::app()->user->id, ''),array('class'=>'form-select', 'readonly'=>'readonly'));
					?>
                  </div>
                </div>
                <div class="control-group has-photo-uploader">
                  <label class="control-label" for="add-pictures">Add pictures:<small>Little description of photo uploading here</small></label>
                  <div class="controls">
                    
                    <?php
                    	echo $form->fileField($model_image,'image[]',array('class'=>'form-uploader','onchange'=>'readURL(this)','multiple'=>"multiple"))
					?>
                    <!--<div class="social-grabber">
                        <a href="#" class="src-picassa">
                            <span>Picassa</span>
                        </a>
                        <a href="#" class="src-flickr">
                            <span>Flickr</span>
                        </a>
                        <a href="#" class="src-facebook current">
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
                        <a href="#" class="src-computer">
                            <span>Computer</span>
                        </a>
                    </div>-->
                    <br><br>
                    <small>Your Main picture</small>
                    <div class="pictures-uploader">
                    	<?php 
						if($images)
						{
							//$path=Yii::app()->request->baseUrl.'/media/contests/contest'.$model->contest_id.'/'.$model->user_id;
							$path=Yii::app()->request->baseUrl.'/media/contests';
							for($i=0;$i<3;$i++)
							{
								$img_class='';
								$extra='width="80" style="margin-top:-60px"';
								if($i==0)
								{
									$img_class=' mega-pic';
									$extra='width="120" style="margin-top:-75px"';
								}
								if($images[$i])
								{
									echo '<a href="javascript:void(0)" class="pic-item'.$img_class.'" id="img_'.$i.'"><img src="'.$path.'/'.$images[$i]->image.'" '.$extra.'></a>';
								}else{
									echo '<a href="javascript:void(0)" class="pic-item'.$img_class.'" id="img_'.$i.'">&nbsp;</a>';
								}
							}
						}
						else{
						?>
                            <a href="javascript:void(0)" class="pic-item mega-pic" id="img_0">&nbsp;</a>
                            <a href="javascript:void(0)" class="pic-item" id="img_1">&nbsp;</a>
                            <a href="javascript:void(0)" class="pic-item" id="img_2">&nbsp;</a>
                         <?php }?>
                    </div>
                  </div>

                </div>
                <div class="control-group">
                  <label class="control-label" for="description">Add little description:<small>Problem with adding pictures?</small></label>
                  <div class="controls">
                    <?=$form->textArea($model,'desc', array('class'=>'textarea-xlarge'))?>
                  </div>
                </div>
                <div class="submit-btn-wrap">
                    <button type="submit" class="btn btn-green btn-submit">Save</button>
                    <label class="checkbox">
                        <input value="1" <?=$model->isNewRecord?'':'checked'?> type="checkbox" required="" name="accept-terms" id="accept-terms">
                        <span>I read and agree the terms of this contest</span>
                    </label>
                </div>
            <?php $this->endWidget(); ?>
        </div>
        <?php
        	if($model->isNewRecord){
		?>
        <!-- /.contest-form -->
        <div class="plain-text-block">
            <h1>Do You have some funny pictures of Your kid?</h1>
            <h3>Informations</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas non massa egestas, fermentum augue non, tempor lacus. Vivamus suscipit lacus non eleifend aliquet. Aliquam erat volutpat. Curabitur turpis nibh, eleifend vel tempus ac, tempor eget arcu.
            </p>
            <p>
                Integer scelerisque est non sem laoreet posuere. Ut nec magna convallis, lobortis lorem vel, porta sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas non massa egestas, fermentum augue non, tempor lacus. Vivamus suscipit lacus non eleifend aliquet. Aliquam erat volutpat. Curabitur turpis nibh, eleifend vel tempus ac, tempor eget arcu.
            </p>
            <p>Integer scelerisque est non sem laoreet posuere. Ut nec magna convallis, lobortis lorem vel, porta sem. </p>
        </div>
        <!-- /.plain-text-block -->
        <div class="plain-text-block">
            <h2>Rules:</h2>
            <h3>Informations</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas non massa egestas, fermentum augue non, tempor lacus. Vivamus suscipit lacus non eleifend aliquet. Aliquam erat volutpat. Curabitur turpis nibh, eleifend vel tempus ac, tempor eget arcu.
            </p>
            <ul>
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </li>
                <li>Nostrum, aperiam. Deserunt itaque pariatur</li>
                <li>saepe possimus veritatis illum aspernatur ipsum, non nesciunt explicabo neque quisquam.</li>
                <li>Eaque iste tempore nihil voluptatibus ullam.</li>
            </ul>
            <p>
                Integer scelerisque est non sem laoreet posuere. Ut nec magna convallis, lobortis lorem vel, porta sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas non massa egestas, fermentum augue non, tempor lacus. Vivamus suscipit lacus non eleifend aliquet. Aliquam erat volutpat. Curabitur turpis nibh, eleifend vel tempus ac, tempor eget arcu.
            </p>
            <p>Integer scelerisque est non sem laoreet posuere. Ut nec magna convallis, lobortis lorem vel, porta sem. </p>
        </div>
        <!-- /.plain-text-block -->
        <?php }?>
    </section>
    <!-- /.page-contain -->
</div>

<script>
var count=0;
function readURL(input) {
	count=0;
	if(input.files.length > 3){
		alert("Only 3 images are allowed.");
	}else if(input.files.length < 1){
		alert("You should upload at least 1 image to participate in the contest.");
	}else{
		$('#img_0').html(' ');
		$('#img_1').html(' ');
		$('#img_2').html(' ');
		for(var i=0;i<input.files.length;i++){
			if (input.files[i]){
				var reader = new FileReader();
				reader.readAsDataURL(input.files[i]);
				reader.onload = addImg;
			}
		}
	}
	
	function addImg(e){
		if(count==0)
			$('#img_'+count).html('<img src="'+e.target.result+'" width="120" style="margin-top:-75px">');
		else
			$('#img_'+count).html('<img src="'+e.target.result+'" width="80" style="margin-top:-60px">');
		count++;
	}
	/*if (input.files && input.files[0]) {
		var reader = new FileReader();
		var imgMeta=input.files[0];
		var imgDate=imgMeta.lastModifiedDate;
		var imgMonth=imgDate.getMonth() + 1;
		var imgDay=imgDate.getDate();
		var imgYear=imgDate.getFullYear();
		var imgHours=imgDate.getHours();
		var imgMin=imgDate.getMinutes();
		var imgSec=imgDate.getSeconds();
		$('#hiddenTakenDate_'+input.id).val(imgYear+'-'+imgMonth+'-'+imgDay+' '+imgHours+':'+imgMin+':'+imgSec);
		reader.onload = function (e) {
			$('#show_'+input.id).html('<img src="'+e.target.result+'" width="50" class="pull-left">');
		}
		reader.readAsDataURL(input.files[0]);
	}*/
	
}
</script>