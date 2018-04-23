<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => true,
    'type' => 'horizontal',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));

if($status)
{
    echo '<div class="alert alert-info">'.$status.'</div>';
}

if($close==0)
{
    echo "<br><br>";
    echo $form->passwordFieldRow($model, 'password', array('class' => 'span10', 'maxlength' => 90));
    echo '<div class="clear"></div>'.$form->passwordFieldRow($model, 'password_repeat', array('class' => 'span10', 'maxlength' => 90)); 

    echo '<div class="clear form-actions">';
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    echo '</div>';
}
else
{
    ?>
    <br><br><br>
    <div class="text-center" id="close_window">This window will be closed within 5 seconds.</div>
    <script>
        $(document).ready(function(){
           var sec=4;
           setInterval(function(){
               $('#close_window').html("This window will be closed within "+sec+" seconds.");
               if(sec==0)
               {
                    parent.jQuery.fancybox.close();
               }
               sec--;
           },1000);
           
        });
    </script>
    <?php
}

$this->endWidget(); 

?>