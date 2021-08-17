<?php
if ($settings[0]->value14 == "1" and count ( $k->grupp ) > 0){
  echo '<h3><a href="?overviewclass&home=' . $_GET['home'] . '&scope=' . $k->grp_nr . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . $k->grp_nr . ' - ' . $k->grp_namn . '</a></h3>';
  echo '<div class="row">';
    foreach($k->grupp as $obj) {
      if (empty($obj->grp_nr)){
          continue;
      }
      echo '<div class="col-sm-6 col-md-3"><div class="well well-sm">';
      echo '<a href="?overviewgroup&home=' . $_GET ['home'] . '&scope=' . $obj->grp_nr . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . '<h4>' . $obj->grp_namn . '</h4></a>';
	    foreach($obj->lag as $lag) {
	        if (empty($lag->namn)){
	            continue;
	        }
	        $teamName = $lag->namn;
	      if ($settings[0]->bool21 == "true" and !empty(trim($lag->lkod))){
	        $countryCode=$lag->lkod;
	        echo '<img src="assets/images/flags_iso/16/' . $countryCode . '.png"/> ';
	      }
	    echo '<a href="?team&home=' . $_GET ['home'] . '&scope=' . $obj->grp_nr . '&name=' . $teamName . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . $teamName . '</a><br>';
	}
		echo '</div></div>';
  }
  echo '</div>';
}else{
  echo '<div class="row">';
  echo '<div class="col-sm-6 col-md-4"><div class="well well-sm">';
  echo '<h4><a href="?overviewclass&home=' . $_GET['home'] . '&scope=' . $k->grp_nr . '&layout=' . $GLOBALS['layout'] . '">' . $k->grp_nr . ' - ' . $k->grp_namn . '</a></h4>';
  echo '</div></div></div>';
}
?>
