<?php $this->renderFlash(); ?>

<?php
$form = $this->beginWidget('ActiveForm', array(
            'id' => 'user-form',
            'enableAjaxValidation' => false,
        ));
?>

<?php echo $form->errorSummary(array($user, $person)); ?>

<table>
    <tr>
        <td><?php echo $form->labelEx($person, 'first_name'); ?></td>
        <td><?php echo $form->textField($person, 'first_name', array('size' => 65)); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($person, 'last_name'); ?></td>
        <td><?php echo $form->textField($person, 'last_name', array('size' => 65)); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($person, 'birth_date'); ?></td>
        <td><?php echo $form->textField($person, 'birth_date', array('size' => 65, 'readonly' => 'readonly')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($person, 'gender'); ?></td>
        <td><?php echo $form->dropDownList($person, 'gender', $person->getGenderOptions(), array('style' => 'width: 433px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($user, 'email'); ?></td>
        <td><?php echo $form->textField($user, 'email', array('size' => 65, 'maxlength' => 255)); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($user, 'password'); ?></td>
        <td><?php echo $form->passwordField($user, 'password', array('size' => 65, 'maxlength' => 128)); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($user, 'is_artist'); ?></td>
        <td><?php echo $form->checkBox($user, 'is_artist'); ?></td>
    </tr>
    <tr>
        <td class="button"><?php echo CHtml::submitButton(t('Registruj se')); ?></td>
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