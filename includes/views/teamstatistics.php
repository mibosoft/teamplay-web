<?php render('_headercup',array('title'=>$baseInfo->bas->namn, 'settings'=>$settings, 'menuItems'=>$menuItems))?>

<div class="content">

	<h2><?php echo S_ANTALLAGPERKLASS?></h2>
	<div class="row text-left">
		<div id="columnchart-container" class="col-md-12"></div>
	</div>
	<script type="text/javascript"
		src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">

// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.

$(window).resize(function () {
	drawChart();
});

function drawChart() {

// Create the data table.
var data = new google.visualization.DataTable();
data.addColumn('string', '');
data.addColumn('number', '<?php echo S_ANTAL?>');
data.addColumn({type: 'number', role: 'annotation'});
data.addRows([
<?php
if (is_array($teams)) {
  if (is_array($classes)) {
    foreach ($classes as $x) {
        $teamsPerClass = array_count_values(array_column($teams, 'klass'))[$x->grp_nr];
        $teamsPerClass = (empty($teamsPerClass) ? '0' : $teamsPerClass); // In case zero teams, change from '' to '0'
        echo '["' . $x->grp_nr . '",' . $teamsPerClass . ',' . $teamsPerClass . '],';
    }
  }
}
?>
]);

// Set chart options
var options = {
		'height':250,
		'width':'100%',
		vAxis: {
			format: '0',
	        viewWindow: {min:0}
		},
		legend: { position: 'none' },
        chartArea: {
	            left: 20,
	            top: "3%",
	            height: "80%",
	            width: "100%"
        },
		colors: ['LightGreen'],
		};

// Instantiate and draw our chart, passing in some options.
var chart = new google.visualization.ColumnChart(document.getElementById('columnchart-container'));
chart.draw(data, options);
}
</script>

<?php echo $settings[0]->value7 == "1" ? "" : "<!--"; ?>
<h2><?php echo S_LAGSTATISTIK?></h2>

	<ul class="nav nav-pills" role="tablist">
		<li role="presentation"
			<?php echo ($_GET['scope'] == "all" ? 'class="active"' : '')?>><a
			href="?teamstat&home=<?php echo $_GET['home']?>&scope=all&layout=<?php echo $GLOBALS['layout'];?>&lang=<?php echo $GLOBALS['lang'];?>"><?php echo S_SAMTLIGA?></a></li>
  <?php
if (is_array($classes)) {
    foreach ($classes as $x) {
        echo '<li role="presentation" ' . ($x->grp_nr == $_GET['scope'] ? 'class="active"' : '') . '><a href="?teamstat&home=' . $_GET['home'] . '&scope=' . $x->grp_nr . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . $x->grp_nr . '</a></li>';
    }
}
?>
</ul>
	<br>
	<div class="table-responsive">

		<table class="table table-condensed table-striped">
			<thead>
				<tr>
					<th><?php echo S_LAG?></th>
					<th><?php echo S_KLASS?></th>
					<th title="<?php echo S_ANTALSPELADEMATCHERGAMESPLAYED?>"><?php echo S_GP?></th>
					<th><?php echo S_VI?></th>
					<th><?php echo S_OA?></th>
					<th><?php echo S_FO?></th>
					<th><?php echo S_MAL?></th>
<?php echo ($baseInfo->bas->st_utv == 'true' and $baseInfo->bas->prot_typ == '1' or $settings[0]->value7 == "0") ? "" : "<!--" ?>
        <th style="text-align: center"><?php echo S_POWERPLAY?></th>
					<th style="text-align: center"><?php echo S_BOXPLAY?></th>
<?php echo ($baseInfo->bas->st_utv == 'true' and $baseInfo->bas->prot_typ == '1' or $settings[0]->value7 == "0") ? "" : "-->" ?>
<?php echo ($baseInfo->bas->st_gulkort == 'true' or $settings[0]->value7 == "0") ? "" : "<!--" ?>
        <th style="text-align: center"><?php echo S_GULAKORT?></th>
<?php echo ($baseInfo->bas->st_gulkort == 'true' or $settings[0]->value7 == "0") ? "" : "-->" ?>
<?php echo ($baseInfo->bas->st_rodkort == 'true' or $settings[0]->value7 == "0") ? "" : "<!--" ?>
        <th style="text-align: center"><?php echo S_RODAKORT?></th>
<?php echo ($baseInfo->bas->st_rodkort == 'true' or $settings[0]->value7 == "0") ? "" : "-->" ?>
    </tr>
			</thead>
			<tbody>
      <?php render($teamstat,array ('view' => '_teamstat', 'baseInfo'=>$baseInfo, 'settings'=>$settings))?>
	</tbody>
		</table>
	</div>
	<small><i>
	<?php echo S_GP?>=<?php echo S_ANTALSPELADEMATCHERGAMESPLAYED?>, 
	<?php echo S_VI?>=<?php echo S_VINSTER?>, 
	<?php echo S_OA?>=<?php echo S_OAVGJORDA?>, 
	<?php echo S_FO?>=<?php echo S_FORLUSTER?> 
	</i></small>
	
<?php echo $settings[0]->value7 == "1" ? "" : "-->"; ?>

</div>
<!-- /.content -->

<?php render('_footercup',array('baseInfo'=>$baseInfo, 'settings'=>$settings))?>

