<?php
$myimage=User::model()->findByPk(Yii::app()->user->id)->image;
$myimage=$myimage ? (strpos($myimage, "http://")!== false ? $myimage :  Yii::app()->params['adminEmail'].$myimage) : '';
?>
<script>
	function ChangeSocialLinks(url){
		$('#share-facebook').attr('href','https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(url));
		$('#share-twitter').attr('href','https://twitter.com/intent/tweet?text=Check%20this%20profile&via=FirstPout&url='+encodeURIComponent(url));
		$('#share-pinterest').attr('href','http://www.pinterest.com/pin/create/button/?url='+encodeURIComponent(url)+'&media=<?=urlencode(Yii::app()->getBaseUrl(true).$myimage)?>&description=<?=urlencode('Check this profile.')?>');
		$('#share-google').attr('href','https://plus.google.com/share?url='+encodeURIComponent(url)+'&hl=en-US');
		$('#share-email').attr('href','https://api.addthis.com/oexchange/0.8/forward/email/offer?url='+encodeURIComponent(url)+'&pubid=ra-51f9247d3cca3259&ct=1');
	}
	function ChangeClipLink(url){
		$('#clip-link').html(url);
	}
</script>
<form action="?" class="form-wrap ajax-form" method="post">
	<h1>Share Your story</h1>
	<fieldset class="sharing-subject">
		<legend>Choose what do You want to share:</legend>
		<div class="control-group">
			<label class="control-label" for="profiles-list">Profile</label>
			<div class="controls">
				<select name="profiles-list" id="profiles-list" class="form-select" onchange="ChangeSocialLinks(this.value)">
			    	<option value="<?=Yii::app()->getBaseUrl(true).'/userProfile/'.Yii::app()->user->id?>">My Profile</option>
                    <?php
                    if($profiles){
						foreach($profiles as $prof){
					?>	
                    		<option value="<?=Yii::app()->getBaseUrl(true).'/babyProfile/'.$prof->id?>"><?=$prof->username?></option>
                    <?php
						}
					}
					?>
			    </select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="albums-list">Album</label>
			<div class="controls">
				<select name="albums-list" id="albums-list" class="form-select" onchange="ChangeSocialLinks(this.value)">
			    	<option value="">Select Album</option>
			    	<?php
                    if($albums){
						foreach($albums as $album){
					?>	
                    		<option value="<?=Yii::app()->getBaseUrl(true).'/controlPanel/viewAlbum/'.$album->id?>"><?=$album->title?></option>
                    <?php
						}
					}
					?>
			    </select>
			</div>
		</div>
		<!--<div class="control-group">
			<label class="control-label" for="pictures-list">Pictures</label>
			<div class="controls">
				<select name="pictures-list" id="pictures-list" class="form-select">
			    	<option value="all">All pictures</option>
			    	<option value="all">Option 2</option>
			    	<option value="all">Option 3</option>
			    </select>
			</div>
		</div>-->
	</fieldset>
	<fieldset>
		<legend>Choose where do You want to share it:</legend>
		<ul class="social-registrator">
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?=urlencode(Yii::app()->getBaseUrl(true).'/userProfile/'.Yii::app()->user->id)?>" class="social-link facebook" id="share-facebook" target="_blank">
				<i></i>
				<span>Facebook</span>
			</a>
			<a href="https://twitter.com/intent/tweet?text=Check%20this%20profile&via=FirstPout&url=<?=urlencode(Yii::app()->getBaseUrl(true).'/userProfile/'.Yii::app()->user->id)?>" target="_blank" class="social-link twitter" id="share-twitter">
				<i></i>
				<span>Twitter</span>
			</a>
			<a href="https://plus.google.com/share?url=<?=urlencode(Yii::app()->getBaseUrl(true).'/userProfile/'.Yii::app()->user->id)?>&hl=en-US" class="social-link gplus" id="share-google" target="_blank">
				<i></i>
				<span>Google+</span>
			</a>
            <!--<a href="" class="social-link instagram" id="share-insta">
				<i></i>
				<span>Instagram</span>
			</a>
			<a href="#" class="social-link no-marge picassa">
				<i></i>
				<span>Picassa</span>
			</a>
			<a href="#" class="social-link flickr">
				<i></i>
				<span>Flickr</span>
			</a>-->
			<a href="http://www.pinterest.com/pin/create/button/?url=<?=urlencode(Yii::app()->getBaseUrl(true).'/userProfile/'.Yii::app()->user->id)?>&media=<?=urlencode($myimage)?>&description=<?=urlencode('Check this profile.')?>" class="social-link pinterest" target="_blank" id="share-pinterest">
				<i></i>
				<span>Pinterest</span>
			</a>
            <a href="https://api.addthis.com/oexchange/0.8/forward/email/offer?url=<?=urlencode(Yii::app()->getBaseUrl(true).'/userProfile/'.Yii::app()->user->id)?>&pubid=ra-51f9247d3cca3259&ct=1" class="social-link email" target="_blank" id="share-email">
				<i></i>
				<span>Email</span>
			</a>
		</ul>
	</fieldset>
	<fieldset class="pick-a-kid">
		<legend>Grab easy link to share profile with Your friends</legend>
		<div class="control-group">
			<label class="control-label" for="kids-list">Choose profile to share:</label>
			<div class="controls">
				<select name="kids-list" id="kids-list" class="form-select" onchange="ChangeClipLink(this.value)">
			    	<option value="<?=Yii::app()->getBaseUrl(true).'/userProfile/'.Yii::app()->user->id?>">My Profile</option>
                    <?php
                    if($profiles){
						foreach($profiles as $prof){
					?>	
                    		<option value="<?=Yii::app()->getBaseUrl(true).'/babyProfile/'.$prof->id?>"><?=$prof->username?></option>
                    <?php
						}
					}
					?>
			    </select>
			    <a href="#" class="btn btn-green">Copy to clipbord</a>
			    <small class="control-info" id="clip-link"><?=Yii::app()->getBaseUrl(true)?>/userProfile/<?=Yii::app()->user->id?></small>
			</div>
		</div>
	</fieldset>
	<!--<div class="additional-options">
		<div class="controls">
			<label class="checkbox">
				<input type="checkbox" name="my-photos" id="my-photos">
				<span>This photos are mine</span>
			</label>
			<label class="checkbox">
				<input type="checkbox" name="rules" id="rules">
				<span>I know rules...</span>
			</label>
		</div>
	</div>
	<div class="submit-btn-wrap">
		<button type="submit" class="btn btn-red btn-big-submit">Share</button>
	</div>-->
</form>
