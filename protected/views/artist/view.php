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
            <a style="position: relative;" href="<?php echo $artist->user->profilePicture->getShortPath('_large'); ?>" class="fancybox">
                <img id="profilePicture" alt="<?php echo e($artist->user->person->fullName); ?>" title="<?php echo e($artist->user->person->fullName); ?>" src="<?php echo $artist->user->profilePicture->shortPath; ?>" />
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
    

</table>


<?php
    echo CHtml::beginForm(array('removePicture'), 'post', array('id' => 'removePictureForm'));
    echo CHtml::hiddenField('pid');
    echo CHtml::hiddenField('id', $user->id);
    echo CHtml::hiddenField('related', 'artist');
    echo CHtml::endForm();
?>

<?php foreach ($pictures as $picture) { ?>
<div>
    <?php
        if ($isOwner) // owner
        {
            echo l(t('Obriši'), '#', array('id' => $picture->id, 'class' => 'removePicture'));
        }
    ?>
    <a href="<?php echo $picture->shortPath; ?>" class="fancybox">
        <img alt="<?php echo e($picture->name); ?>" title="<?php echo e($picture->name); ?>" src="<?php echo $picture->shortPath; ?>" />
    </a>
</div>
<?php } ?>

<script type="text/javascript">
$(function() {
    $('.removePicture').click(function () {
        $('#pid').val($(this).attr('id'));
        $('#removePictureForm').submit();
    });
});
</script>