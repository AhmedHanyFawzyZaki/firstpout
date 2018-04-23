<aside class="sidebar-alt">
    <div class="page-actions">
        <form action="<?= Yii::app()->request->baseUrl ?>/home/search" class="search-form" method="post">
            <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name' => 's',
                'source' => Helper::SearchComplete(), //Helper::ListUsers(),
                'value' => isset($_REQUEST['s']) ? $_REQUEST['s'] : '',
                // additional javascript options for the autocomplete plugin
                'options' => array(
                //'minLength'=>'2',
                ),
                'htmlOptions' => array(
                    'class' => 'search-input',
                    'placeholder' => 'SEARCH',
                    'id' => 'autoSearch',
                ),
            ));
            Yii::app()->clientScript->registerScript("autoSearch", "
				$('#autoSearch').autocomplete().data( 'autocomplete' )._renderItem = function( ul, item ) {
						return $('<li></li>')
							.data('item.autocomplete', item)
							.append('<a class=\"autoCa\" href=\"'+item.link+'\"><img class=\"autoCimg\" src=\"' + item.img + '\" /><label class=\"autoClabel\">' + '\t'+  item.label +'</label></a>')
							.appendTo(ul);
					};
			");
            ?>
            <button class="search-submit" type="submit">Search</button>
        </form> 
    </div>
    <!-- /.page-actions -->
    <div class="sidebar-col">
        <div class="widget notifications-widget">
            <h3 class="widget-title">Notifications</h3>
            <ul class="feeds-list" id="notif-ul">
                <?php
                $notifs = Notification::model()->findAll(array('condition' => 'row_date >= Now() and (table_name="vaccine" or table_name="appointment" or table_name="visit") and baby_id in (select id from '.Baby::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '" or id in (select baby_id from '.BabyAccessRole::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '"))', 'limit' => '6', 'order' => 'id desc'));
                if ($notifs) {
                    foreach ($notifs as $not) {
                        if ($not->table_name == 'vaccine') {
                            $class = 'has-vaccine';
                        } elseif ($not->table_name == 'appointment') {
                            $class = 'has-appoinment';
                        } elseif ($not->table_name == 'visit') {
                            $class = 'has-appoinment';
                        }
                        echo '<li class="' . $class . '">' . $not->msg . '</li>';
                    }
                } else {
                    echo '<li class="has-photo">No notifications found.</li>';
                }
                ?>
            </ul>
        </div>
        <!-- /.widget -->
        <?php
        $ads = Ads::model()->findAll(array('order' => 'rand()', 'limit' => 4));
        if ($ads) {
            ?>
            <div class="widget adverts-widget">
                <h3 class="widget-title">Adverts</h3>
                <ul class="feeds-list">
                    <?php
                    foreach ($ads as $ad) {
                        ?>
                        <li>
                            <a href="<?= $ad->url ?>" target="_blank" class="advert-thumb">
                                <img src="<?= Yii::app()->request->baseUrl ?>/media/ads/<?= $ad->image ?>" alt="<?= $ad->title ?>" width="60" height="60" />
                            </a>
                            <div class="advert-overview">
                                <h4 class="advert-title">
                                    <a href="<?= $ad->url ?>" target="_blank"><?= $ad->title ?></a>
                                </h4>
                                <p class="advert-details">
                                    <?= $ad->content ?>
                                </p>
                            </div>
                            <a class="advert-link" href="<?= $ad->url ?>" target="_blank">check it</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
        }
        ?>
        <!-- /.widget -->
        <p class="fp-copyrights">Polski · Prywatność · Regulamin · Pliki cookie · Reklama · Więcej<br />First Pout © 2014</p>
    </div>
    <!-- /.sidebar-col -->
    <div class="contacts-list">
        <script>
            $(document).ready(function() {
                //get to the end of each chat box
                var objDiv = $('.conversation-wrap');
                objDiv.each(function(index, element) {
                    element.scrollTop = element.scrollHeight;
                });
                setInterval(function() {
                    $.ajax({
                        'url': "<?= Yii::app()->request->baseUrl ?>/home/ChatList",
                        'success': function(data) {
                            $('#filter-src-chat').html(data);
                            //$.getScript("<?= Yii::app()->request->baseUrl ?>/js/new.js");
                        }
                    });
                    CheckChatBoxes();
                }, 5000);//every 5sec
            });
            function CheckChatBoxes() {
                $.ajax({
                    'url': "<?= Yii::app()->request->baseUrl ?>/home/ChatWindows",
                    'success': function(data) {
                        var arr = jQuery.parseJSON(data);
                        $('.replace-chat-div').each(function(i, el) {
                            var convID = el.id;
                            var divID = convID.split('replace-chat-userid-');
                            var userID = divID['1'];
                            $('#' + convID).html(arr[userID]['items']);
                            if (arr[userID]['open'] == '1') {
                                $('#chat-userid-' + userID).css('display', 'block');
                            }
                        });
                        //$('#conversations').html(data);
                        $.getScript("<?= Yii::app()->request->baseUrl ?>/js/new.js");
                    }
                });
            }
        </script>
        <a href="javascript:void(0);" onclick="$('.chat-settings').toggle();" class="contacts-list-trigger"><i></i>Contact list</a>
        <div class="chat-settings">
            <?php
            $cu_status = User::model()->findByPk(Yii::app()->user->id)->chat_status;
            ?>
            <label class="chat-status-label pull-left">Status:</label>
            <select name="status" class="pull-left chat-status" onchange="$.get('<?= Yii::app()->request->baseUrl ?>/home/ChatChangeStatus?status=' + this.value);">
                <option value="0" <?= $cu_status == 0 ? 'selected' : '' ?>> Online</option>
                <option value="2" <?= $cu_status == 2 ? 'selected' : '' ?>> Offline</option>
                <option value="1" <?= $cu_status == 1 ? 'selected' : '' ?>> Busy</option>
            </select>
        </div>
        <div class="friends-list-wrap">
            <div class="chat-windows-wrap" style="display:inline-flex;" id="conversations">
                <?php $this->renderFile(Yii::app()->basePath . '/views/home/chat-windows.php'); ?>
            </div>
            <div id="filter-src-chat" class="friends-list custom-scroll">
                <?php $this->renderFile(Yii::app()->basePath . '/views/home/chat-list.php'); ?>
            </div>
            <!-- /.friends-list -->
        </div>
        <!-- /.friends-list-wrap -->
    </div>
    <!-- /.contacts-list -->
</aside>
<!-- /.sidebar-alt -->