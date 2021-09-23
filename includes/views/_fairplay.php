  <tr>
    <td><a href="?team&home=<?php echo $_GET['home']; ?>&scope=<?php echo $k->klass ?>&name=<?php echo $k->lag ?>"><?php echo $k->lag ?></a></td>
    <td><?php echo $k->klass ?></td>
    <td><?php echo $k->mtch ?></td>
    <td><b><?php echo number_format(floatval($k->pdec), 2) ?></b></td>
  </tr>