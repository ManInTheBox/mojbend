
<?php echo $this->renderFlash(); ?>

<?php
$form = $this->beginWidget('ActiveForm', array(
            'id' => 'group-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
            ),
        ));
?>

<?php echo $form->errorSummary($group); ?>
<table>
    <tr>
        <td><?php echo $form->labelEx($group, 'name'); ?></td>
        <td><?php echo $form->textField($group, 'name', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($group, 'picture'); ?></td>
        <td><?php echo $form->fileField($group, 'picture', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($group, 'founded_date'); ?></td>
        <td><?php echo $form->textField($group, 'founded_date', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($group, 'location'); ?></td>
        <td><?php echo $form->textField($group, 'location', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($group, 'official_website'); ?></td>
        <td><?php echo $form->textField($group, 'official_website', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($group, 'facebook_url'); ?></td>
        <td><?php echo $form->textField($group, 'facebook_url', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($group, 'twitter_url'); ?></td>
        <td><?php echo $form->textField($group, 'twitter_url', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($group, 'youtube_url'); ?></td>
        <td><?php echo $form->textField($group, 'youtube_url', array('style' => 'width: 420px;')); ?><td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($group, 'description'); ?></td>
        <td><?php echo $form->textArea($group, 'description', array('style' => 'width: 420px; height: 100px;')); ?></td>
    </tr>
    <tr>
        <td class="button"><?php echo CHtml::submitButton(t('Kreiraj')); ?></td>
    </tr>
</table>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $('#Group_founded_date').datepicker({
        dateFormat: 'dd.mm.yy',
        changeYear: true,
        yearRange: '1920:<?php echo date('Y'); ?>',
        monthNames: [
            'Januar', 'Februar', 'Mart', 'April',
            'Maj', 'Jun', 'Jul', 'Avgust',
            'Septembar', 'Oktobar', 'Novembar', 'Decembar'
        ],
        dayNamesMin: [
            'Pon', 'Uto', 'Sre',
            'Čet', 'Pet', 'Sub', 'Ned'
        ],
        defaultDate: '01.01.2008'
    });
</script>