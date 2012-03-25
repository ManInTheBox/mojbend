<?php $this->renderFlash(); ?>

<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'group-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary(array($user, $person, $artist, $newPasswordForm)); ?>

<table>
    <tr>
        <td><?php echo $form->labelEx($artist, 'list_artist_type_id'); ?></td>
        <td><?php echo $form->dropDownList($artist, 'list_artist_type_id', array(), array('style' => 'width: 432px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($artist, 'description'); ?></td>
        <td><?php echo $form->textArea($artist, 'description', array('style' => 'width: 420px; height: 100px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($person, 'first_name'); ?></td>
        <td><?php echo $form->textField($person, 'first_name', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($person, 'last_name'); ?></td>
        <td><?php echo $form->textField($person, 'last_name', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($person, 'birth_date'); ?></td>
        <td><?php echo $form->textField($person, 'birth_date', array('style' => 'width: 420px;', 'readonly' => 'readonly')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($person, 'gender'); ?></td>
        <td><?php echo $form->dropDownList($person, 'gender', $person->genderOptions, array('style' => 'width: 432px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($user, 'email'); ?></td>
        <td><?php echo $form->textField($user, 'email', array('style' => 'width: 420px;', 'disabled' => 'disabled')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($newPasswordForm, 'oldPassword'); ?></td>
        <td><?php echo $form->passwordField($newPasswordForm, 'oldPassword', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($newPasswordForm, 'newPassword'); ?></td>
        <td><?php echo $form->passwordField($newPasswordForm, 'newPassword', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($newPasswordForm, 'newPasswordRepeat'); ?></td>
        <td><?php echo $form->passwordField($newPasswordForm, 'newPasswordRepeat', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($user, 'isArtist'); ?></td>
        <td><?php echo $form->checkBox($user, 'isArtist'); ?></td>
    </tr>
    <tr>
        <td class="button"><?php echo Html::submitButton(t('Sačuvaj izmene')); ?></td>
        <td class="button"><?php echo l(Html::button(t('Odustani')), array('/artist/view', 'uid' => u()->id)); ?></td>
    </tr>
</table>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $('#Person_birth_date').datepicker({
        dateFormat: 'dd.mm.yy',
        changeYear: true,
        yearRange: '1920:<?php echo date('Y'); ?>'
    });
</script>