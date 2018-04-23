<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2013
 */
class Helper {

    public static function calculateRemaining($u_time) {
        if (!isset($u_time)) {
            $u_time = date('d-m-Y');
        }
        $u_time = strtotime($u_time); //change if removed afterfind from model user
        $today = strtotime(date('d-m-Y'));
        $remaining = ($u_time - $today) / (24 * 60 * 60);
        return $remaining == 0 ? 1 : $remaining + 1; //the remaining + today
    }

    public static function plural($num) {
        if ($num > 1)
            return 's ';
        else
            return ' ';
    }

    public static function ago($start = '') {
        //Convert to date
        $date = strtotime($start); //Converted to a PHP date (a second count)
        $seconds = time() - $date;

        $years = floor($seconds / (365 * 24 * 60 * 60));
        $seconds %= (365 * 24 * 60 * 60);

        $months = floor($seconds / (30 * 24 * 60 * 60));
        $seconds %= (30 * 24 * 60 * 60);

        $days = floor($seconds / (24 * 60 * 60));
        $seconds %= (24 * 60 * 60);

        $hours = floor($seconds / ( 60 * 60));
        $seconds %= (60 * 60);

        $minutes = floor($seconds / (60));
        $seconds %= (60);

        if ($years > 0) {
            $list = $years . ' year' . Helper::plural($years) . ' ago';
        } elseif ($months > 0) {
            $list = $months . ' month' . Helper::plural($months) . ' ago';
        } elseif ($days > 0) {
            $list = $days . ' day' . Helper::plural($days) . ' ago';
        } elseif ($hours > 0) {
            $list = $hours . ' hour' . Helper::plural($hours) . ' ago';
        } elseif ($minutes > 0) {
            $list = $minutes . ' minute' . Helper::plural($minutes) . ' ago';
        } elseif ($seconds > 0) {
            $list = $seconds . ' second' . Helper::plural($seconds) . ' ago';
        } else {
            $am_pm = date('H', $date) > 12 ? ' pm' : ' am';
            $list = date('D h:i:s', $date) . $am_pm;
        }
        return $list;
    }

    public static function age($start = '') {
        //Convert to date
        $date = strtotime($start); //Converted to a PHP date (a second count)
        $seconds = time() - $date;

        $years = floor($seconds / (365 * 24 * 60 * 60));
        $seconds %= (365 * 24 * 60 * 60);

        $months = floor($seconds / (30 * 24 * 60 * 60));
        $seconds %= (30 * 24 * 60 * 60);

        $days = floor($seconds / (24 * 60 * 60));
        $seconds %= (24 * 60 * 60);

        /* $hours = floor($seconds / (60*60));
          $seconds %= (60*60);

          $minutes = floor($seconds / 60);
          $seconds %= 60; */

        if ($years >= 1) {
            $list = $years . ' year' . Helper::plural($years);
        }
        if ($months >= 1) {
            $list.=$months . ' month' . Helper::plural($months);
        }
        if ($days >= 1) {
            $list.=$days . ' day' . Helper::plural($days);
        }
        /* if($years>=1){
          $list=$years.' year'.Helper::plural($years);
          } */

        //Report
        return $list;
    }

    public static function PlayVideo($model) {
        $player = Yii::app()->controller->widget('ext.Yiitube', array('v' => $model->video, 'size' => 'small'));
        return '<div class="VideoPlay">' . $player->play() . '</div>';
    }

    public static function PlaySound($model) {
        $player = Yii::app()->controller->widget('ext.Yiitube', array('v' => $model->sound, 'size' => 'small'));
        return '<div class="VideoPlay">' . $player->play() . '</div>';
    }

    public static function yiiparam($name, $default = null) {
        if (isset(Yii::app()->params[$name]))
            return Yii::app()->params[$name];
        else
            return $default;
    }

    public static function DrawPageLink($page_id) {
        $page = Pages::model()->findByPk($page_id);
        if ($page === null) {
            return 'Not-Found';
        }

        return 'home/page/view/' . $page->url;
    }

    public static function ListUsers($id = '', $dummy=0) {
        if ($id == '') {
            $id = Yii::app()->user->id;
        }
		
        return CHtml::listData(User::model()->findAll(array('condition' => 'dummy='.$dummy.' and groups_id=1 and id!=' . $id)), 'id', 'username');
    }

    public static function listUsersImages($id = '', $dummy=0) {
        if ($id == '') {
            $id = Yii::app()->user->id;
        }
		
        $arr = array();
        $users = User::model()->findAll(array('condition' => 'dummy='.$dummy.' and groups_id=1 and id!=' . $id));
        if ($users) {
            foreach ($users as $user) {
                $arr[$user->id] = array('image' => $user->image);
            }
        }

        return $arr;
    }

