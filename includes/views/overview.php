<?php render('_headercup',array('title'=>$baseInfo->bas->namn, 'settings'=>$settings, 'menuItems'=>$menuItems))?>

<div class="content">
<h2><?php echo S_KLASSER?> / <?php echo S_GRUPPER?></h2>

<?php render($classes,array ('view' => '_overview', 'settings'=>$settings))?>

</div><!-- /.content -->

<?php render('_footercup',array('baseInfo'=>$baseInfo, 'settings'=>$settings))?>

