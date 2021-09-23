<?php render($GLOBALS['layout'] == 2 ? '_headernomenu' : '_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<?php echo empty($pageTitle) ? '' : '<h2>' . $pageTitle . '</h2>' ?>

<div class="content">
  <iframe width="100%" height="<?php echo $height ?>" frameborder="0" onload="scroll(0,0);" src="<?php echo $url ?>"></iframe>
</div><!-- /.content -->

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>