<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<div class="container">
	<div class="content">
		<p><?php echo $page[0]->innehall ?></p>
	</div><!-- /.content -->
</div>

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>