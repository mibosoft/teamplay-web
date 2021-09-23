  <tr>
      <td><a href="?team&home=<?php echo $_GET['home']; ?>&scope=<?php echo $k->grp_nr ?>&name=<?php echo $k->lag ?>&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo $k->lag ?></a></td>
      <td><?php echo $k->grp_nr ?></td>
      <td><?php echo $k->ant_mtch ?></td>
      <td><?php echo $k->vinster ?></td>
      <td><?php echo $k->oavgjorda ?></td>
      <td><?php echo $k->forluster ?></td>
      <td><b><?php echo $k->plusmal ?></b> (<?php echo intval($k->plusmal) - intval($k->minusmal) ?>)</td>
      <?php echo ($baseInfo->bas->st_utv == 'true' and $baseInfo->bas->prot_typ == '1' or $settings[0]->value7 == "0") ? "" : "<!--" ?>
      <td style="text-align:center"><b><?php echo ($k->powerp_t == 0 ? 0 : round(($k->powerp_m / $k->powerp_t) * 100)) ?>%</b> (<?php echo ($k->powerp_m . '/' . $k->powerp_t) ?>)</td>
      <td style="text-align:center"><b><?php echo ($k->boxp_t == 0 ? 0 : 100 - round(($k->boxp_m / $k->boxp_t) * 100)) ?>%</b> (<?php echo ($k->boxp_m . '/' . $k->boxp_t) ?>)</td>
      <?php echo ($baseInfo->bas->st_utv == 'true' and $baseInfo->bas->prot_typ == '1' or $settings[0]->value7 == "0") ? "" : "-->" ?>
      <?php echo ($baseInfo->bas->st_gulkort == 'true' or $settings[0]->value7 == "0") ? "" : "<!--" ?>
      <td style="text-align:center"><?php echo $k->gultkort ?></td>
      <?php echo ($baseInfo->bas->st_gulkort == 'true' or $settings[0]->value7 == "0") ? "" : "-->" ?>
      <?php echo ($baseInfo->bas->st_rodkort == 'true' or $settings[0]->value7 == "0") ? "" : "<!--" ?>
      <td style="text-align:center"><?php echo $k->rottkort ?></td>
      <?php echo ($baseInfo->bas->st_rodkort == 'true' or $settings[0]->value7 == "0") ? "" : "-->" ?>
  </tr>