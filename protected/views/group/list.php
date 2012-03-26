<?php

$this->renderFlash();

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $groups,
    'itemView' => '_item',
    'ajaxUpdate' => false,
));
?>