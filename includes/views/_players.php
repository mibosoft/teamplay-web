    <tr>
<?php echo $settings[0]->bool2 == "true" ? "<!--" : "" ?>
        <td><?php echo $k->spe_nr?></td>
<?php echo $settings[0]->bool2 == "true" ? "-->" : "" ?>
        <td><?php echo $k->medlem?></td>
        <td><?php echo substr($k->personnr,0,4)?></td>
<?php echo $settings[0]->bool2 == "true" ? "<!--" : "" ?>
        <td><?php echo $k->position?></td>
<?php echo $settings[0]->bool2 == "true" ? "-->" : "" ?>
    </tr>
