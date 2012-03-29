<div class="box">
<?php

$this->renderFlash();

$this->widget('zii.widgets.CListView', array(
    'pager' => array(
        'class' => 'CLinkPager',
        'firstPageLabel' => t('Prva'),
        'lastPageLabel' => t('Poslednja'),
        'nextPageLabel' => t('Sledeća'),
        'prevPageLabel' => t('Prethodna'),
        'header' => false,
    ),
    'dataProvider' => $artists,
    'itemView' => '_item',
    'ajaxUpdate' => false,
    'summaryText' => false,
    'emptyText' => t('Ne postoji ni jedan muzičar.'),
));
?>
</div>