<tr>
  <td><?php echo $k->lag ?></td>
  <td><?php echo $k->omg ?></td>
  <td><?php echo $k->v ?></td>
  <td><?php echo $k->o ?><?php echo $baseInfo->bas->visa_oav == 'true' ? ' (' . $k->flv . ')' : '' ?></td>
  <td><?php echo $k->f ?></td>
  <td><?php echo $k->pmal ?>-<?php echo $k->mmal ?> (<?php echo (intval($k->pmal) - intval($k->mmal)) ?>)</td>
  <td><?php echo $k->p ?></td>
</tr>