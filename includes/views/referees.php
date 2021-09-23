<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<div class="content">
	<h2><?php echo S_DOMARE ?></h2>

	<div class="table-responsive">
		<table class="table table-condensed table-striped">
			<thead>
				<tr>
					<th><?php echo S_NAMN ?></th>
					<th><?php echo S_KATEGORI ?></th>
					<th><?php echo S_FORENING_DISTRIKT ?></th>
				</tr>
			</thead>
			<tbody>
				<?php render($referees, array('view' => '_referees', 'settings' => $settings)) ?>
			</tbody>
		</table>
	</div>

</div><!-- /.content -->

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>