<style>
    img{
        max-width:2000px !important;
    }
</style>
<script>
	function send(){
		if($('#User_username').val()==''){
			alert("Please Enter The Profile Name.");
		}else{
			var form=$("#doctor-form").serialize();
			$.ajax({
				url:"<?=Yii::app()->request->baseUrl?>/controlPanel/createDoctor",
				data:form,
				type: 'POST',
				dataType:'html',
				success: function(data){
					if(jQuery.trim(data)==1){
						parent.addDoctor();
						$.fancybox.close();
					}
				}
			});
		}
	}
</script>
<div id="timeline-board" class="page-wrap">
    <section class="page-contain">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'doctor-form',
            //'enableAjaxValidation' => true,
            'type' => 'horizontal',
            'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'form-wrap cp-forms',
				'onsubmit'=>"send(); return false;",
			),
        ));
        ?>
        <h1>Create Doctor OR Hospital?</h1>

        <fieldset>
        	<?php echo $form->dropDownListRow($model, 'groups_id', array('2'=>'Doctor', '3'=>'Hospital'), array('class' => 'form-select input-xlarge')); ?>
            <?php echo $form->textFieldRow($model, 'username', array('class' => 'input-xmedium', 'placeholder' => 'Profile Name')); ?>
            <?php echo $form->textFieldRow($model, 'email', array('class' => 'input-xmedium', 'placeholder' => 'Email')); ?>
            <?php echo $form->textFieldRow($model, 'phone', array('class' => 'input-xmedium', 'placeholder' => 'Phone')); ?>
			<?php echo $form->textFieldRow($model, 'street', array('class' => 'input-xmedium', 'placeholder' => 'Street')); ?>
            <?php echo $form->textFieldRow($model, 'city', array('class' => 'input-xmedium', 'placeholder' => 'City')); ?>
            <?php echo $form->dropDownListRow($model, 'country', CHtml::listData(AllCountries::model()->findAll(), 'country_id', 'country_name'), array('class' => 'input-xmedium', 'placeholder' => 'Country', 'style'=>'height:40px;color:#a9afb3;padding:0 15px;')); ?>
            <?php echo $form->textFieldRow($model, 'desc', array('class' => 'input-xmedium', 'placeholder' => 'Description')); ?>
            <div class="control-group">
                <label class="control-label" for="profile-name">PROFILE PICTURE:<small>Little description of photo uploading here</small></label>
                <div class="controls">
                    <?php echo $form->hiddenField($model, 'image'); ?>
                    <div id="cropContainerEyecandy" class="pull-left">
                        <?php
                        if ($model->image) {
                            echo '<img src="' . $model->image . '" class="croppedImg">';
 }
                        ?>
                    </div>
                    <a href="javascript:void(0);" class="avatar avatar-circle pull-left center-user-img">
                        <img src="<?= Yii::app()->request->baseUrl ?>" alt="" class="round-img-70" id="user-round-img"/>
                    </a>
                    <!--<input id="profile-name" name="profile-name" type="file" placeholder="Damian Popiół" class="form-uploader">-->
                </div>
            </div>
        </fieldset>
       
        <div class="submit-btn-wrap">
            <button type="submit" class="btn btn-green btn-submit">Create profile</button>
        </div>
        <?php $this->endWidget(); ?>
    </section>
    <!-- /.page-contain -->
</div>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/croppic/croppic.css" />
<script src="<?= Yii::app()->request->baseUrl ?>/js/croppic/croppic.min.js"></script>                
<script>
                            var croppicContainerEyecandyOptions = {
                                uploadUrl: '<?= Yii::app()->request->baseUrl ?>/croppic/saveOriginalImage',
                                cropUrl: '<?= Yii::app()->request->baseUrl ?>/croppic/saveCroppedImage',
                                //imgEyecandy:false,
                                loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
                                outputUrlId: 'User_image',
                            }
                            var userImageEyecandy = new Croppic('cropContainerEyecandy', croppicContainerEyecandyOptions);
</script>

<script>
    $(document).ready(function() {
        setInterval(function() {
            if ($('#User_image').val())
            {
                $('#user-round-img').attr('src', $('#User_image').val());
            }
        }, 2000);
    });
</script>