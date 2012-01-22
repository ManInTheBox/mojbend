<?php echo l(t('Register'), url('/user/register')); ?><br />
<?php echo l(t('Lost password'), url('/user/passwordReset')); ?><br />
<?php echo l('home', isset (u()->homeUrl) ? u()->homeUrl : url('/user/home')); ?><br />
<?php echo l(t('new group'), url('/group/new')); ?><br />
