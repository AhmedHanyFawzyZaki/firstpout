<?php
/* $user=User::model()->findByPk(3);
$email = $user->email;
$pass = User::simple_decrypt($user->password);
$id = $user->id;       
echo  $md5 = md5("$id-$email-$pass") ; */
?>

<form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/api/<?= $_GET['action'] ?>">

<textarea cols="30" rows="10" name="data" class="test"></textarea>
<input type="submit" value="Go" />
     </form>