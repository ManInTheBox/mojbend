LIST ACTION

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $groups,
    'itemView' => '_item',
));
?>