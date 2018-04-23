<?php

class CroppicController extends Controller {

    public function init() {
        // set the default theme for any other controller that inherit the admin controller
        Yii::app()->theme = 'bootstrap';
    }

    public function actionSaveOriginalImage() {
        /*
         * 	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
         */
        if ($_REQUEST['imagePath'] == '') {
            $imagePath = Yii::app()->basePath . "/../media/croppic/flyingimg/";
            $imagePath2 = Yii::app()->request->baseUrl . "/media/croppic/flyingimg/";
        } else {
            $imagePath = Yii::app()->basePath . "/../" . $_REQUEST['imagePath'];
            $imagePath2 = Yii::app()->request->baseUrl . $_REQUEST['imagePath'];
        }

        $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
        $temp = explode(".", $_FILES["img"]["name"]);
        $extension = end($temp);

        if (in_array($extension, $allowedExts)) {
            if ($_FILES["img"]["error"] > 0) {
                $response = array(
                    "status" => 'error',
                    "message" => 'ERROR Return Code: ' . $_FILES["img"]["error"],
                );
                echo "Return Code: " . $_FILES["img"]["error"] . "<br>";
            } else {

                $filename = time().'-'.Yii::app()->user->id.'-'.$_FILES["img"]["name"];
                list($width, $height) = getimagesize($_FILES["img"]["tmp_name"]);

                move_uploaded_file($_FILES["img"]["tmp_name"], $imagePath . $filename);

                $response = array(
                    "status" => 'success',
                    "url" => $imagePath2 . $filename,
                    "width" => $width,
                    "height" => $height
                );
            }
        } else {
            $response = array(
                "status" => 'error',
                "message" => 'something went wrong',
            );
        }

        print json_encode($response);
    }

    public function actionSaveCroppedImage() {
        /*
         * 	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
         */

        if ($_REQUEST['output_filename'] == '') {
            $output_filename = "media/croppic/croppedimg/croppedImg_" . time();
        } else {
            $output_filename = $_REQUEST['output_filename'] . time();
        }
        $output_filename2 = Yii::app()->request->baseUrl . '/' . $output_filename;

        $imgUrl = Yii::app()->basePath.'/..'.str_replace(Yii::app()->request->baseUrl,'',$_POST['imgUrl']);
        $imgInitW = $_POST['imgInitW'];
        $imgInitH = $_POST['imgInitH'];
        $imgW = $_POST['imgW'];
        $imgH = $_POST['imgH'];
        $imgY1 = $_POST['imgY1'];
        $imgX1 = $_POST['imgX1'];
        $cropW = $_POST['cropW'];
        $cropH = $_POST['cropH'];

        $jpeg_quality = 100;

        $what = getimagesize($imgUrl);
        
        switch (strtolower($what['mime'])) {
            case 'image/png':
                $img_r = imagecreatefrompng($imgUrl);
                $source_image = imagecreatefrompng($imgUrl);
                $type = '.png';
                break;
            case 'image/jpeg':
                $img_r = imagecreatefromjpeg($imgUrl);
                $source_image = imagecreatefromjpeg($imgUrl);
                $type = '.jpeg';
                break;
            case 'image/gif':
                $img_r = imagecreatefromgif($imgUrl);
                $source_image = imagecreatefromgif($imgUrl);
                $type = '.gif';
                break;
            default: die('image type not supported');
        }

        $resizedImage = imagecreatetruecolor($imgW, $imgH);
        imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);


        $dest_image = imagecreatetruecolor($cropW, $cropH);
        imagecopyresampled($dest_image, $resizedImage, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);


        imagejpeg($dest_image, $output_filename . $type, $jpeg_quality);

        $response = array(
            "status" => 'success',
            "url" => $output_filename2 . $type
        );
        print json_encode($response);
    }

}

?>