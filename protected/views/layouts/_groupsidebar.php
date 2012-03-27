<ul>
    <li>
        <h4><span><?php echo t('Najaktivniji'); ?> <strong><?php echo t('bendovi'); ?></strong></span></h4>
        <ul class="blocklist">
            <?php foreach ($this->sidebarData as $group) { ?>
            <li>
                <p style="margin: 0;">
                    <?php echo l(e($group->name), array('/group/view', 'gid' => $group->id)); ?>
                </p>
            </li>
            <?php } ?>
        </ul>
    </li>
</ul>