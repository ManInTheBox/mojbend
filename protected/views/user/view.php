<?php $this->renderFlash(); ?>

<table cellspacing="0">
    <tr>
        <td>
            <h4><?php echo l(e($person->fullName), array()); ?></h4>
            <?php if ($isOwner) { ?>
            <a href="<?php echo url('/user/edit', array('uid' => $user->id)); ?>" class="button small"><input type="button" value="<?php echo t('Izmeni'); ?>"/></a>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td>
            <a style="position: relative;" href="<?php echo $user->profilePicture->getShortPath('_large'); ?>" class="fancybox">
                <img id="profilePicture" alt="<?php echo e($person->fullName); ?>" title="<?php echo e($person->fullName); ?>" src="<?php echo $user->profilePicture->shortPath; ?>" />
            </a>
        </td>
    </tr>
    <tr>
        <td><?php echo e($person->getAttributeLabel('birth_date')); ?>:</td>
        <td><?php echo e($person->birth_date); ?></td>
    </tr>
    <tr>
        <td><?php echo e($person->getAttributeLabel('gender')); ?>:</td>
        <td><?php echo $person->chosenGender; ?></td>
    </tr>
</table>