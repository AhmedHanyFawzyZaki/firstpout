
		<main id="main" class="container">
			<div class="page-overview">
				<h1>Send invitations to Your friends!</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque viverra purus in <br />velit ullamcorper euismod. Nunc eget tellus urna. </p>
			</div>
			<div class="hp-row">
				<?php
				$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
					'id' => 'user-form',
					'enableAjaxValidation' => false,
					//'type' => 'horizontal',
					'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'invitation-form app-form form-wrap'),
				));
				?>
					<div class="app-fields-wrap">
						<div class="control-group">
							<label for="phone-number" class="control-label">Your mobile number</label>
							<div class="controls">
								<?php echo $form->textField($model, 'phone', array('placeholder' => 'Enter Your mobile number')); ?>
							</div>
						</div>
						<div class="submit-btn-wrap">
							<button class="btn" type="submit">Send it</button>
						</div>

						<div class="app-overview">
							<h2>Download first pout app</h2>
							<ul class="apps-list">
								<li>
									<h3>Google Play</h3>
									<a href="<?=Yii::app()->params['android_app_link']?>" target="_blank" class="store-logo">
										<img src="<?=Yii::app()->request->baseUrl?>/img/common/google-play.png" alt="" />
									</a>
									<a href="<?=Yii::app()->params['android_app_link']?>" target="_blank" class="store-link">Download</a>
								</li>
								<li>
									<h3>App store</h3>
									<a href="<?=Yii::app()->params['ios_app_link']?>" target="_blank" class="store-logo">
										<img src="<?=Yii::app()->request->baseUrl?>/img/common/app-store.png" alt="" />
									</a>
									<a href="<?=Yii::app()->params['ios_app_link']?>" target="_blank" class="store-link">Download</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="submit-btn-wrap">
						<button type="submit" type="submit" class="btn btn-green btn-big-submit">Save</button>
						<a href="<?=Yii::app()->request->baseUrl?>/login/completeProfile?skip=1" class="btn btn-transparent btn-big-submit">Skip</a>
					</div>
				<?php $this->endWidget(); ?>
				<!-- /.form-wrap -->
				<div class="fp-steps">
					<a href="javascript:void(0)" class="fp-step">Step 1</a>
					<a href="javascript:void(0)" class="fp-step">Step 2</a>
					<a href="javascript:void(0)" class="fp-step current">Step 3</a>
				</div>
			</div>
		</main>