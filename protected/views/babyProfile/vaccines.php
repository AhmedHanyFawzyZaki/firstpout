<div id="timeline-board" class="page-wrap">
    <div class="page-head">
    	<?php $this->renderPartial('medical-tabs',array('id'=>$id))?>
    </div>
    <!-- /.page-head -->
    <section class="page-contain vaccine-listing">
        <div class="vaccine-overview-block">
            <h2 id="vaccine-title" class="block-title">Vaccine</h2>
            <span id="vaccine-num" class="vaccine-num"><span><?= count($vaccines)>1?(count($prev_vaccines) + 1):count($prev_vaccines) ?></span> of <?= count($vaccines) ?></span>
            <?php
            if (empty($current_vaccine)) {
                echo '<div class="vaccine-wrap"><div class="vaccine-overview">No Vaccines Added.</div></div>';
            } else {
                ?>
                <div class="vaccine-wrap">
                    <div class="vaccine-overview">
                        <div class="vaccine-info">
                            Next vaccine:
                            <strong><?= $current_vaccine->title ?></strong>
                        </div>
                        <div class="vaccine-info">
                            Date:
                            <strong><?= $current_vaccine->date_of_vaccine ?></strong>
                        </div>
                        <div class="vaccine-info scheduled-visit">
                            Visit:
                            <strong><?= $current_vaccine->visit_id ? $vacc->visit->title : 'No visit assigned' ?></strong>
                        </div>
                    </div>
                    <div class="vaccine-details">
                        <div class="vaccine-infos">
                            <h3>Vaccine Information</h3>
                            <p>
                                <?= $current_vaccine->desc ?>
                            </p>
                        </div>
                        <div class="vaccine-additional-infos">
                            <h3>Next vaccine: <?= $current_vaccine->nextVaccine->title ? $current_vaccine->nextVaccine->title : 'Not set' ?></h3>
                            <p><?= $current_vaccine->nextVaccine->desc ? $current_vaccine->nextVaccine->desc : 'Not set' ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <!-- /.vaccine-overview-block -->
        <div class="vaccines-overview-block">
            <div class="vaccine-list">
                <h2 class="block-title">Vaccine list</h2>
                <?php
                	if($vaccines){
				?>
                <ul class="vaccine-list">
                	<?php
                    	foreach($vaccines as $vc){
							if($vc->realized){
								?>
                                <li class="vaccine-ok">
                                    <span class="vaccine-name"  onclick="vaccineDesc(<?=$vc->id?>)"><?=$vc->title?></span>
                                    <!--<a href="#" class="vaccine-history-link">
                                        <span>Check visit history</span>
                                    </a>-->
                                </li>
                                <?php
							}else{
					?>
                    		<li id="vacc-<?=$vc->id?>">
                                <span class="vaccine-name" onclick="vaccineDesc(<?=$vc->id?>)"><?=$vc->title?></span>
                                <span class="vaccine-history-link pull-right" onclick="vaccRealize(<?=$vc->id?>)"></span>
                            </li>
                    <?php
							}
						}
					?>
                </ul>
                <?php
					}else{
						echo 'No vaccines added.';
					}
				?>
            </div>
            <!-- /.vaccines-list -->
            <?php
            	if($vaccines){
			?>
            <div class="vaccine-description">
                <h2 class="block-title">Vaccine Description</h2>
                <p id="vacc-desc-id"><?=$current_vaccine->desc?></p>
            </div>
            <?php
				}
			?>
            <!-- /.vaccine-description -->
        </div>
        <!-- /.vaccines-overview-block -->
    </section>
    <!-- /.page-contain -->
</div>				

<script>
	function vaccineDesc(id){
		$.ajax({
			url:"<?=Yii::app()->request->baseUrl?>/babyProfile/vaccineDesc?id="+id,
			success: function(data){
				$('#vacc-desc-id').html(data);
			}
		});
	}
	function vaccRealize(id){
		$.ajax({
			url:"<?=Yii::app()->request->baseUrl?>/babyProfile/vaccineRealize?id="+id,
			success: function(data){
				$('#vacc-'+id).attr('class','vaccine-ok');
				$('#vacc-'+id+' span').last().remove();
			}
		});
	}
</script>