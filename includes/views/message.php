<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<div class="container">
    <p><?php echo $message ?></p>

    <p><button class="btn btn-info" onclick="javascript:history.back(1)" name="back" data-icon="back"><?php echo S_TILLBAKA ?></button></p>

</div>

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>