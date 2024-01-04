<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<div class="container">
	<div class="content">
		<?php echo $GLOBALS['layout'] == 3 ? "<!--" : "" ?>
		<h2><?php echo $classes[0]->grp_namn ?></h2>
		<?php echo $GLOBALS['layout'] == 3 ? "-->" : "" ?>

		<ul class="nav nav-pills" role="tablist">
			<?php echo $GLOBALS['layout'] == 3 ? "" : "<!--" ?>
			<li role="presentation" class="disabled"><a href=""><b><big><?php echo $classes[0]->grp_namn ?></big></b></a></li>
			<?php echo $GLOBALS['layout'] == 3 ? "" : "-->" ?>
			<?php
			if (is_array($classes[0]->grupp)) {
				echo '<li role="presentation"><a href="?overviewclass&home=' . $_GET['home'] . '&scope=' . $classes[0]->grp_nr . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . S_SAMTLIGA . '</a></li>';
				foreach ($classes[0]->grupp as $x) {
					if (empty($x->grp_nr)) {
						continue;
					}
					echo '<li role="presentation"><a href="?overviewgroup&home=' . $_GET['home'] . '&scope=' . $x->grp_nr . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . (empty($x->grp_namn) ? $x->grp_nr : $x->grp_namn) . '</a></li>';
				}
			}
			?>
			<?php echo '<li role="presentation" ' . ($classes[0]->grp_nr == $_GET['scope'] ? 'class="active"' : '') . '><a href="?overviewplayoff&home=' . $_GET['home'] . '&scope=' . $classes[0]->grp_nr . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . ($classes[0]->ant_obj_a == 99 ? S_OVRIGAMATCHER : S_SLUTSPEL) . '</a></li>' ?>
		</ul>

		<?php echo ($GLOBALS['layout'] == 3 or $classes[0]->dolj == 'true') ? "<!--" : "" ?>
		<script type="text/javascript" src="assets/js/jquery.bracket.min.js"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/jquery.bracket.min.css" />

		<div class="row">
			<div class="col-sm-12">
				<?php echo (empty($classes[0]->tree_a) or !empty($classes[0]->tree_b)) ? '' : '<h3>' . S_SLUTSPELSTRAD . '</h3>' ?>
				<?php echo (empty($classes[0]->tree_a) or empty($classes[0]->tree_b)) ? '' : '<h3>' . S_A_SLUTSPEL . '</h3>' ?>
				<div class="tree_a" style="overflow-x: auto; overflow-y: hidden;"></div>
				<script type="text/javascript">
					<?php echo $classes[0]->tree_a ?>
				</script>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<?php echo empty($classes[0]->tree_b) ? '' : '<h3>' . S_B_SLUTSPEL . '</h3>' ?>
				<div class="tree_b" style="overflow-x: auto; overflow-y: hidden;"></div>
				<script type="text/javascript">
					<?php echo $classes[0]->tree_b ?>
				</script>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<?php echo empty($classes[0]->tree_c) ? '' : '<h3>' . S_C_SLUTSPEL . '</h3>' ?>
				<div class="tree_c" style="overflow-x: auto; overflow-y: hidden;"></div>
				<script type="text/javascript">
					<?php echo $classes[0]->tree_c ?>
				</script>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<?php echo empty($classes[0]->tree_d) ? '' : '<h3>' . S_D_SLUTSPEL . '</h3>' ?>
				<div class="tree_d" style="overflow-x: auto; overflow-y: hidden;"></div>
				<script type="text/javascript">
					<?php echo $classes[0]->tree_d ?>
				</script>
			</div>
		</div>
		<?php echo ($GLOBALS['layout'] == 3 or $classes[0]->dolj == 'true') ? "-->" : "" ?>

		<?php echo $GLOBALS['layout'] == 3 ? "<!--" : "" ?>
		<h3><?php echo S_MATCHER ?></h3>
		<?php renderGames($games) ?>
		<?php echo $GLOBALS['layout'] == 3 ? "-->" : "" ?>

		<?php echo $GLOBALS['layout'] == 3 ? "" : "<!--" ?>
		<div class="table-responsive">
			<table class="table table-condensed table-striped">

				<thead>
					<tr>
						<th style="width: 4%"><?php echo S_NR ?></th>
						<th style="width: 8%"><?php echo S_GRUPP ?></th>
						<th style="width: 9%"><?php echo S_TID ?></th>
						<th style="width: 44%"><?php echo S_LAG_PLURAL ?></th>
						<th style="width: 10%"><?php echo S_RESULTAT ?></th>
						<th style="width: 15%"><?php echo S_PLATS ?></th>
						<th style="width: 10%"><?php echo S_ANM ?></th>
					</tr>
				</thead>
				<tbody>
					<?php render($games, array('view' => '_games')) ?>
				</tbody>
			</table>
		</div>
		<?php echo $GLOBALS['layout'] == 3 ? "" : "-->" ?>

	</div>
	<!-- /.content -->
</div>

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>