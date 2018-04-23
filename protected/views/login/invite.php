<main id="main" class="container">
    <div class="page-overview">
        <h1>Send invitations to Your friends!</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque viverra purus in <br />velit ullamcorper euismod. Nunc eget tellus urna. </p>
    </div>
    <div class="hp-row">
        <article class="send-invitations">
            <h3>Send invitations</h3>
            <ul class="social-registrator">
                <a href="javascript:void(0)" id="invite_facebook" style="margin-left: 8px;" class="social-link facebook medium-social active">
                    <i></i>
                    <span>Facebook</span>
                </a>
                <a href="javascript:void(0)" id="invite_twitter" class="social-link twitter medium-social">
                    <i></i>
                    <span>Twitter</span>
                </a>
                <a href="javascript:void(0)" id="invite_plus" class="social-link gplus medium-social">
                    <i></i>
                    <span>Google+</span>
                </a>
                <a href="javascript:void(0)" id="invite_email" class="social-link email medium-social">
                    <i></i>
                    <span>Email</span>
                </a>
                <!--<a href="#" class="social-link instagram small-social">
                    <i></i>
                    <span>Instagram</span>
                </a>
                <a href="#" class="social-link no-marge picassa small-social">
                    <i></i>
                    <span>Picassa</span>
                </a>
                <a href="#" class="social-link flickr small-social">
                    <i></i>
                    <span>Flickr</span>
                </a>
                <a href="#" class="social-link pinterest small-social">
                    <i></i>
                    <span>Pinterest</span>
                </a>-->
            </ul>
        </article>
        <div class="invitation-form form-wrap" id="div_face">
            <div class="control-group">
              <div class="controls">
                <input id="fb-title" name="fb-title" type="text" placeholder="Enter title" class="input-xlarge">
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <textarea id="fb-msg" name="fb-msg" placeholder="Enter message" class="textarea-xlarge">Check out this application!</textarea>
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <label class="checkbox">
                    <input type="checkbox" name="gender" id="gender" />
                    <span>Send me confirmation of receipt</span>
                </label>
                <button id="facebook-submit" type="button" class="btn btn-blue-dark btn-submit">Send it</button>
              </div>
            </div>
            <div class="submit-btn-wrap">
                <a href="<?=Yii::app()->request->baseUrl?>/login/profileInfo"><button type="button" type="submit" class="btn btn-green btn-big-submit">Save</button></a>
                <a href="<?=Yii::app()->request->baseUrl?>/login/profileInfo" class="btn btn-transparent btn-big-submit">Skip</a>
            </div>
        </div>
        <div class="invitation-form form-wrap" id="div_twitter" style="display: none;">
            <div class="control-group">
              <div class="controls">
                <input id="tw-account" type="text" placeholder="Relate account?" class="input-xlarge">
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <textarea id="tw-msg" placeholder="Enter message" class="textarea-xlarge">Check out this application!</textarea>
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <label class="checkbox">
                    <input type="checkbox" name="gender" id="gender" />
                    <span>Send me confirmation of receipt</span>
                </label>
                <a href="javascript:void(0)" id="tw-submit" onclick="shareTwitter()" type="button" ><button class="btn btn-blue-dark btn-submit social-btn">Send it</button></a>
              </div>
            </div>
            <div class="submit-btn-wrap">
                <a href="<?=Yii::app()->request->baseUrl?>/login/profileInfo"><button type="button" type="submit" class="btn btn-green btn-big-submit">Save</button></a>
                <a href="<?=Yii::app()->request->baseUrl?>/login/profileInfo" class="btn btn-transparent btn-big-submit">Skip</a>
            </div>
        </div>
        <div class="invitation-form form-wrap" id="div_google" style="display: none;">
            <div class="control-group">
              <div class="controls">
                <input id="gp-account" type="text" placeholder="Enter account" class="input-xlarge">
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <textarea id="gp-msg" placeholder="Enter message" class="textarea-xlarge">Check out this application!</textarea>
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <label class="checkbox">
                    <input type="checkbox" name="gender" id="gender" />
                    <span>Send me confirmation of receipt</span>
                </label>
                
                <button
  class="g-interactivepost btn btn-blue-dark btn-submit social-btn"
  data-contenturl="<?=Yii::app()->request->getBaseUrl(true)?>"
  data-contentdeeplinkid="<?=Yii::app()->request->getBaseUrl(true)?>"
  data-clientid="549620825954-gdumfg3tc548ejo8fet7l6jfndn8m0m1.apps.googleusercontent.com"
  data-cookiepolicy="single_host_origin"
  data-prefilltext="Check out this application."
  data-calltoactionlabel="INVITE"
  data-calltoactionurl="<?=Yii::app()->request->getBaseUrl(true)?>"
  data-calltoactiondeeplinkid="<?=Yii::app()->request->getBaseUrl(true)?>" type="button">
  Send it</button>

              </div>
            </div>
            <div class="submit-btn-wrap">
                <a href="<?=Yii::app()->request->baseUrl?>/login/profileInfo"><button type="button" type="submit" class="btn btn-green btn-big-submit">Save</button></a>
                <a href="<?=Yii::app()->request->baseUrl?>/login/profileInfo" class="btn btn-transparent btn-big-submit">Skip</a>
            </div>
        </div>
        <div class="invitation-form form-wrap" id="div_email" style="display: none;">
        	<div class="control-group">
              <div class="controls">
                <input id="email-account" name="emails" type="text" placeholder="Your Email" class="input-xlarge">
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <textarea id="email-msg" name="msg" placeholder="Enter message" class="textarea-xlarge">Check out this application!</textarea>
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <label class="checkbox">
                    <input type="checkbox" name="gender" id="gender" />
                    <span>Send me confirmation of receipt</span>
                </label>
                <!-- Go to www.addthis.com/dashboard to generate a new set of sharing buttons -->
				<a href="javascript:void(0)" onclick="email()" class="btn btn-blue-dark btn-submit social-btn">Send it</a>
              </div>
            </div>
            <div class="submit-btn-wrap">
                <a href="<?=Yii::app()->request->baseUrl?>/login/profileInfo"><button type="button" type="submit" class="btn btn-green btn-big-submit">Save</button></a>
                <a href="<?=Yii::app()->request->baseUrl?>/login/profileInfo" class="btn btn-transparent btn-big-submit">Skip</a>
            </div>
        </div>
        <!-- /.form-wrap -->
        <div class="fp-steps">
            <a href="javascript:void(0)" class="fp-step current">Step 1</a>
            <a href="javascript:void(0)" class="fp-step">Step 2</a>
            <a href="javascript:void(0)" class="fp-step">Step 3</a>
        </div>
    </div>
