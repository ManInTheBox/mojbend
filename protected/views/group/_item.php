<table>
    <tr>
        <td>
            <h4><?php echo l(e($data->name), array('/group/view', 'gid' => $data->id)); ?></h4>
        </td>
    </tr>
    <tr>
        <td>
            <a style="position: relative;" href="<?php echo $data->profilePicture->getShortPath('_large'); ?>" class="fancybox">
                <img id="profilePicture" src="<?php echo $data->profilePicture->getShortPath('_small'); ?>" alt="<?php echo e($data->name); ?>" title="<?php echo e($data->name); ?>" />
            </a>
            <div style="height: 60px; margin: 10px 0 13px 30px;">
                <a href="#" class="button small"><input id="becomeFan" type="button" value="<?php echo 'ahahah'; ?>" /></a>
                <br /><br />
                <a href="#" class="button small"><input id="joinGroup" type="button" value="<?php echo 'joinbutton'; ?>" /></a>
            </div>
        </td>
        <td style="width: 450px;">
            <strong><?php echo t('O bendu:'); ?></strong><br /><br />
            <blockquote style="min-height: 100px;">
                <?php 
                    if (strlen($data->description) > 550)
                    {
                        $data->description = e(substr($data->description, 0, 550));
                        $data->description .= '... ' . l(t('još'), array('/group/view', 'gid' => $data->id), array('id' => 'readMore'));
                    }
                    echo $data->description ?: t('Bend nije ostavio podatke.');
                ?>
            </blockquote>
        </td>
    </tr>
</table>

<?php $isOwner = false; ?>

<script type="text/javascript">
$(function () {

    $('#joinGroup').click(function(e) {

        <?php if (guest()) { ?>
            window.location = '<?php echo url('/user/login'); ?>';
        <?php } ?>

        e.preventDefault();

        <?php if ($isOwner) { ?>
        return confirm('<?php echo t('Vi ste administrator benda.\nAko ga napustite on će biti obrisan.'); ?>')
            ? $('#removeGroup').submit()
            : false;
        <?php } else { ?>
        $.ajax({
            url: '<?php echo url('/group/join'); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                CSRF_TOKEN: '<?php echo r()->getCsrfToken(); ?>',
                gid: <?php echo $data->id; ?>
            },
            success: function(res) {
                if (res.err) {
                    window.location = '<?php echo url('/user/edit'); ?>';
                }
                $('#joinGroup').val(res.msg);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
        <?php } ?>
    });

    $('#becomeFan').click(function (e) {

        <?php if (guest()) { ?>
            window.location = '<?php echo url('/user/login'); ?>';
        <?php } ?>

        e.preventDefault();
        $.ajax({
            url: '<?php echo url('/group/fan'); ?>',
            type: 'POST',
            data: {
                CSRF_TOKEN: '<?php echo r()->getCsrfToken(); ?>',
                gid: <?php echo $data->id; ?>
            },
            success: function (res) {
                $('#becomeFan').val(res);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
</script>