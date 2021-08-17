<?php render('_headercup',array('title'=>$baseInfo->bas->namn, 'settings'=>$settings, 'menuItems'=>$menuItems))?>

<div class="content">
<h2><?php echo S_SPELPLATSER?></h2>

<div class="table-responsive">
<table class="table table-condensed table-striped">
	<thead>
	<tr>
        <th><?php echo S_NAMN?></th>
        <th><?php echo S_KATEGORI?></th>
    </tr>
	</thead>
	<tbody>
      <?php render($arenas,array ('view' => '_arenas'))?>
	</tbody>
	</table>
</div>

</div><!-- /.content -->
	
<?php render('_footercup',array('baseInfo'=>$baseInfo, 'settings'=>$settings))?>

