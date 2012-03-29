<?php
$criteria = new CDbCriteria();
$criteria->condition = 'fan_id = :id AND artist_id = :uid';
$criteria->params = array(':id' => u()->id, ':uid' => $data->user_id);
$fanButton = FanArtist::model()->exists($criteria) ? t('Vi ste fan') : t('Postani fan');
?>

<table>
    <tr>
        <td>
            <h4><?php echo l(e($data->user->person->fullName), $data->url); ?></h4>
        </td>
    </tr>
    <tr>
        <td>
            <a style="position: relative;" href="<?php echo $data->profilePicture->getShortPath('_large'); ?>" class="fancybox">
                <img id="profilePicture" src="<?php echo $data->profilePicture->getShortPath('_small'); ?>" alt="<?php echo e($data->user->person->fullName); ?>" title="<?php echo e($data->user->person->fullName); ?>" />
            </a>
            <div style="height: 60px; margin: 10px 0 13px 30px;">
                <a href="<?php echo $data->url; ?>" class="button small"><input type="button" value="<?php echo $fanButton; ?>" /></a>
            </div>
        </td>
        <td style="width: 450px;">
            <strong><?php echo t('O muzičaru:'); ?></strong><br /><br />
            <blockquote style="min-height: 100px;">
                <?php 
                    if (strlen($data->description) > 550)
                    {
                        $data->description = e(substr($data->description, 0, 550));
                        $data->description .= '... ' . l(t('još'), $data->url, array('id' => 'readMore'));
                    }
                    echo $data->description;
                ?>
            </blockquote>
        </td>
    </tr>
</table>