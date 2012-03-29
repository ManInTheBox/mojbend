<?php $this->renderFlash(); ?>

<div class="box">
    <h2><?php echo t('Dobrodošli na Moj Bend'); ?></h2>
    <br />
    <p>
        <?php echo t('Moj bend je sajt na kome se možete registrovati kao muzičar i pronaći bendove'); ?>.<br />
        <?php echo t('Ovde možete steći nova poznanstva i upoznati zanimljive ljude. Pretražite našu bazu podataka ne bi ste li pronašli ono što baš vama treba.'); ?>
        <?php echo t('Pregledajte sve muzičare i bendove koji su registrovani na sajtu.'); ?><br /><br />
        <img style="border: 10px solid #eaeaea;" src="<?php echo bu(); ?>/css/images/splash.jpg" width="600" height="300" />
    </p>
    <p>
        <?php echo t('Želite da postanete član sajta mojbend.rs?'); ?><br />
        <?php echo t('Ne oklevajte više već se odmah registrujte i popunite vaš umetnički profil. Svakog dana hiljade i hiljade profesionalnih muzičara se registruje. Budite baš Vi jedan od poznatih muzičara.'); ?><br />
    </p>
    <p style="padding: 20px 0 0 40px;" class="frontpage-button"><a href="<?php echo url('/user/register'); ?>"><?php echo t('Registruj se odmah'); ?></a></p>
</div>