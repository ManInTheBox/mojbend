<?php $this->renderFlash(); ?>

<table>
    <tr>
        <td>
            <h4><?php echo l($group->name, array()); ?></h4>
            <?php
                if (true) // is owner
                {
                    echo l(Html::tag('input', array('type' => 'button', 'value' => t('Izmeni'))), array('/group/edit', 'gid' => $group->id), array('class' => 'button'));
                    echo '<br />' . l('pozovi clanove', '#', array('id' => 'inviteMembers'));
                }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <a href="<?php echo $group->profilePicture->shortPath; ?>" class="fancybox">
                <img alt="<?php echo e($group->name); ?>" title="<?php echo e($group->name); ?>" src="<?php echo $group->profilePicture->shortPath; ?>" />
            </a>
                    <?php echo l('postani clan', '#', array('id' => 'joinGroup')); ?>
        </td>
        <td>
            <strong><?php echo t('O bendu:'); ?></strong><br /><br /><br />
            <blockquote>
                <?php echo $group->description ?: 'Bend nije ostavio podatke.'; ?>
            </blockquote>
        </td>
    </tr>
    <tr>
        <td><?php echo e($group->getAttributeLabel('founded_date')); ?>:</td>
        <td><?php echo e($group->founded_date); ?></td>
    </tr>
    <tr>
        <td><?php echo e($group->getAttributeLabel('location')); ?>:</td>
        <td><?php echo e($group->location); ?></td>
    </tr>
    <tr>
        <td><?php echo e($group->getAttributeLabel('official_website')); ?>:</td>
        <td><?php echo ($group->official_website !== $group->emptyMessage) ? l(e($group->official_website), $group->official_website, array('target' => '_blank')) : $group->emptyMessage; ?></td>
    </tr>
    <tr>
        <td><?php echo t('Bend na društvenim mrežama'); ?>:</td>
        <td>
            <?php
                echo ($group->facebook_url !== $group->emptyMessage) ? l(e($group->facebook_url), $group->facebook_url, array('target' => '_blank')) : '';
                echo ($group->twitter_url !== $group->emptyMessage) ? '<br />' . l(e($group->twitter_url), $group->twitter_url, array('target' => '_blank')) : '';
                echo ($group->youtube_url !== $group->emptyMessage) ? '<br />' . l(e($group->youtube_url), $group->youtube_url, array('target' => '_blank')) : '';
            ?>
        </td>
    </tr>
</table>
    



<script type="text/javascript">
$(function() {
    $('#inviteMembers').click(function() {
        var ids = prompt('unesi id-jeve usera');
        $.ajax({
            url: '<?php echo url('/group/inviteMembers'); ?>',
            data: {
                CSRF_TOKEN: '<?php echo r()->getCsrfToken(); ?>',
                gid: <?php echo $group->id; ?>,
                receivers: ids
            },
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }

        });

        return false;
    });

    $('#joinGroup').click(function() {
        $.ajax({
            url: '<?php echo url('/group/join'); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                CSRF_TOKEN: '<?php echo r()->getCsrfToken(); ?>',
                gid: <?php echo $group->id; ?>,
                requester: <?php echo u()->id; ?>
            },
            success: function(data) {
                console.log(data);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

});
</script>