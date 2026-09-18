<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems, 'isHome' => true)) ?>

<style>
  body {
    padding-top: <?php echo empty($settings[0]->pic_name_1) ? "70" : "0" ?>px;
  }

  #moreinfo {
    scroll-margin-top: 90px;
  }

  .homewide-text-section {
    padding-left: 1rem;
    padding-right: 1rem;
    margin-top: 2.5rem;
  }

  .homewide-news {
    margin-top: 3rem;
  }

  .homewide-news-heading {
    align-items: end;
    border-bottom: 1px solid var(--color-divider);
    display: flex;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    padding-bottom: .85rem;
  }

  .homewide-news-heading h2 {
    font-size: clamp(1.5rem, 3vw, 2.15rem);
    line-height: 1.15;
    margin: 0;
  }

  .homewide-news-grid {
    display: grid;
    gap: 1.25rem;
    grid-template-columns: repeat(auto-fit, minmax(min(100%, 19rem), 1fr));
  }

  .homewide-news-card {
    background: var(--color-card);
    border: 1px solid var(--color-divider);
    border-radius: .75rem;
    box-shadow: var(--shadow-soft);
    display: flex;
    flex-direction: column;
    min-height: 13rem;
    padding: 1.35rem;
    transition: box-shadow .2s ease, transform .2s ease;
  }

  .homewide-news-card:hover {
    box-shadow: 0 24px 50px rgba(15, 23, 42, .16);
    transform: translateY(-3px);
  }

  .homewide-news-card time {
    color: var(--color-text-default);
    font-size: .76rem;
    font-weight: 700;
    letter-spacing: .08em;
    opacity: .66;
    text-transform: uppercase;
  }

  .homewide-news-card h3 {
    font-size: 1.25rem;
    line-height: 1.25;
    margin: .65rem 0 .8rem;
  }

  .homewide-news-card-summary {
    flex: 1;
    margin: 0;
  }

  .homewide-news-card-link {
    align-items: center;
    display: inline-flex;
    font-weight: 700;
    gap: .35rem;
    margin-top: 1.25rem;
    text-decoration: none;
  }

  .homewide-news-card-link::after {
    content: "\2192";
    font-size: 1.1em;
    transition: transform .2s ease;
  }

  .homewide-news-card-link:hover::after {
    transform: translateX(3px);
  }

  .homewide-news-all {
    margin-top: 1.5rem;
  }

  @media (max-width: 575px) {
    .homewide-news-heading {
      align-items: start;
      flex-direction: column;
      gap: .35rem;
    }
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

  .jumbotron h1 {
    margin: 0 0 1rem;
    font-size: clamp(2.5rem, 7vw, 5.5rem);
    font-weight: 800;
    line-height: 1.05;
    text-shadow: 0 3px 18px rgba(0,0,0,.35);
  }

  .jumbotron h2 {
    margin: 0 0 1.5rem;
    font-size: clamp(1.35rem, 3vw, 2.25rem);
    font-weight: 600;
    text-shadow: 0 2px 12px rgba(0,0,0,.3);
  }

  .jumbotron .homewide-countdown-badge {
    background: rgba(255, 255, 255, .92);
    border: 2px solid currentColor;
    border-radius: 999px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, .2);
    color: #222;
    display: inline-block;
    font-size: clamp(1rem, 2vw, 1.3rem);
    font-weight: 800;
    line-height: 1;
    padding: .75rem 1.25rem;
    text-shadow: none;
  }

  .jumbotron .tp-hero-actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: .75rem;
    margin: 0 auto;
  }

  .jumbotron:after {
    content: "";
    position: absolute;
    z-index: 1;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    <?php $heroUrl = safeAssetUrl($GLOBALS['baseUrl'], $_GET['home'] ?? '', $settings[0]->pic_name_1 ?? ''); ?>
    background: <?php echo $heroUrl !== '' ? 'url("' . htmlspecialchars($heroUrl, ENT_QUOTES, 'UTF-8') . '")' : 'none'; ?> no-repeat center center;
    background-size: cover;
    background-repeat: no-repeat;
    filter: blur(5.5px);
    transform: scale(1.0);
  }
</style>

<script>
  // Team finder
  $(document).on("click", '#go', function() {
    btnGoClick();
  });

  $(document).on("keypress", '#searchField', function(event) {
    if (event.which == 13) {
      event.preventDefault();
      btnGoClick();
    }
  });

  var defaultNoMatchUrl = "";
  var currentUrl = "";

  $(function() {

    var teamList = [{
      <?php
      if (is_array($teams)) {
        foreach ($teams as $x) {
          echo 'value: "' . $x->klubb . ' (' . $x->klass . ')' . '","teamName": "' . $x->klubb . '","teamClass": "' . $x->klass . '"}, {';
        }
      }
      ?> "value": "",
      "teamClass": ""
    }];

    $("#searchField").autocomplete({
      source: teamList,
      autoFocus: true,
      minLength: 1,
      select: function(event, ui) {
        currentUrl = "<?php echo '?team&home=' . $_GET['home'] . '&layout=1&lang=' . $GLOBALS['lang'] . '&scope=' ?>" + ui.item.teamClass + "<?php echo '&name=' ?>" + ui.item.teamName;
        go(currentUrl);
      },
      response: function(event, ui) {
        if (!ui.content.length) {
          $("#no-result").show();
          currentUrl = defaultNoMatchUrl;
        } else {
          $("#no-result").hide();
        }
      },
    });
  });

  function go(url) {
    window.location.href = url;
  }

  function btnGoClick() {
    if (currentUrl !== "") go(currentUrl);
  }
