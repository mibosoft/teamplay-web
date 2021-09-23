<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<p><?php echo $message ?></p>

<p><button class="btn btn-info" onclick="javascript:history.back(1)" name="back" data-icon="back"><?php echo S_TILLBAKA ?></button></p>

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>