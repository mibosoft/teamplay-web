  <tr>
    <td style="vertical-align:middle"><?php echo ($settings[0]->bool21 == "false" or empty($k->lkod)) ? '' : '<img src="assets/images/flags_iso/16/' . $k->lkod . '.png"/> ' ?><a href="?team&home=<?php echo $_GET['home']; ?>&scope=<?php echo $k->klass ?>&name=<?php echo urlencode($k->klubb) ?>&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo ($k->reserv == "true") ? "*" : "" ?><?php echo (intval($k->tavl_bet) + intval($k->erlagt1) + intval($k->erlagt2) > 0 and $settings[0]->bool23 == "true") ? "<b>" : "" ?><?php echo $k->klubb ?><?php echo (intval($k->tavl_bet) + intval($k->erlagt1) + intval($k->erlagt2) > 0 and $settings[0]->bool23 == "true") ? "</b>" : "" ?></a></td>
    <td style="vertical-align:middle"><?php echo empty($k->logo) ? '&nbsp;' : '<p align="center"><img src="' . $GLOBALS['baseUrl'] . $_GET['home'] . '/' . $k->logo . '" width="100" height="100"></p>' ?></td>
    <td style="vertical-align:middle"><a href="?overviewclass&home=<?php echo $_GET['home']; ?>&scope=<?php echo $k->klass ?>&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo $k->klass ?></a></td>
    <?php echo ($settings[0]->bool15 == "true") ? "<!--" : "" ?>
    <td style="vertical-align:middle"><?php echo $k->drakt ?></td>
    <?php echo ($settings[0]->bool15) == "true" ? "-->" : "" ?>
    <td style="vertical-align:middle; text-align:right"><?php echo $k->url == "" ? "" : '<a href="http://' . $k->url . '" target="_blank"><span class="glyphicon glyphicon-home"></span></a>' ?></td>
  </tr>