<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <div class="page-actions history-tabs">
            <a href="<?=Yii::app()->request->baseUrl?>/home" class="back">Back</a>
            <div class="all-items">
                <a href="javascript:void(0)" class="current">All items</a>
            </div>
        </div>
    </div>
    <!-- /.page-head -->
    <section class="page-contain">
        <div class="markets-list">
            <?php
            if ($products) {
                foreach ($products as $product) {
                    $main_img = ProductImage::model()->find(array('condition' => 'main_image=1 and product_id=' . $product->id));
                    ?>
                    <div class="market-wrap">
                        <div class="market-overview">
                            <a href="<?= Yii::app()->request->baseUrl ?>/home/product/<?= $product->slug ?>" class="market-thumb">
                                <img src="<?= Yii::app()->request->baseUrl ?>/media/products/<?= $main_img->image ?>" alt="<?= $product->title ?>" width="120"/>
                            </a>
                            <div class="market-details">
                                <div class="market-info">
                                    <h2 class="market-title">
                                        <?php
                                            if($my){
                                        ?>
                                            <a class="pull-right edit-pro" href="<?=Yii::app()->request->baseUrl?>/home/updateProduct/<?=$product->id?>"> </a>
                                        <?php
                                            }
                                        ?>
                                        <a href="<?= Yii::app()->request->baseUrl ?>/home/product/<?= $product->slug ?>"><?= $product->title ?></a>
                                    </h2>
                                    <p class="market-excerpt"><?= substr($product->desc, 0, 250) ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- /.market-overview -->
                        <div class="market-actions">
                            <span class="market-seller">Seller: <?= $product->full_name ?></span>
                            <span class="market-date"><?= date('D', strtotime($product->date_created)) . ', ' . date('d', strtotime($product->date_created)) . ' ' . date('F', strtotime($product->date_created)) . '  &nbsp;' . date('h', strtotime($product->date_created)) . ':' . date('i', strtotime($product->date_created)) . ' ' . (date('H', strtotime($product->date_created)) > 12 ? 'PM' : 'AM') ?></span>
                            <span class="market-price"><?= number_format($product->price, 2) ?> $</span>
                        </div>
                    </div>
        <?php
    }
} else {
    echo '<div class="ui-notification"><p>No Products found.</p></div>';
}
?>         
        </div>
            <?php
            $this->widget('CLinkPager', array(
                'pages' => $pages,
                'header' => '',
                'nextPageLabel' => '',
                'prevPageLabel' => '',
                'firstPageLabel' => '',
                'lastPageLabel' => '',
                'maxButtonCount' => '8',
                'firstPageCssClass' => 'pager_first', //default "first"
                'lastPageCssClass' => 'pager_last', //default "last"
                'previousPageCssClass' => 'pager_previous', //default "previours"
                'nextPageCssClass' => 'pager_next', //default "next"
                'internalPageCssClass' => 'pager_li', //default "page"
                'selectedPageCssClass' => 'pager_selected_li', //default "selected"
                'hiddenPageCssClass' => 'pager_hidden_li', //default "hidden"  
                'htmlOptions' => array('class' => 'pagination'),
            ));
            ?>
        <!-- /.markets-list -->
        <!-- /.pagination -->
    </section>
    <!-- /.page-contain -->
</div>