</main>
<!-- /#main -->

<script>
  $(document).ready(function(){
      $('#invite_facebook').click(function(){
          $('#div_face').css('display','block');
          $('#div_twitter').css('display','none');
          $('#div_google').css('display','none');
          $('#div_email').css('display','none');          
          
          $('#invite_facebook').addClass('active');
          $('#invite_twitter').removeClass('active');
          $('#invite_plus').removeClass('active');
          $('#invite_email').removeClass('active');
      });
      $('#invite_twitter').click(function(){
          $('#div_face').css('display','none');
          $('#div_twitter').css('display','block');
          $('#div_google').css('display','none');
          $('#div_email').css('display','none');
          
          $('#invite_facebook').removeClass('active');
          $('#invite_twitter').addClass('active');
          $('#invite_plus').removeClass('active');
          $('#invite_email').removeClass('active');
      });
      $('#invite_plus').click(function(){
          $('#div_face').css('display','none');
          $('#div_twitter').css('display','none');
          $('#div_google').css('display','block');
          $('#div_email').css('display','none');
          
          $('#invite_facebook').removeClass('active');
          $('#invite_twitter').removeClass('active');
          $('#invite_plus').addClass('active');
          $('#invite_email').removeClass('active');
      });
      $('#invite_email').click(function(){
          $('#div_face').css('display','none');
          $('#div_twitter').css('display','none');
          $('#div_google').css('display','none');
          $('#div_email').css('display','block');
          $('#invite_facebook').removeClass('active');
          $('#invite_twitter').removeClass('active');
          $('#invite_plus').removeClass('active');
          $('#invite_email').addClass('active');
      });
  });
    
  window.fbAsyncInit = function() {
    FB.init({
      appId: '731218783581076',
      status: true,
      cookie: true,
      oauth: true,
  	  xfbml:true
    });
  };

  $('#facebook-submit').click(sendRequest);
  function sendRequest() {
    FB.ui({
      method: 'apprequests',
      message: $('#fb-msg').val(),
      title: $('#fb-title').val(),
    });
    /*function (response) {
      if (response.request && response.to) {
        var request_ids = [];
        for(i=0; i<response.to.length; i++) {
          var temp = response.request + '_' + response.to[i];
          request_ids.push(temp);
        }
        var requests = request_ids.join(',');
		<?php
			//$user= Yii::app()->facebook->api('/me');
		?>
          //$.post('handle_requests.php',{uid: '<?php echo $user['id']; ?>', request_ids: requests},function(resp) {
          // callback after storing the requests
        });
      } else {
        //request cancelled
      }
    });*/
    return false;
  }

  // Load the SDK Asynchronously
  (function(d){
    var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id; js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    d.getElementsByTagName('head')[0].appendChild(js);
  }(document));
</script>

<script type="text/javascript">
  (function() {
   var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
   po.src = 'https://apis.google.com/js/client:plusone.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
 })();
</script>

<script>
function email(){
	var emailText=$('#email-msg').val();
	var emailAccount=$('#email-account').val();
	var emailLink='https://api.addthis.com/oexchange/0.8/forward/email/offer?url=<?=Yii::app()->request->getBaseUrl(true)?>&pubid=ra-51f9247d3cca3259&ct=1&title='+emailText+'&pco=tbxnj-1.0&from='+emailAccount;
	window.open(emailLink,'_blank');
}
</script>

<script>
function shareTwitter(){
	var twText=$('#tw-msg').val();
	var twAccount=$('#tw-account').val();
	var twLink='https://twitter.com/intent/tweet?original_referer=<?=Yii::app()->request->getBaseUrl(true)?>&related='+twAccount+'&text='+twText+'&url=<?=Yii::app()->request->getBaseUrl(true)?>&via=<?=Yii::app()->name?>';
	window.open(twLink,'_blank');
}
</script>