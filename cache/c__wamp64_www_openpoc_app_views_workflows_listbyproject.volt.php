<table class="ui celled striped table">
<thead>
    <tr>
        <th class="five wide">NAME</th>
        <th class="nine wide">DESCRIPTION</th>
        <th></th>
    </tr>
</thead>
<tbody>

    <?php $v23797459601iterated = false; ?><?php foreach ($workflows as $workflow) { ?><?php $v23797459601iterated = true; ?>
    <tr>
        <td><?= $workflow->name ?></td>
        <td><?= $workflow->description ?></td>
        <td>
            <a class="ui icon" data-tooltip="Edit" data-position="bottom center" onclick="editWorkflow(<?= $workflow->id ?>);">
                <i class="edit icon"></i>
            </a>
            <a class="ui icon" data-tooltip="Move" data-position="bottom center">
                <i class="move icon"></i>
            </a>
            <a class="ui icon" onclick="del('<?= $workflow->id ?>', '<?= $workflow->name ?>'); return false;" data-tooltip="Delete" data-position="bottom center">
                <i class="remove red icon"></i>
            </a>                                                       
        </td>
    </tr> 
    <?php } if (!$v23797459601iterated) { ?>
        <tr>
            <td>No workflows to show...</td>
        </tr> 
    <?php } ?>
</tbody>
</table>