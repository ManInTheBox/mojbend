<table>
    <tr>
        <td><?php echo (l(e($person->fullName), array('/artist/view', 'uid' => $artist->user_id))); ?></td>
    </tr>
    <tr>
        <td><?php echo $person->birth_date; ?></td>
    </tr>
</table>