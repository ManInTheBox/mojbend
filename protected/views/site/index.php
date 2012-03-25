<?php $this->renderFlash(); ?>

<?php echo l(t('Register'), url('/user/register')); ?><br />
<?php echo l(t('Lost password'), url('/user/passwordReset')); ?><br />
<?php echo l('home', isset (u()->homeUrl) ? u()->homeUrl : url('/user/home')); ?><br />
<?php echo l(t('new group'), url('/group/new')); ?><br />
<?php echo l(t('grupe'), url('/group/list')); ?><br />
<?php echo l(t('USER EDIT'), url('/user/edit')); ?><br />
<?php echo l(t('nova slika'), url('addPicture', array('id' => u()->id, 'related' => 'user'))); ?><br />