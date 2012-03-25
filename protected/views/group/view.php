<?php $this->renderFlash(); ?>

<table>
    <tr>
        <td>
            <h4><?php echo l(e($group->name), array()); ?></h4>
            <?php if ($isOwner) { ?>
            <a href="<?php echo url('/group/edit', array('gid' => $group->id)); ?>" class="button small"><input type="button" value="<?php echo t('Izmeni'); ?>"/></a>
            <a href="#" class="button small" id="inviteMembers"><input type="button" value="<?php echo t('Pozovi članove'); ?>" /></a>
            <a href="<?php echo url('addPicture', array('id' => $group->id, 'related' => 'group')); ?>" class="button small"><input type="button" value="<?php echo t('Dodaj slike'); ?>" /></a>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td>
            <a style="position: relative;" href="<?php echo $group->profilePicture->getShortPath('_large'); ?>" class="fancybox">
                <img id="profilePicture" alt="<?php echo e($group->name); ?>" title="<?php echo e($group->name); ?>" src="<?php echo $group->profilePicture->shortPath; ?>" />
            </a>
        </td>
        <td>
            <div style="height: 160px;">
                <a href="#" class="button"><input id="becomeFan" type="button" value="<?php echo $fanButton; ?>" /></a>
                <br /><br />
                <a href="#" class="button"><input type="button" value="<?php echo $joinButton; ?>" /></a>
            </div>
            <strong><?php echo t('O bendu:'); ?></strong><br /><br /><br />
            <blockquote id="description">
                <?php echo $group->description ?: t('Bend nije ostavio podatke.'); ?>
            </blockquote>
        </td>
    </tr>
    <tr>
        <td><?php echo e($group->getAttributeLabel('founded_date')); ?>:</td>
        <td><?php echo e($group->founded_date); ?></td>
    </tr>
    <tr>
        <td><?php echo e($group->getAttributeLabel('location')); ?>:</td>
        <td><?php echo !empty($group->location) ? e($group->location) : $group->emptyMessage; ?></td>
    </tr>
    <tr>
        <td><?php echo e($group->getAttributeLabel('official_website')); ?>:</td>
        <td><?php echo !empty($group->official_website) ? l(e($group->official_website), $group->official_website, array('target' => '_blank')) : $group->emptyMessage; ?></td>
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

<?php
    echo CHtml::beginForm(array('removePicture'), 'post', array('id' => 'removePictureForm'));
    echo CHtml::hiddenField('pid');
    echo CHtml::hiddenField('id', $group->id);
    echo CHtml::hiddenField('related', 'group');
    echo CHtml::endForm();
?>


<div id="gallery">
<?php foreach ($pictures as $i => $picture) { ?>
    <div class="thumb">
        <?php if ($isOwner) { ?>
            <a class="removePicture" href="#" id="<?php echo $picture->id; ?>"><?php echo t('Obriši'); ?></a>
            <a class="setProfilePicture" href="#" id="<?php echo $picture->id; ?>"><?php echo t('Postavi za profil sliku'); ?></a>
        <?php } ?>
        <a rel="pictureGroup" href="<?php echo $picture->getShortPath('_large'); ?>" class="fancybox">
            <img alt="<?php echo e($picture->name); ?>" title="<?php echo e($picture->name); ?>" src="<?php echo $picture->getShortPath('_small'); ?>" />
        </a>
    </div>
<?php } ?>
</div>

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

//    $('#joinGroup').click(function() {
//        $.ajax({
//            url: '<?php echo url('/group/join'); ?>',
//            type: 'POST',
//            dataType: 'json',
//            data: {
//                CSRF_TOKEN: '<?php echo r()->getCsrfToken(); ?>',
//                gid: <?php echo $group->id; ?>,
//                requester: <?php echo u()->id; ?>
//            },
//            success: function(data) {
//                console.log(data);
//            },
//            error: function(xhr) {
//                console.log(xhr.responseText);
//            }
//        });
//    });
    
    $('#becomeFan').click(function (e) {
        
        <?php if (guest()) { ?>
            window.location = '<?php echo url('/user/login'); ?>';
        <?php } ?>
        
        e.preventDefault();
        $.ajax({
            url: '<?php echo url('/group/fan'); ?>',
            type: 'POST',
            data: {
                CSRF_TOKEN: '<?php echo r()->getCsrfToken(); ?>',
                gid: <?php echo $group->id; ?>
            },
            success: function (res) {
                $('#becomeFan').val(res);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
    
    var profilePicture = <?php echo $group->profilePicture->id; ?>;
    
    $('.removePicture').click(function () {
        if ($(this).attr('id') == profilePicture) {
            alert('<?php echo t('Ne možete obrisati ovu sliku jer je ona profilna.'); ?>');
            return false;
        }
    
        $('#pid').val($(this).attr('id'));
        $('#removePictureForm').submit();
    });
    
    $('.setProfilePicture').click(function (e) {
        e.preventDefault();
        var pid = $(this).attr('id');
        $.ajax({
            url: '<?php echo url('/group/profilePicture');?>',
            type: 'POST',
            dataType: 'json',
            data: {
                CSRF_TOKEN: '<?php echo r()->getCsrfToken(); ?>',
                gid: <?php echo $group->id; ?>,
                pid: pid
            },
            success: function (res) {
                $('#profilePicture').attr('src', res.src);
                $('#profilePicture').parent('.fancybox').attr('href', res.href);
                profilePicture = pid;
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
    
    $('#readMore').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo url('/group/moreDescription', array('gid' => $group->id));?>',
            success: function (res) {
                $('#description').text(res);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });

});
</script>