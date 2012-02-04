<h1><?php echo $group->name; ?></h1>

        <?php echo l('pozovi clanove', '#', array('id' => 'inviteMembers')); ?><br />
                <?php echo l('postani clan', '#', array('id' => 'joinGroup')); ?><br />
                <?php echo l('edit', array('/group/edit', 'gid' => $group->id)); ?><br />

<script type="text/javascript">
$(function() {
    $('#inviteMembers').click(function() {
        var ids = prompt('unesi id-jeve usera');
        $.ajax({
            url: '<?php echo url('/group/inviteMembers'); ?>',
            data: {
                CSRF_TOKEN: '<?php echo r()->getCsrfToken(); ?>',
                gid: <?php echo $group->id; ?>,
                receivers: ids
            },
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }

        });

        return false;
    });

    $('#joinGroup').click(function() {
        $.ajax({
            url: '<?php echo url('/group/join'); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                CSRF_TOKEN: '<?php echo r()->getCsrfToken(); ?>',
                gid: <?php echo $group->id; ?>,
                requester: <?php echo u()->id; ?>
            },
            success: function(data) {
                console.log(data);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

});
</script>