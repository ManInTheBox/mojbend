<div class="footer-content">
    <div class="footer-box">
        <h4><?php echo t('O projektu mojbend'); ?></h4>
        <p>
            <?php echo t('neki poduzi tekst...neki poduzi tekst...neki poduzi tekst...neki poduzi tekst...neki poduzi tekst...'); ?>
        </p>
    </div>
    <div class="footer-box">
        <h4><?php echo t('Brzi linkovi'); ?></h4>
        <ul>
            <li><?php echo l(t('Izgubljena lozinka'), array('/user/passwordReset')); ?></li>
            <li><?php echo l(t('Izgubljena lozinka'), array('/user/passwordReset')); ?></li>
            <li><?php echo l(t('Izgubljena lozinka'), array('/user/passwordReset')); ?></li>
            <li><?php echo l(t('Izgubljena lozinka'), array('/user/passwordReset')); ?></li>
            <li><?php echo l(t('Izgubljena lozinka'), array('/user/passwordReset')); ?></li>
        </ul>
    </div>
    <div class="footer-box">
        <h4><?php echo t('Prijatelji sajta'); ?></h4>
        <ul>
            <li><a href="http://www.google.com" title="spyka Webmaster resources">google</a></li>
            <li><a href="http://www.google.com" title="spyka Webmaster resources">google</a></li>
            <li><a href="http://www.google.com" title="spyka Webmaster resources">google</a></li>
            <li><a href="http://www.google.com" title="spyka Webmaster resources">google</a></li>
            <li><a href="http://www.google.com" title="spyka Webmaster resources">google</a></li>
        </ul>
   </div>
    <div class="footer-box end-footer-box">
        <h4><?php echo t('Pretraga'); ?></h4>
        <form action="#" method="get">
            <p>
                <input type="text" id="searchquery" size="18" name="searchterm" />

                <input type="submit" id="searchbutton" value="Search" class="formbutton" />
            </p>
        </form>
    </div>
    <div class="clear"></div>
</div>
<div id="footer-links">
    <p><?php echo t('Sva prava zadržana'); ?> &copy; <a href="<?php echo bu(); ?>">mojbend.rs 2012.</a></p>
</div>