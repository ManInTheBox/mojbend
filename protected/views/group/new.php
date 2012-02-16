
<?php echo $this->renderFlash(); ?>
<div class="form">

<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'group-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
)); ?>

	<?php echo $form->errorSummary($group); ?>

	<div class="row">
		<?php echo $form->labelEx($group, 'name'); ?>
		<?php echo $form->textField($group,'name'); ?>
		<?php echo $form->error($group,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($group,'description'); ?>
		<?php echo $form->textArea($group,'description'); ?>
		<?php echo $form->error($group,'description'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($group,'founded_date'); ?>
		<?php echo $form->textField($group,'founded_date'); ?>
		<?php echo $form->error($group,'founded_date'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($group,'official_website'); ?>
		<?php echo $form->textField($group,'official_website'); ?>
		<?php echo $form->error($group,'official_website'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($group,'facebook_url'); ?>
		<?php echo $form->textField($group,'facebook_url'); ?>
		<?php echo $form->error($group,'facebook_url'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($group,'twitter_url'); ?>
		<?php echo $form->textField($group,'twitter_url'); ?>
		<?php echo $form->error($group,'twitter_url'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($group,'youtube_url'); ?>
		<?php echo $form->textField($group,'youtube_url'); ?>
		<?php echo $form->error($group,'youtube_url'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($group,'picture'); ?>
		<?php echo $form->fileField($group,'picture'); ?>
		<?php echo $form->error($group,'picture'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->