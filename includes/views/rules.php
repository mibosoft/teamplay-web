<?php render('_headercup',array('title'=>$baseInfo->bas->namn, 'settings'=>$settings, 'menuItems'=>$menuItems))?>

<div class="content">
	<h2><?php echo S_REGLER?></h2>
	<p><?php echo $baseInfo->bas->regler?></p>
</div><!-- /.content -->

<?php render('_footercup',array('baseInfo'=>$baseInfo, 'settings'=>$settings))?>
    