</script>

<?php echo empty($settings[0]->pic_name_1) ? "<!--" : "" ?>
<div class="jumbotron d-flex justify-content-center">
  <div class="container">
    <p><?php echo $settings[0]->memo1 ?></p>
    <h3>
      <?php echo (date("Y-m-d") <= $baseInfo->bas->start_dat) ? '<span class="homewide-countdown-badge">' . howManyDays(date("Y-m-d"), $baseInfo->bas->start_dat) . " " . S_DAGARKVAR . "</span>" : "" ?>
    </h3>
    <br>
    <div class="tp-hero-actions">
      <a class="btn btn-default btn-lg" href="?home=<?php echo $_GET['home']; ?>&layout=1#moreinfo" role="button"><?php echo S_MERAINFORMATION ?></a>
      <?php echo $settings[0]->value27 == "1" ? '<a class="btn btn-default btn-lg" href="?home=' . $_GET['home'] . '&layout=1&registration" role="button">' . S_ANMALAN . '</a>' : ""; ?>
      <?php echo $settings[0]->value5 == "1" ? '<a class="btn btn-default btn-lg" href="?home=' . $_GET['home'] . '&layout=1&overview" role="button">' . S_SCHEMARESULTAT . '</a>' : ""; ?>
    </div>
    <br><br>

    <div class="row">
      <div style="margin: 0 auto;width: 70%;">
        <div class="tp-search-control">
          <input id="searchField" type="text" class="tp-search-input" placeholder="<?php echo S_SOKLAG ?>" title="<?php echo S_BORJASKRIVA ?>">
          <button class="tp-search-button" id="go" type="button" aria-label="Search teams">
            <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="6"></circle><path d="m16 16 4 4"></path></svg>
          </button>
        </div>
      </div>
    </div>
    <div class="row">
      <div style="margin: 0 auto;width: 30%;">
        <div id="no-result" style="display: none;"><?php echo S_HITTASEJ ?></div>
      </div>
    </div>

  </div>
</div>
<?php echo empty($settings[0]->pic_name_1) ? "-->" : "" ?>

<div id="moreinfo"></div>
<div class="container homewide-text-section">
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
      <aside class="tp-card p-4">
        <p><?php echo $baseInfo->bas->sidokol ?></p>
      </aside>
    </div>
    <?php echo $baseInfo->bas->sidokol == "" ? "-->" : "" ?>
  </div> <!-- /basinfo-row -->
</div> <!-- /basinfo-container -->

<?php echo ($baseInfo->bas->info == "" or $settings[0]->value24 == 0 or empty($news)) ? "<!--" : "" ?>
<section class="container homewide-text-section homewide-news" aria-labelledby="homewide-news-title">
  <div class="homewide-news-heading">
    <h2 id="homewide-news-title"><?php echo S_NYHETER ?></h2>
  </div>
  <div class="homewide-news-grid">
    <?php $i = 0;
    if (is_array($news)) {
      foreach ($news as $x) {
        if ($i >= $settings[0]->value24) {
          continue;
        }
        $i++;
        $newsAnchor = htmlspecialchars((string) $x->datumtid, ENT_QUOTES, 'UTF-8');
        $newsTitle = htmlspecialchars((string) $x->rubrik, ENT_QUOTES, 'UTF-8');
        $newsDate = htmlspecialchars(str_replace('T', ' ', (string) $x->datumtid), ENT_QUOTES, 'UTF-8');
        echo '<article class="homewide-news-card" id="' . $newsAnchor . '">';
        echo '<time datetime="' . $newsAnchor . '">' . $newsDate . '</time>';
        echo '<h3>' . $newsTitle . '</h3>';
        echo '<div class="homewide-news-card-summary">' . $x->sammanf . '</div>';
        echo empty($x->mer_info) ? '' : '<a class="homewide-news-card-link" href="?news&home=' . rawurlencode($_GET['home']) . '#' . rawurlencode((string) $x->datumtid) . '">' . S_LASMER . '</a>';
        echo '</article>';
      }
      if (count($news) > $i) {
        echo '<p class="homewide-news-all"><a class="btn btn-info" href="?news&home=' . rawurlencode($_GET['home']) . '" role="button">' . S_ALLANYHETER . '</a></p>';
      }
    }
    ?>
  </div>
</section>

<?php echo ($baseInfo->bas->info == "" or $settings[0]->value24 == 0 or empty($news)) ? "-->" : "" ?>

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
    $adImageUrl = safeAssetUrl($GLOBALS['baseUrl'], $_GET['home'] ?? '', $settings[0]->{$adNamePointer});
    if ($adImageUrl !== '') {
      if ($firstPic) {
        echo '<div id="pic-group">';
        $noPics = false;
        $firstPic = false;
      }
      $adTarget = trim((string) ($settings[0]->{$adUrlPointer} ?? ''));
      $adTarget = preg_match('/^file:\/\//i', $adTarget) || preg_match('/^[A-Za-z]:[\\\/]/', $adTarget) || preg_match('/^\\\\/', $adTarget) ? '' : $adTarget;
      $adHref = $adTarget === '' ? '#' : htmlspecialchars($adTarget, ENT_QUOTES, 'UTF-8');
      echo '<a class="tp-picture-tile" href="' . $adHref . '" target="_blank"><img class="tp-picture" src="' . htmlspecialchars($adImageUrl, ENT_QUOTES, 'UTF-8') . '" alt="" border="0"></a>';
    }
  }
}
if (!$noPics) {
  echo '</div>';
} ?>

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>