<?php $this->renderFlash(); ?>

<table cellspacing="0">
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
            <a title="<?php echo $group->profilePicture->fancybox; ?>" style="position: relative;" href="<?php echo $group->profilePicture->getShortPath('_large'); ?>" class="fancybox">
                <img id="profilePicture" alt="<?php echo e($group->name); ?>" title="<?php echo e($group->name); ?>" src="<?php echo $group->profilePicture->shortPath; ?>" />
            </a>
        </td>
        <td>
            <div style="height: 160px;">
                <a href="#" class="button"><input id="becomeFan" type="button" value="<?php echo $fanButton; ?>" /></a>
                <br /><br />
                <a href="#" class="button"><input id="joinGroup" type="button" value="<?php echo $joinButton; ?>" /></a>
                <?php if ($isOwner) { ?>
                <br /><br />
                <a href="#" class="button"><input id="removeGroupBtnLarge" type="button" value="<?php echo t('Obriši'); ?>" /></a>
                <?php } ?>
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
    if ($isOwner) {
        echo CHtml::beginForm(array('removePicture'), 'post', array('id' => 'removePictureForm'));
        echo CHtml::hiddenField('pid');
        echo CHtml::hiddenField('id', $group->id);
        echo CHtml::hiddenField('related', 'group');
        echo CHtml::endForm();
        
        echo CHtml::beginForm(array('/group/delete'), 'post', array('id' => 'removeGroup'));
        echo CHtml::hiddenField('gid', $group->id);
        echo CHtml::endForm();
    }
?>


<div class="gallery">
<h3><?php echo t('Članovi benda'); ?></h3>
<?php echo Html::form(array('/group/join'), 'post', array('id' => 'removeMember')); ?>
    <input type="hidden" name="gid" value="<?php echo $group->id; ?>" />
    <input type="hidden" name="uid" id="uid" value="" />
<?php foreach ($group->artists as $artist) { ?>
    <div class="thumb">
        <?php if ($isOwner) { ?>
        <input rel="<?php echo $artist->user_id; ?>" type="submit" class="removeMember" <?php echo $artist->user_id == u()->id ? 'id="removeGroupBtn"' : ''; ?> value="<?php echo t('Obriši'); ?>" />
        <?php } ?>
        <a class="artistInfo" href="<?php echo url('/artist/view', array('uid' => $artist->user_id)); ?>"><?php echo e($artist->user->person->fullName); ?></a>
        <a title="<?php echo $artist->user->profilePicture->fancybox; ?>" rel="pictureGroup" href="<?php echo $artist->user->profilePicture->getShortPath('_large'); ?>" class="fancybox">
            <img alt="<?php echo e($artist->user->person->fullName); ?>" title="<?php echo e($artist->user->person->fullName); ?>" src="<?php echo $artist->user->profilePicture->getShortPath('_small'); ?>" />
        </a>
    </div>
<?php } ?>
<?php echo Html::endForm(); ?>
</div>

<div class="clear"></div>

<div class="gallery">
<h3><?php echo t('Slike'); ?></h3>
<?php foreach ($pictures as $i => $picture) { ?>
    <div class="thumb">
        <?php if ($isOwner) { ?>
            <a class="editPicture" href="<?php echo url('editPicture', array('id' => $picture->id, 'related_id' => $group->id, 'related' => 'group')); ?>"><?php echo t('Izmeni'); ?></a>
            <a class="removePicture" href="#" id="<?php echo $picture->id; ?>"><?php echo t('Obriši'); ?></a>
            <a class="setProfilePicture" href="#" id="<?php echo $picture->id; ?>"><?php echo t('Postavi za profil sliku'); ?></a>
        <?php } ?>
        <a title="<?php echo $picture->fancybox; ?>" rel="pictureGroup" href="<?php echo $picture->getShortPath('_large'); ?>" class="fancybox">
            <img alt="<?php echo e($picture->name); ?>" src="<?php echo $picture->getShortPath('_small'); ?>" />
        </a>
    </div>
<?php } ?>
</div>

<div class="clear"></div>

<?php if (false) { ?>

<div class="gallery">
<h3><?php echo t('Video');?></h3>
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

<div class="clear"></div>

<?php } ?>

