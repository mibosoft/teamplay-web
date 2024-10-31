  <tr>
      <td><?php echo $k->spelare ?></td>
      <td><a href="?playerstat&home=<?php echo $_GET['home']; ?>&scope=<?php echo $k->grp_nr ?>&sort=<?php echo $_GET['sort']; ?>&team=<?php echo urlencode($k->klubb) ?>&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo $k->klubb ?></a></td>
      <td><?php echo $k->grp_nr ?></td>
      <td><?php echo $k->ant_mtch ?></td>
      <td><b><?php echo $k->plusmal ?></b>  (<?php echo intval($k->plusmal) - intval($k->minusmal) ?>)</td>
      <td><i><?php echo number_format(intval($k->plusmal) / intval($k->ant_mtch), 2) ?></i></td>
  </tr>