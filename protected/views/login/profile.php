<style>
img{
	max-width:2000px !important;
}
</style>
<main id="main" class="container">
    <div class="hp-row">
        <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'user-form',
                'enableAjaxValidation' => false,
                'type' => 'horizontal',
                'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'form-wrap normal-labels'),
            ));
            ?>
        <article class="profile-settings">
                <div class="page-overview">
                    <h2>Create Your profile!</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque viverra purus in <br />velit ullamcorper euismod. Nunc eget tellus urna. </p>
                </div>
                <?php echo $form->textFieldRow($model, 'username', array('class' => 'input-xlarge', 'maxlength' => 50, 'placeholder' => 'Profile name')); ?>
                <div class="control-group">
                    <label class="control-label" for="profile-name">PROFILE PICTURE:<small>Litlle description of photo uploading here</small></label>
                    <div class="controls">
                        <?php echo $form->hiddenField($model, 'image');?>
                        <div id="cropContainerEyecandy" class="pull-left">
                        	<?php
                            	if($model->image)
								{
									echo '<img src="' . $model->image . '" class="croppedImg">';
								}
							?>
                        </div>
                        <a href="javascript:void(0);" class="avatar avatar-circle pull-left center-user-img">
                            <img src="<?=Yii::app()->request->baseUrl?>" alt="" class="round-img-70" id="user-round-img"/>
                        </a>
                        <!--<input id="profile-name" name="profile-name" type="file" placeholder="Damian Popiół" class="form-uploader">-->
                    </div>
                </div>
                <!--<div class="control-group avatar-editor">
                    <div class="controls">
                        <a href="javascript:void(0);" class="avatar">
                            <img src="<?=Yii::app()->request->baseUrl?>/img/dyn/avatar-100x100.jpg" alt="" />
                        </a>
                        <a href="javascript:void(0);" class="avatar avatar-circle">
                            <img src="<?=Yii::app()->request->baseUrl?>/img/dyn/avatar-50x50.jpg" alt="" />
                        </a>
                        <div class="avatar-details">
                            <a class="avatar-file" href="#">wiktoria.jpg</a>
                            <div class="avatar-actions">
                                <a class="avatar-crop" href="#">crop</a>
                                <a class="avatar-edit" href="#">edit</a>
                                <a class="avatar-remove" href="#">remove</a>
                            </div>
                        </div>
                    </div>
                </div>-->
        </article>
        <div class="profile-info">
                <div class="page-overview">
                    <h2>Profile info:</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque viverra purus in <br />velit ullamcorper euismod. Nunc eget tellus urna. </p>
                </div>
                <?php echo $form->textFieldRow($model, 'street', array('class' => 'input-xlarge', 'placeholder' => 'Address')); ?>
                <?php echo $form->textFieldRow($model, 'city', array('class' => 'input-xlarge', 'placeholder' => 'City')); ?>
                <?php echo $form->textFieldRow($model, 'post_code', array('class' => 'input-xlarge', 'placeholder' => 'Post Code')); ?>
                <?php echo $form->dropDownListRow($model, 'country', CHtml::listData(AllCountries::model()->findAll(),'country_id','country_name'),array('class' => 'input-xlarge dropdown-cust')); ?>

                <div class="submit-btn-wrap">
                    <button type="submit" class="btn btn-green btn-big-submit">Save</button>
                    <a href="<?=Yii::app()->request->baseUrl?>/login/completeProfile"><button type="button" class="btn btn-transparent btn-big-submit">Skip</button></a>
                </div>
    </div>
        <?php $this->endWidget(); ?>
        <!-- /.registration-wrap -->
        <div class="fp-steps">
            <a href="javascript:void(0)" class="fp-step">Step 1</a>
            <a href="javascript:void(0)" class="fp-step current">Step 2</a>
            <a href="javascript:void(0)" class="fp-step">Step 3</a>
        </div>
    </div>
</main>

<script type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/vendor/jquery.simplefileinput.js"></script>
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
    $(document).ready(function(){
        setInterval(function(){
			if($('#User_image').val())
			{
				$('#user-round-img').attr('src',$('#User_image').val());
			}
		},2000);
    });
</script>