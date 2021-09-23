<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<div class="content">
  <h2><?php echo S_INFORMATION ?></h2>
  <?php echo $baseInfo->bas->info == "" ? "" : "<!--" ?>
  <div class="alert alert-success" role="alert">
    <?php echo S_CUPSIDAINFO ?> <a href="<?php echo $baseInfo->bas->url ?>" target="_blank"><?php echo S_OFFCUPSIDA ?></a>.
  </div>
  <?php echo $baseInfo->bas->info == "" ? "" : "-->" ?>
  <p><?php echo $baseInfo->bas->cupinfo ?></p>
  <br>
  <?php echo $settings[0]->bool6 == 'true' ? '<a class="btn btn-info" href="?home=' . $_GET['home'] . '&layout=1&mapoverview" role="button">' . S_OVERSIKTSKARTA . '</a>' : ""; ?>

</div><!-- /.content -->

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>