<?php render('_headercup',array('title'=>$baseInfo->bas->namn, 'settings'=>$settings, 'menuItems'=>$menuItems))?>

<div class="content">

<h2><?php echo S_FAIRPLAY?></h2>
<p><?php echo $baseInfo->bas->fplay?></p>

<?php echo empty($baseInfo->bas->fplay) ? "<!--" : "" ?>
<H3><?php echo S_TABELL?></H3>
<?php echo empty($baseInfo->bas->fplay) ? "-->" : "" ?>

<ul class="nav nav-pills" role="tablist">
  <li role="presentation" <?php echo ($_GET['scope'] == "all" ? 'class="active"' : '')?>><a href="?fairplay&home=<?php echo $_GET['home']?>&scope=all"><?php echo S_SAMTLIGA?></a></li>
  <?php foreach ( $classes as $x ) {
    echo '<li role="presentation" ' . ($x->grp_nr==$_GET['scope'] ? 'class="active"' : '') . '><a href="?fairplay&home='. $_GET['home'] . '&scope=' . $x->grp_nr . '">' . $x->grp_nr . '</a></li>';
  }?>
</ul>
<br>
<p><?php echo S_FAIRPLAY_INTRO_1 . " " . S_FAIRPLAY_INTRO_2 . " " . S_FAIRPLAY_INTRO_3 . " " . S_FAIRPLAY_INTRO_4?></p>

<div class="table-responsive">

<table class="table table-condensed table-striped">
	<thead>
	<tr>
        <th><?php echo S_LAG?></th>
        <th><?php echo S_KLASS?></th>
        <th><?php echo S_MATCHER?></th>
        <th><?php echo S_POANG?></th>
    </tr>
	</thead>
	<tbody>
      <?php render($fairplay,array ('view' => '_fairplay'))?>
	</tbody>
	</table>
</div>	

<br>
<p>
<small>
<b><a name="bedomningsskala" id="bedomningsskala"></a><?php echo S_BEDOMNINGSSKALA?> 1-5</b>
<ol>
  <li><b><?php echo S_FAIRPLAY_1?></b> - <?php echo S_FAIRPLAY_1_DETAIL?></li> 
  <li><b><?php echo S_FAIRPLAY_2?></b> - <?php echo S_FAIRPLAY_2_DETAIL?></li> 
  <li><b><?php echo S_FAIRPLAY_3?></b> - <?php echo S_FAIRPLAY_3_DETAIL?></li> 
  <li><b><?php echo S_FAIRPLAY_4?></b> - <?php echo S_FAIRPLAY_4_DETAIL?></li> 
  <li><b><?php echo S_FAIRPLAY_5?></b> - <?php echo S_FAIRPLAY_5_DETAIL?></li> 
</ol>
</small>
</p>	
<br>

</div><!-- /.content -->

<?php render('_footercup',array('baseInfo'=>$baseInfo, 'settings'=>$settings))?>

