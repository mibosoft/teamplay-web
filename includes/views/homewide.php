<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>
<div class="row row-offcanvas row-offcanvas-right">
  <div class="col-xs-12 col-sm-9">

    <?php echo empty($settings[0]->pic_name_1) ? "<!--" : "" ?>
    <div id="topCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#topCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#topCarousel" data-slide-to="1" <?php echo empty($settings[0]->pic_name_17) ? 'style="display:none"' : "" ?>></li>
        <li data-target="#topCarousel" data-slide-to="2" <?php echo empty($settings[0]->pic_name_18) ? 'style="display:none"' : "" ?>></li>
        <li data-target="#topCarousel" data-slide-to="3" <?php echo empty($settings[0]->pic_name_19) ? 'style="display:none"' : "" ?>></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="<?php echo $GLOBALS['baseUrl'] . $_GET['home'] . '/' . $settings[0]->pic_name_1 ?>" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <?php echo $settings[0]->memo1 ?>
            </div>
          </div>
        </div>
        <?php echo empty($settings[0]->pic_name_1) ? "-->" : "" ?>
        <?php echo (empty($settings[0]->pic_name_1) or empty($settings[0]->pic_name_17)) ? "<!--" : "" ?>
        <div class="item">
          <img class="second-slide" src="<?php echo $GLOBALS['baseUrl'] . $_GET['home'] . '/' . $settings[0]->pic_name_17 ?>" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <?php echo $settings[0]->memo17 ?>
            </div>
          </div>
        </div>
        <?php echo (empty($settings[0]->pic_name_1) or empty($settings[0]->pic_name_17)) ? "-->" : "" ?>
        <?php echo (empty($settings[0]->pic_name_1) or empty($settings[0]->pic_name_18)) ? "<!--" : "" ?>
        <div class="item">
          <img class="third-slide" src="<?php echo $GLOBALS['baseUrl'] . $_GET['home'] . '/' . $settings[0]->pic_name_18 ?>" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <?php echo $settings[0]->memo18 ?>
            </div>
          </div>
        </div>
        <?php echo (empty($settings[0]->pic_name_1) or empty($settings[0]->pic_name_18)) ? "-->" : "" ?>
        <?php echo (empty($settings[0]->pic_name_1) or empty($settings[0]->pic_name_19)) ? "<!--" : "" ?>
        <div class="item">
          <img class="fourth-slide" src="<?php echo $GLOBALS['baseUrl'] . $_GET['home'] . '/' . $settings[0]->pic_name_19 ?>" alt="Fourth slide">
          <div class="container">
            <div class="carousel-caption">
              <?php echo $settings[0]->memo19 ?>
            </div>
          </div>
        </div>
        <?php echo (empty($settings[0]->pic_name_1) or empty($settings[0]->pic_name_19)) ? "-->" : "" ?>
        <?php echo empty($settings[0]->pic_name_1) ? "<!--" : "" ?>
      </div>
      <a class="left carousel-control" href="#topCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#topCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <?php echo empty($settings[0]->pic_name_1) ? "-->" : "" ?>

    <div class="col-md-12" align="right">
      <table>
        <tr>
          <td align="right">
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

    <div class="row">
      <div class="col-md-12">
        <?php echo $baseInfo->bas->info == "" ? "<!--" : "" ?>
        <h3></h3>
        <p><?php echo $baseInfo->bas->info ?></p>
        <br>
        <p>
          <a class="btn btn-info" href="?info&home=<?php echo $_GET['home']; ?>" role="button"><?php echo S_MERAINFORMATION ?></a>
          <?php echo $settings[0]->value27 == "1" ? '<a class="btn btn-info" href="?home=' . $_GET['home'] . '&layout=1&registration" role="button">' . S_ANMALAN . '</a>' : ""; ?>
        </p>
        <br>
        <?php echo $baseInfo->bas->info == "" ? "-->" : "" ?>

        <?php echo $baseInfo->bas->info == "" ? "" : "<!--" ?>
        <div class="alert alert-success" role="alert">
          <?php echo S_CUPSIDAINFO ?> <a href="<?php echo $baseInfo->bas->url ?>" target="_blank"><?php echo S_OFFCUPSIDA ?></a>.
        </div>
        <?php echo $baseInfo->bas->info == "" ? "" : "-->" ?>

      </div>

    </div>
    <!--/row-->
  </div>
  <!--/.col-xs-12.col-sm-9-->

  <div class="col-xs-12 col-sm-3">

    <?php echo ($baseInfo->bas->info == "" or $settings[0]->value24 == 0) ? "<!--" : "" ?>
    <h3 style="display: inline;"><?php echo S_NYHETER ?></h3>
    <?php $i = 0;
    if (is_array($news)) {
      foreach ($news as $x) {
        if ($i >= $settings[0]->value24) {
          continue;
        }
        $i++;
        echo '<p><small>' . str_replace('T', ' ', $x->datumtid) . '</small></p>';
        echo '<h4>' . $x->rubrik . '</h4>';
        echo $x->sammanf;
        echo empty($x->mer_info) ? '' : '<a href="?news&home=' . $_GET['home'] . '#' . $x->datumtid . '"> ' . S_LASMER . '</a>';
        echo '<hr>';
      }
    }
    if (count($news) > $i) {
      echo '<p><a class="btn btn-info" href="?news&home=' . $_GET['home'] . '" role="button">' . S_ALLANYHETER . '</a></p><br>';
    }
    ?>
    <?php echo ($baseInfo->bas->info == "" or $settings[0]->value24 == 0) ? "-->" : "" ?>

    <?php echo empty($settings[0]->string23) ? "<!--" : "" ?>
    <div class="fb-page" data-href="<?php echo $settings[0]->string23 ?>" data-tabs="timeline" data-height="<?php echo $settings[0]->value23 ?>" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
    <?php echo empty($settings[0]->string23) ? "-->" : "" ?>

    <p><?php echo $baseInfo->bas->sidokol ?></p>
    <div class="col-md-12" align="center">
      <p>
      <h4>
        <?php echo (date("Y-m-d") <= $baseInfo->bas->start_dat) ? '<span class="label label-danger">' . howManyDays(date("Y-m-d"), $baseInfo->bas->start_dat) . "</span> " . S_DAGARKVAR : "" ?>
      </h4>
      </p>
    </div>

  </div>
</div>
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