<ul>
    <li>
        <h4><span><?php echo t('Najaktivniji'); ?> <strong><?php echo t('muzičari'); ?></strong></span></h4>
        <ul class="blocklist">
            <?php foreach ($this->sidebarData as $artist) { ?>
            <li>
                <p style="margin: 0;">
                    <?php echo l(e($artist->user->person->fullName), $artist->url); ?>
                </p>
            </li>
            <?php } ?>
        </ul>
    </li>
</ul>