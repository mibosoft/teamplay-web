<?php render('_headercup',array('title'=>$baseInfo->bas->namn, 'settings'=>$settings, 'menuItems'=>$menuItems))?>

<div class="content">
<h2><?php echo ($settings[0]->bool21 == "false" or empty($team[0]->lkod)) ? '' : '<img src="assets/images/flags_iso/32/' . $team[0]->lkod . '.png" style="vertical-align: text-top;"/> '?><?php echo $title?></h2>

<h3><?php echo S_OVERSIKT?></h3>

<div class="table-responsive">
<table class="table table-condensed table-striped">

	<thead>
	<tr>
        <th><?php echo S_KLUBB?></th>
        <th>&nbsp;</th>
        <th><?php echo S_KLASS?></th>
<?php echo $settings[0]->bool15 == "true" ? "<!--" : "" ?>
        <th><?php echo S_DRAKTFARG?></th>
<?php echo $settings[0]->bool15 == "true" ? "-->" : "" ?>
        <th style="text-align:right"><?php echo S_HEMSIDA?></th>
    </tr>
	</thead>
	<tbody>
      <?php render($team,array ('view' => '_teams', 'settings'=>$settings))?>
	</tbody>
	</table>
</div>
<hr>

<?php echo (empty($players) or $settings[0]->value4 == "0") ? "<!--" : "" ?>
<h3><?php echo S_SPELARE?></h3>
<div class="table-responsive">
<table class="table table-condensed table-striped">
	<thead>
	<tr>
<?php echo $settings[0]->bool2 == "true" ? "<!--" : "" ?>
        <th><?php echo S_TROJNR?></th>
<?php echo $settings[0]->bool2 == "true" ? "-->" : "" ?>
        <th><?php echo S_NAMN?></th>
        <th><?php echo S_FODD?></th>
<?php echo $settings[0]->bool2 == "true" ? "<!--" : "" ?>
        <th><?php echo S_POSITION?></th>
<?php echo $settings[0]->bool2 == "true" ? "-->" : "" ?>
    </tr>
	</thead>
	<tbody>
		<?php render($players,array ('view' => '_players', 'settings'=>$settings))?>
	</tbody>
	</table>
</div>
<?php echo (empty($players) or $settings[0]->value4 == "0") ? "-->" : "" ?>

<?php echo empty($leaders) ? "<!--" : "" ?>
<h3><?php echo S_LEDARE?></h3>
<div class="table-responsive">
<table class="table table-condensed table-striped">

	<thead>
	<tr>
        <th><?php echo S_NAMN?></th>
        <th><?php echo S_FUNKTION?></th>
    </tr>
	</thead>
	<tbody>
		<?php render($leaders,array ('view' => '_leaders'))?>
	</tbody>
	</table>
</div>
<?php echo empty($leaders) ? "-->" : "" ?>

<h3><?php echo S_MATCHER?></h3>
<?php renderGames($games)?>


</div><!-- /.content -->

<?php render('_footercup',array('baseInfo'=>$baseInfo, 'settings'=>$settings))?>