<div class="gallery">
<h3><?php echo t('Fanovi');?></h3>
<?php echo Html::form(array('/group/removeFan')); ?>
<?php foreach ($group->fans as $fan) { ?>
    <div class="thumb">
        <?php if ($isOwner) { ?>
        <input type="hidden" name="uid" value="<?php echo $fan->id; ?>" />
        <input type="hidden" name="gid" value="<?php echo $group->id; ?>" />
        <input type="submit" class="removeFan" value="<?php echo t('Obriši'); ?>" />
        <?php } ?>
        <a title="<?php echo $fan->profilePicture->fancybox; ?>" rel="pictureGroup" href="<?php echo $fan->profilePicture->getShortPath('_large'); ?>" class="fancybox">
            <img alt="<?php echo e($fan->person->fullName); ?>" title="<?php echo e($fan->person->fullName); ?>" src="<?php echo $fan->profilePicture->getShortPath('_small'); ?>" />
        </a>
    </div>
<?php } ?>
<?php echo Html::endForm(); ?>
</div>

<?php if ($isOwner) { ?>
<div id="inviteMembersDialog" style="display: none; padding: 25px 0 15px 15px;">
    <input id="searchArtist" type="text" style="width: 420px; height: 30px; padding: 5px;" />
    <div id="targetMembers" style="margin-top: 20px;"></div>
</div>
<?php } ?>

<div id="dialogMessage">
    <br />
    <?php echo t('Uspešno ste pozvali muzičare da se priključe vašem bendu.'); ?>
</div>

<script type="text/javascript">
$(function() {
    
    $('#dialogMessage').dialog({
        autoOpen: false,
        width: 500,
        resizable: false,
        modal: true,
        buttons: [
            {
                text: '<?php echo t('Zatvori'); ?>',
                click: function () {
                    $(this).dialog('close');
                }
            }
        ]
    });

<?php if ($isOwner) { ?>

    $('#searchArtist').autocomplete({
        minLength: 1,
        source: '<?php echo url('search', array('artist' => true));?>',
        delay: 300,
        select: function (event, ui) {
            var html = [
               '<span class="targetMembersId" rel="' + ui.item.id + '">',
                    ui.item.label,
               ' <a href="#" class="acRemove">ukloni</a><br /><br /></span>'
            ].join('');
            $('#targetMembers').append(html);
            $('#searchArtist').val('')
            return false;
        },
        focus: function (event, ui) {
            return false;
        }
     });

    $('.acRemove').live('click', function (e) {
        e.preventDefault();
        $(this).parent().remove();
    });

    $('#inviteMembersDialog').dialog({
        autoOpen: false,
        width: 500,
        resizable: false,
        modal: true,
        title: '<?php echo t('Pozovite muzičare da se priključe vašem bendu'); ?>',
        buttons: [
            {
                text: '<?php echo t('Zatvori'); ?>',
                click: function () {
                    $(this).dialog('close');
                }
            },
            {
                text: '<?php echo t('Pozovi'); ?>',
                click: function () {
                    var ids = [];
                    var targets = $.find('.targetMembersId');

                    for (var i = 0; i < targets.length; i++) {
                        ids.push($(targets[i]).attr('rel'));
                    }
                    
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
                            if (targets.length) {
                                $('#dialogMessage').dialog('open');
                            }
                            $(targets).each(function () { $(this).remove(); });
                        },
                        error: function(xhr) {
                            $(targets).each(function () { $(this).remove(); });
                            console.log(xhr.responseText);
                        }
                    });
                    $(this).dialog('close');
                }
            }
        ]
    });

    $('#inviteMembers').click(function(e) {
        e.preventDefault();
        $('#inviteMembersDialog').dialog('open');
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
    
    $('#removeGroupBtn').click(function (e) {
        e.preventDefault();
        return confirm('<?php echo t('Vi ste administrator benda.\nAko ga napustite on će biti obrisan.'); ?>')
            ? $('#removeGroup').submit()
            : false;
    });
    
    $('.removeMember').click(function () {
        $('#uid').val($(this).attr('rel'));
        $('#removeMember').submit();
    });
    
    $('#removeGroupBtnLarge').click(function (e) {
        e.preventDefault();
        return confirm('<?php echo t('Da li sigurno želite da obrišete bend?'); ?>')
            ? $('#removeGroup').submit()
            : false;
    });

<?php } ?>
    
    $('#joinGroup').click(function(e) {

        <?php if (guest()) { ?>
            window.location = '<?php echo url('/user/login'); ?>';
        <?php } ?>

        e.preventDefault();

        <?php if ($isOwner) { ?>
        return confirm('<?php echo t('Vi ste administrator benda.\nAko ga napustite on će biti obrisan.'); ?>')
            ? $('#removeGroup').submit()
            : false;
        <?php } else { ?>
        $.ajax({
            url: '<?php echo url('/group/join'); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                CSRF_TOKEN: '<?php echo r()->getCsrfToken(); ?>',
                gid: <?php echo $group->id; ?>
            },
            success: function(res) {
                if (res.err) {
                    window.location = '<?php echo url('/user/edit'); ?>';
                }
                $('#joinGroup').val(res.msg);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
        <?php } ?>
    });
    
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