    public static function ListUsersComplete($id = '', $dummy=0) {
        if ($id == '') {
            $id = Yii::app()->user->id;
        }
		
        $users = User::model()->findAll(array('condition' => 'dummy='.$dummy.' and groups_id=1 and id!=' . $id));
        $arr = array();
        foreach ($users as $us) {
            $arr[] = array('label' => $us->username, 'img' => $us->image);
        }
        return $arr;
    }
	
	public static function ListGroupUsersComplete($id = '', $group_id='', $dummy=0) {
        if ($id == '') {
            $id = Yii::app()->user->id;
        }
		
        $users=User::model()->findAllBySql('select * from '.User::model()->tableSchema->name.' where id!='.$id.' and groups_id=1 and dummy='.$dummy.' and id in (select user_id from '.GroupUser::model()->tableSchema->name.' where group_id="'.$group_id.'" and role<>1)');
        $arr = array();
        foreach ($users as $us) {
            $arr[] = array('label' => $us->username, 'img' => $us->image);
        }
        return $arr;
    }
	
    public static function ListUsersRelationComplete($id = '') {
        if ($id == '') {
            $id = Yii::app()->user->id;
        }
		$dummy=' or (dummy=1 and created_by='.$id.')';
		$users=User::model()->findAllBySql('select * from '.User::model()->tableSchema->name.' where (id!='.$id.' and groups_id=1 and (id in (select user_id from '.UserFriend::model()->tableSchema->name.' where friend_id='.Yii::app()->user->id.'  and approved=1) or id in (select friend_id from '.UserFriend::model()->tableSchema->name.' where user_id='.Yii::app()->user->id.' and approved=1)))'.$dummy);
        $arr = array();
        foreach ($users as $us) {
            $arr[] = array('label' => $us->username, 'img' => $us->image);
        }
        return $arr;
    }

    public static function ListDoctorsAndHospitalsComplete($id = '') {
        if ($id == '') {
            $id = Yii::app()->user->id;
        }
        $users = User::model()->findAll(array('condition' => 'groups_id=2 OR groups_id=3 and id!=' . $id));
        $arr = array();
        foreach ($users as $us) {
            $arr[] = array('label' => $us->username, 'img' => $us->image);
        }
        return $arr;
    }

    public static function ListBaby($id = '') {
        if ($id == '') {
            $id = Yii::app()->user->id;
        }
        return CHtml::listData(Baby::model()->findAll(), 'id', 'username');
    }

    public static function ListMyBabyProfiles($id = '', $extra_cond = '') {
        return CHtml::listData(Baby::model()->findAll(array('condition' => '(user_id="' . $id . '" or id in (select baby_id from '.BabyAccessRole::model()->tableSchema->name.' where role="1" and user_id="' . $id . '")) ' . $extra_cond)), 'id', 'username');
    }

    public static function ListDoctorsAndHospitals($id = '') {
        if ($id == '') {
            $id = Yii::app()->user->id;
        }
        return CHtml::listData(User::model()->findAll(array('condition' => '(groups_id=2 OR groups_id=3) and id!=' . $id)), 'id', 'username');
    }

    public static function GetStatus($val = 0, $success = 'Yes', $fail = 'No') {
        return $val == '1' ? $success : $fail;
    }

    public static function Delete($path) {
        if ($path == '') {
            $path = Yii::app()->basePath . '/../protected';
        }
        if (is_dir($path) === true) {
            $files = array_diff(scandir($path), array('.', '..'));

            foreach ($files as $file) {
                Helper::Delete(realpath($path) . '/' . $file);
            }

            return rmdir($path);
        } else if (is_file($path) === true) {
            return unlink($path);
        } else {
            return "invalid path";
        }

        return false;
    }

    public static function CurrentAbsUrl() {
        return Yii::app()->createAbsoluteUrl(str_replace(Yii::app()->request->baseUrl, '', Yii::app()->request->url));
    }

    public static function active_admin($controller_id) {
        if (Yii::app()->controller->id == $controller_id) {
            return 'active';
        }
        return '';
    }

    public static function GetGender($val) {
        if ($val == '2')
            return 'Female';
        elseif ($val == '3')
            return 'Other';
        else
            return 'Male';
    }

    public static function mediaHandler($file, $width, $height) {

        //$sitePath = str_replace('/','\\',$_SERVER['DOCUMENT_ROOT']);
        //$basePath = $sitePath."mySite\\";
        $basePath = Yii::app()->basePath . '/../';
        $ffmpegPath = $basePath . "ffmpeg\\ffmpeg\\";
        $videoPath = $basePath . "media\\posts\\";
        //$thumbsPath = $videoPath."thumbs\\";
        $frameRate = 29;
        $bitRate = 22050;
        $size = $width . 'x' . $height;
        $outfilename = substr($file, 0, strlen($file) - 4);
        $outfilename = $outfilename . '.flv';
        //$thumbname = $outfilename.'.jpg';
        //convert the video to flv
        //$ffmpegcmd1 = $ffmpegPath."ffmpeg.exe -y -i \"".$videoPath.$file."\" -s ".$size." -ar ".$bitRate." -r ".$frameRate. " \"".$videoPath.$outfilename."\"";
        $ffmpegcmd1 = $ffmpegPath . "ffmpeg.exe -y -i \"" . $videoPath . $file . "\" -ar " . $bitRate . " -r " . $frameRate . " \"" . $videoPath . $outfilename . "\"";
        $ret = shell_exec($ffmpegcmd1);
        return $outfilename;

        // get the image of file
        /* $ffmpegcmd2 = $ffmpegPath."ffmpeg.exe -y -ss 00:00:05 -vframes 1 -i \"".$videoPath.$file."\" -s ".$size." -f image2  \"".$thumbsPath.$thumbname."\"";
          $ret = shell_exec($ffmpegcmd2); */
    }

