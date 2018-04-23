<div id="timeline-board" class="page-wrap">
    <!--<div class="page-head">
        <div class="page-actions category-tabs">
            <a href="<?=Yii::app()->request->baseUrl?>/home/market">All items</a>
            <a href="javascript:void(0)" class="current">View item</a>
        </div>
    </div>-->
    <!-- /.page-head -->
    <section class="page-contain">
        <div class="product-overview">
            <h1 class="product-title"><?=$product->title?></h1>
            <span class="product-price">fixed Price <strong><?=number_format($product->price,2)?> $</strong></span>
            <div class="product-details">
                <span class="released-date">Added on: <strong><?=date('D',strtotime($product->date_created)).', '.date('d',strtotime($product->date_created)).' '.date('F',strtotime($product->date_created)).'  &nbsp;'.date('h',strtotime($product->date_created)).':'.date('i',strtotime($product->date_created)).' '.(date('H',strtotime($product->date_created))>12?'PM':'AM')?></strong></span>
                <span class="local-placement"><?=$product->city?></span>
            </div>
            <!-- /.product-details -->
            <div class="product-inner">
                <div class="product-description">
                    <h2>Description</h2>
                    <p>
                        <?=$product->desc?>
                    </p>
                </div>
                <!-- /.product-description -->
                <div class="product-thumbs-slider">
                    <ul class="bx-slider" data-has-counter="#product-thumbs-counter" data-has-pager="1" data-pager-custom="#products-pager">
                        <li>
                            <a href="javascript:void(0)" class="product-img">
                                <img src="<?=Yii::app()->request->baseUrl?>/media/products/<?=$main_img->image?>" width="290" alt="<?=$product->title?>" />
                            </a>
                        </li>
                        <?php
                        	if($images)
							{
								foreach($images as $image)
								{
						?>
                                    <li>
                                        <a href="javascript:void(0)" class="product-img">
                                            <img src="<?=Yii::app()->request->baseUrl?>/media/products/<?=$image->image?>" width="290" alt="<?=$product->title?>" />
                                        </a>
                                    </li>
                        <?php 
								}
							}
						?>
                    </ul>
                    <!-- /.bx-slider -->
                    <span id="product-thumbs-counter" class="product-thumbs-counter">
                        <span>1</span> of <?=count($images)+1?>
                    </span>
                    <!-- /.product-thumbs-counter -->
                    <div class="products-pager">
                        <div class="pager-wrap">
                            <ul id="products-pager" class="bx-slider" data-has-controls="1" data-show-slides="3" data-el-width="50">
                                <li>
                                    <a href="javascript:void(0)" data-slide-index="0" class="product-thumb">
                                        <img src="<?=Yii::app()->request->baseUrl?>/media/products/<?=$main_img->image?>" alt="<?=$product->title?>" width="50" height="50"/>
                                    </a>
                                </li>
                                <?php
									if($images)
									{
										foreach($images as $i=>$image)
										{
								?>
											<li>
												<a href="#" data-slide-index="<?=$i+1?>" class="product-thumb">
													<img src="<?=Yii::app()->request->baseUrl?>/media/products/<?=$image->image?>" width="50" alt="<?=$product->title?>" />
												</a>
											</li>
								<?php 
										}
									}
								?>
                            </ul>
                        </div>
                        <!-- /.pager-wrap -->
                    </div>
                </div>
                <!-- /.product-thumbs-slider -->
            </div>
            <!-- /.product-inner -->
            <div class="seller-container">
                <h3>Contact with seller</h3>
                <form action="?" class="seller-contact-form form-wrap" method="post">
                        <div class="control-group">
                            <label for="seller-email" class="control-label">Your email adress</label>
                          <div class="controls">
                            <input id="seller-email" name="seller-email" type="text" class="input-xlarge">
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="seller-msg" class="control-label">Your message</label>
                          <div class="controls">
                            <textarea id="seller-msg" name="seller-msg" class="textarea-xlarge"></textarea>
                          </div>
                        </div>
                        <div class="submit-btn-wrap">
                            <button type="submit" type="submit" class="btn btn-blue">Send</button>
                        </div>
                </form>
                <!-- /.seller-contact-form -->
                <div class="seller-contact-infos">
                    <div class="contact-info">
                        <span class="info-label">Seller</span>
                        <strong class="info-plain seller"><?=$product->full_name?></strong>
                    </div>
                    <div class="contact-info">
                        <span class="info-label">Contact</span>
                        <strong class="info-plain"><?=substr($product->phone,0,3)?>******<br /><?=explode('@',$product->email)[0]?>@*******</strong>
                    </div>
                </div>
                <!-- /.seller-contact-info -->
            </div>
            <!-- /.seller-container -->
        </div>
    </section>
    <!-- /.page-contain -->
</div>
