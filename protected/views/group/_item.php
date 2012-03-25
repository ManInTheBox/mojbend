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
                <a href="#" class="button small"><input id="becomeFan" type="button" value="<?php echo 'ahahah'; ?>" /></a>
                <br /><br />
                <a href="#" class="button small"><input type="button" value="<?php echo 'joinbutton'; ?>" /></a>
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