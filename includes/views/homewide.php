<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<style>
  body {
    padding-top: <?php echo empty($settings[0]->pic_name_1) ? "70" : "0" ?>px;
  }

  #moreinfo {
    scroll-margin-top: 90px;
  }

  .jumbotron {
    position: relative;
    width: 100vw;
    height: 100vh;
    overflow: hidden;
  }

  .jumbotron .container {
    position: absolute;
    left: 50% !important;
    z-index: 10;
    color: #<?php echo $settings[0]->string13 ?>;
    text-align: center;
    top: 50% !important;
    transform: translate(-50%, -50%);
    width: fit-content;
    padding: 5px
  }

  .jumbotron:after {
    content: "";
    position: absolute;
    z-index: 1;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("<?php echo $GLOBALS['baseUrl'] . $_GET['home'] . '/' . $settings[0]->pic_name_1 ?>") no-repeat center center;
    background-size: cover;
    background-repeat: no-repeat;
    filter: blur(5.5px);
    transform: scale(1.0);
  }
</style>

<?php echo empty($settings[0]->pic_name_1) ? "<!--" : "" ?>
<div class="jumbotron d-flex justify-content-center">
  <div class="container">
    <p><?php echo $settings[0]->memo1 ?></p>
    <h3>
      <?php echo (date("Y-m-d") <= $baseInfo->bas->start_dat) ? '<span class="label label-default">' . howManyDays(date("Y-m-d"), $baseInfo->bas->start_dat) . "</span> " . S_DAGARKVAR : "" ?>
    </h3>
    <br>
    <p>
      <a class="btn btn-default btn-lg" href="?home=<?php echo $_GET['home']; ?>&layout=1#moreinfo" role="button"><?php echo S_MERAINFORMATION ?></a>&nbsp
      <?php echo $settings[0]->value27 == "1" ? '<a class="btn btn-default btn-lg" href="?home=' . $_GET['home'] . '&layout=1&registration" role="button">' . S_ANMALAN . '</a>' : ""; ?>
    </p>
  </div>
</div>
<?php echo empty($settings[0]->pic_name_1) ? "-->" : "" ?>

<div class="container">
  <div class="col-md-12" align="center">
    <table>
      <tr>
        <td align="center">
          <a href="?layout=1&home=<?php echo $_GET['home']; ?>&lang=swe" class="menu_link"><img src="assets/images//flags_iso/24/se.png" border="0" align="middle"></a>
          <a href="?layout=1&home=<?php echo $_GET['home']; ?>&lang=eng" class="menu_link"><img src="assets/images/flags_iso/24/gb.png" border="0" align="middle"></a>
          <a href="?layout=1&home=<?php echo $_GET['home']; ?>&lang=fin" class="menu_link"><img src="assets/images//flags_iso/24/fi.png" border="0" align="middle"></a>
          <a href="?layout=1&home=<?php echo $_GET['home']; ?>&lang=nor" class="menu_link"><img src="assets/images//flags_iso/24/no.png" border="0" align="middle"></a>
          <a href="?layout=1&home=<?php echo $_GET['home']; ?>&lang=cze" class="menu_link"><img src="assets/images//flags_iso/24/cz.png" border="0" align="middle"></a>
          <a href="?layout=1&home=<?php echo $_GET['home']; ?>&lang=pol" class="menu_link"><img src="assets/images//flags_iso/24/pl.png" border="0" align="middle"></a>
        </td>
      </tr>
    </table>
  </div>
</div>

<div id="moreinfo"></div>
<div class="container">
  <div class="row">
    <div class="<?php echo $baseInfo->bas->sidokol == "" ? "col-md-12" : "col-md-10" ?>">
      <?php echo $baseInfo->bas->info == "" ? "<!--" : "" ?>
      <h3></h3>
      <p><?php echo $baseInfo->bas->info ?></p>
      <br>
      <?php echo $baseInfo->bas->info == "" ? "-->" : "" ?>

      <?php echo $baseInfo->bas->info == "" ? "" : "<!--" ?>
      <div class="alert alert-success" role="alert">
        <?php echo S_CUPSIDAINFO ?> <a href="<?php echo $baseInfo->bas->url ?>" target="_blank"><?php echo S_OFFCUPSIDA ?></a>.
      </div>
      <?php echo $baseInfo->bas->info == "" ? "" : "-->" ?>
    </div> <!-- /basinfo-col -->

    <?php echo $baseInfo->bas->sidokol == "" ? "<!--" : "" ?>
    <div class="col-md-2">
      <p><?php echo $baseInfo->bas->sidokol ?></p>
    </div>
    <?php echo $baseInfo->bas->sidokol == "" ? "-->" : "" ?>
  </div> <!-- /basinfo-row -->
</div> <!-- /basinfo-container -->

<?php echo ($baseInfo->bas->info == "" or $settings[0]->value24 == 0) ? "<!--" : "" ?>
<div class="container">
  <div class="row">
    <?php $i = 0;
    if (is_array($news)) {
      echo '<hr>';
      foreach ($news as $x) {
        if ($i >= $settings[0]->value24) {
          continue;
        }
        $i++;
        echo '<div class="col-xs-6 col-lg-4' . ($i % 2 == 0 ? '">' : ' ">');
        echo '<h2>' . $x->rubrik . '</h2>';
        echo '<p><small>' . str_replace('T', ' ', $x->datumtid) . '</small></p>';
        echo $x->sammanf;
        echo empty($x->mer_info) ? '' : '<p><a href="?news&home=' . $_GET['home'] . '#' . $x->datumtid . '"> ' . S_LASMER . '</a></p>';
        echo '<hr>';
        echo '</div>';
      }
    }
    if (count($news) > $i) {
      echo '<p><a class="btn btn-info" href="?news&home=' . $_GET['home'] . '" role="button">' . S_ALLANYHETER . '</a></p><br>';
    }
    ?>
  </div>
</div>

<?php echo ($baseInfo->bas->info == "" or $settings[0]->value24 == 0) ? "-->" : "" ?>

<!--/row-->

<br>
<script type='text/javascript' src='assets/js/randompicture.js'></script>
<?php
$i = 2;
$noPics = true;
$firstPic = true;
for ($i == 2; $i <= 16; $i++) {
  $adNamePointer = 'pic_name_' . strval($i);
  $adUrlPointer = 'pic_url_' . strval($i);
  if (!empty($settings[0]->{$adNamePointer})) {
    if ($firstPic) {
      echo '<div id="pic-group">';
      $noPics = false;
      $firstPic = false;
    }
    echo '<a href="' . $settings[0]->{$adUrlPointer} . '" target="_blank"><img src="' . $GLOBALS['baseUrl'] . $_GET['home'] . '/' . $settings[0]->{$adNamePointer} . '" border="0"></a>';
  }
}
if (!$noPics) {
  echo '</div>';
} ?>

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>