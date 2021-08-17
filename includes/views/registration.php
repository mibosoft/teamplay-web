<?php render($GLOBALS['layout'] == 2 ? '_headernomenu' : '_headercup',array('title'=>$baseInfo->bas->namn, 'settings'=>$settings, 'menuItems'=>$menuItems))?>

<div class="content">
	<h2><?php echo S_ANMALAN?></h2>
	<p><?php echo $baseInfo->bas->anmalan?></p>
    <br>
    <p><?php echo S_SISTAANMALNINGSDAG?> : <strong><?php echo $baseInfo->bas->sista_anm?></strong></p> 
    <br>
<?php echo ($GLOBALS['layout'] == 1 and !$isHttps) ? "" : "<!--" ?>
    <p><a class="btn btn-info" href="?home=<?php echo $_GET['home']; ?>&registration&form" role="button"><?php echo S_ANMALNINGSFORMULAR?></a></p>
<?php echo ($GLOBALS['layout'] == 1 and !$isHttps) ? "" : "-->" ?>
<?php echo ($GLOBALS['layout'] == 1 and $isHttps) ? "" : "<!--" ?>
    <p><a class="btn btn-info" href="<?php echo $settings[0]->string21 . '/' . $settings[0]->value21 . '/?anmalan!=' . $GLOBALS ['lang']  . '&'?>" role="button" target="_blank"><?php echo S_ANMALNINGSFORMULAR?></a></p>
<?php echo ($GLOBALS['layout'] == 1 and $isHttps) ? "" : "-->" ?>
<?php echo $GLOBALS['layout'] == 2 ? "" : "<!--" ?>
    <p><a class="btn btn-info" href="<?php echo $settings[0]->string21 . '/' . $settings[0]->value21 . '/?anmalan!=' . $GLOBALS ['lang']  . '&'?>" role="button"><?php echo S_ANMALNINGSFORMULAR?></a></p>
<?php echo $GLOBALS['layout'] == 2 ? "" : "-->" ?>
	
</div><!-- /.content -->

<?php render('_footercup',array('baseInfo'=>$baseInfo, 'settings'=>$settings))?>
    