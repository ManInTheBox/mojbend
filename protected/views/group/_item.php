<?php
$criteria = new CDbCriteria();
$criteria->condition = 'fan_id = :id AND group_id = :gid';
$criteria->params = array(':id' => u()->id, ':gid' => $data->id);
$fanButton = FanGroup::model()->exists($criteria) ? t('Vi ste fan') : t('Postani fan');

$criteria = new CDbCriteria();
$criteria->condition = 'artist_id = :id AND group_id = :gid';
$criteria->params = array(':id' => u()->id, ':gid' => $data->id);
$joinButton = ArtistGroup::model()->exists($criteria) ? t('Napusti bend') : t('Priključi se');
?>

<table>
    <tr>
        <td>
            <h4><?php echo l(e($data->name), array('/group/view', 'gid' => $data->id)); ?></h4>
        </td>
    </tr>
    <tr>
        <td>
            <a style="position: relative;" href="<?php echo $data->profilePicture->getShortPath('_large'); ?>" class="fancybox">
                <img id="profilePicture" src="<?php echo $data->profilePicture->getShortPath('_small'); ?>" alt="<?php echo e($data->name); ?>" title="<?php echo e($data->name); ?>" />
            </a>
            <div style="height: 60px; margin: 10px 0 13px 30px;">
                <a href="<?php echo $data->url; ?>" class="button small"><input type="button" value="<?php echo $fanButton; ?>" /></a>
                <br /><br />
                <a href="<?php echo $data->url; ?>" class="button small"><input type="button" value="<?php echo $joinButton; ?>" /></a>
            </div>
        </td>
        <td style="width: 450px;">
            <strong><?php echo t('O bendu:'); ?></strong><br /><br />
            <blockquote style="min-height: 100px;">
                <?php 
                    if (strlen($data->description) > 550)
                    {
                        $data->description = e(substr($data->description, 0, 550));
                        $data->description .= '... ' . l(t('još'), array('/group/view', 'gid' => $data->id), array('id' => 'readMore'));
                    }
                    echo $data->description ?: t('Bend nije ostavio podatke.');
                ?>
            </blockquote>
        </td>
    </tr>
</table>