<script>
	function send(){
		var form=$("#doctor-form").serialize();
		$.ajax({
			url:"<?=Yii::app()->request->baseUrl?>/controlPanel/changePassword",
			data:form,
			type: 'POST',
			dataType:'html',
			success: function(data){
				alert(data);
				$.fancybox.close();
			}
		});
	}
</script>
<div class="page-wrap">
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
        <h1>Change Password?</h1>

        <fieldset>
            <?php echo $form->passwordFieldRow($model, 'old_password', array('class' => 'input-xmedium', 'required'=>'required', 'placeholder' => 'Old Password')); ?>
            <?php 
			$model->password='';
			echo $form->passwordFieldRow($model, 'password', array('class' => 'input-xmedium', 'required'=>'required', 'placeholder' => 'New Password')); 
			?>
            <?php echo $form->passwordFieldRow($model, 'password_repeat', array('class' => 'input-xmedium', 'required'=>'required', 'placeholder' => 'Repeat Password')); ?>
            
		</fieldset>
        <div class="pull-right">
            <button type="submit" class="btn btn-green btn-submit">Change Password</button>
        </div>
        <?php $this->endWidget(); ?>
     </section>
</div>