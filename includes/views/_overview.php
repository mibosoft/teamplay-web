<?php
if ($settings[0]->value14 == "1" and count($k->grupp) > 0) {
  echo '<div class="mb-6 flex items-center justify-between gap-3">';
  echo '<h3 class="m-0 text-xl font-bold text-slate-800"><a class="text-slate-800 hover:text-sky-700" href="?overviewclass&home=' . $_GET['home'] . '&scope=' . $k->grp_nr . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . $k->grp_nr . ' - ' . $k->grp_namn . '</a></h3>';
  echo '</div>';
  echo '<div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">';
  foreach ($k->grupp as $obj) {
    if (empty($obj->grp_nr)) {
      continue;
    }
    echo '<article class="tp-card p-4">';
    echo '<h4 class="mb-3 text-base font-bold text-slate-800"><a class="hover:text-sky-700" href="?overviewgroup&home=' . $_GET['home'] . '&scope=' . $obj->grp_nr . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . $obj->grp_namn . '</a></h4>';
    echo '<div class="space-y-2">';
    foreach ($obj->lag as $lag) {
      if (empty($lag->namn)) {
        continue;
      }
      $teamName = $lag->namn;
      echo '<div class="flex items-center gap-2 text-sm text-slate-700">';
      if ($settings[0]->bool21 == "true" and !empty(trim($lag->lkod))) {
        $countryCode = $lag->lkod;
        echo '<img src="assets/images/flags_iso/16/' . $countryCode . '.png" class="h-4 w-4" alt="Country flag" />';
      }
      echo '<a class="hover:text-sky-700" href="?team&home=' . $_GET['home'] . '&scope=' . $obj->grp_nr . '&name=' . $teamName . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . $teamName . '</a>';
      echo '</div>';
    }
    echo '</div>';
    echo '</article>';
  }
  echo '</div>';
} else {
  echo '<div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">';
  echo '<article class="tp-card p-4">';
  echo '<h4 class="m-0 text-base font-bold text-slate-800"><a class="hover:text-sky-700" href="?overviewclass&home=' . $_GET['home'] . '&scope=' . $k->grp_nr . '&layout=' . $GLOBALS['layout'] . '">' . $k->grp_nr . ' - ' . $k->grp_namn . '</a></h4>';
  echo '</article>';
  echo '</div>';
}
