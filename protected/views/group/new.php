
<?php echo $this->renderFlash(); ?>
<div class="form">

    <?php
    $form = $this->beginWidget('ActiveForm', array(
                'id' => 'group-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                ),
            ));
    ?>

    <?php // echo $form->errorSummary($group); ?>
    <table>
        <tr>
            <td>
                <?php echo $form->labelEx($group, 'name'); ?>
            </td>
            <td>
                <?php echo $form->textField($group, 'name', array('style' => 'width: 400px;')); ?>
            </td>
            <td>
                <?php echo $form->error($group, 'name'); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($group, 'description'); ?></td>
            <td><?php echo $form->textArea($group, 'description'); ?></td>
            <td><?php echo $form->error($group, 'description'); ?></td>
        </tr>

        <tr>
            <td>
                <?php echo $form->labelEx($group, 'founded_date'); ?></td>
            <td>		<?php echo $form->textField($group, 'founded_date'); ?></td>
            <td>		<?php echo $form->error($group, 'founded_date'); ?></td>
        <tr><td>
                <?php echo $form->labelEx($group, 'official_website'); ?></td>
            <td>		<?php echo $form->textField($group, 'official_website'); ?></td>
            <td>		<?php echo $form->error($group, 'official_website'); ?></td>
        <tr><td>		<?php echo $form->labelEx($group, 'facebook_url'); ?></td>
            <td>		<?php echo $form->textField($group, 'facebook_url'); ?></td>
            <td>		<?php echo $form->error($group, 'facebook_url'); ?></td>
        <tr>
            <td>	<?php echo $form->labelEx($group, 'twitter_url'); ?></td>
            <td>	<?php echo $form->textField($group, 'twitter_url'); ?></td>
            <td>		<?php echo $form->error($group, 'twitter_url'); ?></td>
        <tr><td>		<?php echo $form->labelEx($group, 'youtube_url'); ?>
            </td>
            <td>		<?php echo $form->textField($group, 'youtube_url'); ?><td>
            <td>		<?php echo $form->error($group, 'youtube_url'); ?></td>
        <tr><td>
                <?php echo $form->labelEx($group, 'picture'); ?></td>
            <td>		<?php echo $form->fileField($group, 'picture'); ?></td>
            <td>		<?php echo $form->error($group, 'picture'); ?></td>

        <tr><td>
                <?php echo CHtml::submitButton('Save'); ?></td></tr>
    </table>
    <?php $this->endWidget(); ?>

</div><!-- form -->