
<div class="box">
<?php $this->renderFlash(); ?>
<a class="button" href="<?php echo url('/group/new'); ?>"><input type="button" value="<?php echo t('Kreiraj bend'); ?>"/></a>

<?php
$this->widget('zii.widgets.CListView', array(
    'pager' => array(
        'class' => 'CLinkPager',
        'firstPageLabel' => t('Prva'),
        'lastPageLabel' => t('Poslednja'),
        'nextPageLabel' => t('Sledeća'),
        'prevPageLabel' => t('Prethodna'),
        'header' => false,
    ),
    'dataProvider' => $groups,
    'itemView' => '_item',
    'ajaxUpdate' => false,
    'summaryText' => false,
    'emptyText' => t('Ne postoji ni jedan bend.'),
));
?>
</div>