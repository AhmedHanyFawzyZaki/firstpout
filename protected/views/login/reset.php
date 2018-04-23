<main id="main" class="container">
    <?php
    if (Yii::app()->user->hasFlash("wrong_pass")) {
        echo '<div class="alert alert-danger">' . Yii::app()->user->getFlash("wrong_pass") . '</div>';
    }
    ?>
    <div class="hp-row">
        <article class="fp-overview">
            <h1>Forgot password?</h1>
            <h2>Change your password in 2 steps!</h2>
            <h3>Login with:</h3>
            <ul class="social-registrator">
                <a href="<?= Yii::app()->request->baseUrl ?>/login/facebook" class="social-link facebook">
                    <i></i>
                    <span>Facebook</span>
                </a>
                <a href="<?= Yii::app()->request->baseUrl ?>/login/twitter" class="social-link twitter">
                    <i></i>
                    <span>Twitter</span>
                </a>
                <a href="<?= Yii::app()->request->baseUrl ?>/login/google" class="social-link gplus">
                    <i></i>
                    <span>Google+</span>
                </a>
            </ul>
        </article>
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'user-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
            'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'registration-form form-wrap', 'style' => 'width:495px;margin-top:90px;'),
        ));
        ?>
        <h3>Change your password</h3>
        <div class="control-group">
            <?= $form->labelEx($user, 'pass_token', array('class' => 'control-label', 'style' => 'text-align:left; width:80px;')) ?>
            <div class="controls">
                <?php echo $form->textField($user, 'pass_token', array('class' => 'input-xlarge width415', 'placeholder' => 'code', 'disabled'=>'disabled')); ?>
            </div>
        </div>
        <div class="control-group">
            <?= $form->labelEx($user, 'password', array('class' => 'control-label', 'style' => 'text-align:left; width:80px;')) ?>
            <div class="controls">
                <?php echo $form->passwordField($user, 'password', array('class' => 'input-xlarge width415', 'placeholder' => 'password')); ?>
            </div>
        </div>
        <div class="control-group">
            <?= $form->labelEx($user, 'password_repeat', array('class' => 'control-label', 'style' => 'text-align:left; width:80px;line-height:15px;')) ?>
            <div class="controls">
                <?php echo $form->passwordField($user, 'password_repeat', array('class' => 'input-xlarge width415', 'placeholder' => 'Repeat password')); ?>
            </div>
        </div>
        <br><br>
        
        <div class="submit-btn-wrap">
            <button type="submit" class="btn btn-red btn-submit pull-right">Change</button>
        </div>
        <?php $this->endWidget(); ?>
        <!-- /.registration-wrap -->
    </div>
</main>
<!-- /#main -->