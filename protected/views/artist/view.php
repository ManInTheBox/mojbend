<?php $this->renderFlash(); ?>

<table>
    <tr>
        <td>
            <h4><?php echo l(e($person->fullName), array()); ?></h4>
            <?php if ($isOwner) { ?>
            <a href="<?php echo url('/artist/edit', array('uid' => $user->id)); ?>" class="button small"><input type="button" value="<?php echo t('Izmeni'); ?>"/></a>
            <a href="<?php echo url('addPicture', array('id' => $user->id, 'related' => 'artist')); ?>" class="button small"><input type="button" value="<?php echo t('Dodaj slike'); ?>" /></a>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td>
            <a style="position: relative;" href="<?php echo $user->profilePicture->getShortPath('_large'); ?>" class="fancybox">
                <img id="profilePicture" alt="<?php echo e($person->fullName); ?>" title="<?php echo e($person->fullName); ?>" src="<?php echo $user->profilePicture->shortPath; ?>" />
            </a>
        </td>
        <td>
            <div style="height: 160px;">
                <a href="#" class="button"><input id="becomeFan" type="button" value="<?php echo $fanButton; ?>" /></a>
            </div>
            <strong><?php echo t('O umetniku:'); ?></strong><br /><br /><br />
            <blockquote id="description">
                <?php echo $artist->description ?: t('Umetnik nije ostavio podatke.'); ?>
            </blockquote>
        </td>
    </tr>
    <tr>
        <td><?php echo e($artist->getAttributeLabel('list_artist_type_id')); ?>:</td>
        <td><?php echo e(Html::getChosenListOption($artist->list_artist_type_id, 'list_artist_type')); ?></td>
    </tr>
    <tr>
        <td><?php echo e($person->getAttributeLabel('birth_date')); ?>:</td>
        <td><?php echo e($person->birth_date); ?></td>
    </tr>
    <tr>
        <td><?php echo e($person->getAttributeLabel('gender')); ?>:</td>
        <td><?php echo !empty($person->gender) ? e($person->gender) : $person->emptyMessage; ?></td>
    </tr>
</table>

<?php
    echo CHtml::beginForm(array('removePicture'), 'post', array('id' => 'removePictureForm'));
    echo CHtml::hiddenField('pid');
    echo CHtml::hiddenField('id', $user->id);
    echo CHtml::hiddenField('related', 'artist');
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
    var profilePicture = <?php echo $user->profilePicture->id; ?>;
    
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
            url: '<?php echo url('/user/profilePicture');?>',
            type: 'POST',
            dataType: 'json',
            data: {
                CSRF_TOKEN: '<?php echo r()->getCsrfToken(); ?>',
                uid: '<?php echo u()->id; ?>',
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
    
    $('#becomeFan').click(function (e) {
        
        <?php if (guest()) { ?>
            window.location = '<?php echo url('/user/login'); ?>';
        <?php } ?>
        
        e.preventDefault();
        $.ajax({
            url: '<?php echo url('/artist/fan'); ?>',
            type: 'POST',
            data: {
                CSRF_TOKEN: '<?php echo r()->getCsrfToken(); ?>',
                uid: '<?php echo u()->id; ?>'
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
            url: '<?php echo url('/artist/moreDescription', array('uid' => $user->id));?>',
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