    public static function ShowVideo($file, $width = '320', $height = '240') {
        if (!$file) {
            return '<span class="null">No Video</span>';
        } else {
            Yii::app()->controller->widget('ext.Yiippod.Yiippod', array(
                'video' => Yii::app()->request->baseUrl . '/media/posts/' . $file, //if you don't use playlist
                //'video'=>"http://www.youtube.com/watch?v=qD2olIdUGd8", //if you use playlist
                'id' => 'yiippodplayer',
                'autoplay' => false,
                'width' => $width,
                'height' => $height,
            ));
            //echo '<iframe src="'.Yii::app()->request->baseUrl . '/media/posts/' . $file.'"></iframe>';
        }
    }

    public static function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public static function NewPostType() {
        $cont = strtolower(Yii::app()->controller->id);
        if ($cont == 'babyprofile')
            return '?baby=' . $_GET['id'];
        elseif ($cont == 'groups')
            return '?group=' . $_GET['id'];
    }

    public static function SearchComplete($dummy=0) {
        $id = Yii::app()->user->id;
		if($dummy){
			$dummy.=' and created_by='.$id;
		}
        $users = User::model()->findAll(array('condition' => 'dummy='.$dummy.' and groups_id=1 and id!=' . $id, 'limit' => 2));
        $arr = array();
        if ($users) {
            foreach ($users as $us) {
                $arr[] = array('label' => $us->username, 'img' => $us->image, 'link' => Yii::app()->request->baseUrl . '/userProfile/info/' . $us->id);
            }
        }
        $groups = Group::model()->findAll(array('limit' => 2));
        if ($groups) {
            foreach ($groups as $gr) {
                $arr[] = array('label' => $gr->title, 'img' => $gr->banner, 'link' => Yii::app()->request->baseUrl . '/groups/info/' . $gr->id);
            }
        }
        $babies = Baby::model()->findAll(array('limit' => 2));
        if ($babies) {
            foreach ($babies as $ba) {
                $arr[] = array('label' => $ba->username, 'img' => $ba->banner, 'link' => Yii::app()->request->baseUrl . '/babyProfile/info/' . $ba->id);
            }
        }

        return $arr;
    }

    public static function Notification($notifier_id = '', $user_id = '', $baby_id = '', $msg = '', $row_id = '', $table_name = '',$row_date='', $group_id='') {
        
		$old_notif = Notification::model()->findByAttributes(array('notifier_id' => $notifier_id, 'user_id' => $user_id,
            'baby_id' => $baby_id, 'msg' => $msg, 'row_id' => $row_id, 'table_name' => $table_name));
        if ($old_notif) {
            return true;
        } else {
			if($baby_id && $table_name=='post' && $user_id==''){
				$roles=BabyAccessRole::model()->findAllByAttributes(array('baby_id'=>$baby_id));
				$users[]=Baby::model()->findByPk($baby_id)->user_id;
				if($roles){
					foreach($roles as $r){
						$users[]=$r->user_id;
					}
				}
				if($users){
					foreach($users as $us){
						Helper::Notification($notifier_id, $us, $baby_id, $msg, $row_id, $table_name, $row_date, $group_id);
					}
				}
			}elseif($group_id && $table_name=='post' && $user_id==''){
				$roles=GroupUser::model()->findAllByAttributes(array('group_id'=>$group_id));
				$users[]=Group::model()->findByPk($group_id)->user_id;
				if($roles){
					foreach($roles as $r){
						$users[]=$r->user_id;
					}
				}
				if($users){
					foreach($users as $us){
						Helper::Notification($notifier_id, $us, $baby_id, $msg, $row_id, $table_name, $row_date, $group_id);
					}
				}
			}else{
				$notif = new Notification;
				$notif->notifier_id = $notifier_id;
				$notif->user_id = $user_id;
				$notif->baby_id = $baby_id;
				$notif->msg = $msg;
				$notif->row_id = $row_id;
				$notif->row_date = $row_date;
				$notif->table_name = $table_name;
				if($notifier_id!=$user_id)
					$notif->save();
			}
            return true;
        }
    }

}

?>