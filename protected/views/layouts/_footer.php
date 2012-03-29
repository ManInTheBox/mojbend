<div class="footer-content">
    <div class="footer-box">
        <h4><?php echo t('O projektu mojbend'); ?></h4>
        <p>
            <?php echo t('Projekat mojbend.rs je nastao kao želja autora da se svi muzičari okupe na jednom mestu. Ovde ćete naći sve profile muzičara i bendove sa kojima možda i zasvirate jednog dana. Lepo se provedite, pevajte i svirajte.'); ?>
        </p>
    </div>
    <div class="footer-box">
        <h4><?php echo t('Brzi linkovi'); ?></h4>
        <ul>
            <li><?php echo l(t('Bendovi'), array('/group/list')); ?></li>
            <li><?php echo l(t('Muzičari'), array('/artist/list')); ?></li>
            <li><?php echo !guest() ? l(t('Moj nalog'), array('/user/edit')) : ''; ?></li>
            <li><?php echo guest() ? l(t('Izgubljena lozinka'), array('/user/passwordReset')) : ''; ?></li>
            <li><?php echo guest() ? l(t('Uloguj se'), array('/user/login')) : l(t('Izloguj se'), array('/user/logout')); ?></li>
            <li><?php echo guest() ? l(t('Registruj se'), array('/user/register')) : ''; ?></li>
        </ul>
    </div>
    <div class="footer-box">
        <h4><?php echo t('Prijatelji sajta'); ?></h4>
        <ul>
            <li><a href="http://www.exitfest.org" target="_blank" title="Exit Festival">Exit Festival</a></li>
            <li><a href="http://www.rockexpress.org" target="_blank" title="ROCK express">ROCK express</a></li>
            <li><a href="http://nocturnemagazine.net" target="_blank" title="NOCTURNE">NOCTURNE</a></li>
            <li><a href="http://gitarijada.org" target="_blank" title="Zaječarska gitarijada">Zaječarska gitarijada</a></li>
        </ul>
   </div>
    <div class="footer-box end-footer-box">
        <h4><?php echo t('Pretraga'); ?></h4>
        <form action="<?php echo url('search'); ?>">
            <p>
                <input type="text" id="searchquery" size="18" name="term" />
                <input type="submit" id="searchbutton" value="Search" class="formbutton" />
            </p>
        </form>
    </div>
    <div class="clear"></div>
</div>
<div id="footer-links">
    <p><?php echo t('Sva prava zadržana'); ?> &copy; <a href="<?php echo bu(); ?>">mojbend.rs 2012.</a></p>
</div>

<script type="text/javascript">
    $('#searchquery').autocomplete({
        minLength: 1,
        source: '<?php echo url('search');?>',
        delay: 300,
        select: function (event, ui) {
            window.location = ui.item.location;
        }
     });
</script>