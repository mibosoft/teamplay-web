<?php render('_headercup',array('title'=>$baseInfo->bas->namn, 'settings'=>$settings, 'menuItems'=>$menuItems))?>

<div class="content">
	<h2><?php echo $title ?></h2>
<?php echo $hideNavpills ? "<!--" : "" ?>
<ul class="nav nav-pills" role="tablist">
		<li role="presentation"
			<?php echo ($_GET['scope'] == "all" ? 'class="active"' : '')?>><a
			href="?games&home=<?php echo $_GET['home']?>&scope=all&layout=<?php echo $GLOBALS['layout'];?>&lang=<?php echo $GLOBALS['lang'];?>"><?php echo S_SAMTLIGA?></a></li>
<?php
if (is_array($classes)) {
    foreach ($classes as $x) {
        echo '<li role="presentation" ' . ($x->grp_nr == $_GET['scope'] ? 'class="active"' : '') . '><a href="?games&home=' . $_GET['home'] . '&scope=' . $x->grp_nr . '&wholeclass' . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . $x->grp_nr . '</a></li>';
    }
}
?>
</ul>
<?php echo $hideNavpills ? "-->" : "" ?>
<p class="pull-right"><?php echo S_ANTAL?>: <span class="badge"><?php echo $count ?></span>
	</p>
	<br>

<?php renderGames($games)?>

</div>
<!-- /.content -->

<?php render('_footercup',array('baseInfo'=>$baseInfo, 'settings'=>$settings))?>
