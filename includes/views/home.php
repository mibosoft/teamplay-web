<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems, 'isHome' => true)) ?>

<main class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
  <div class="mt-8 grid gap-6 xl:grid-cols-[minmax(0,1fr)_320px]">
    <section class="tp-shell rounded-[28px] p-4 sm:p-6 lg:p-8">
      <?php echo empty($settings[0]->pic_name_1) ? "<!--" : "" ?>
      <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-slate-900 shadow-soft">
        <img class="h-64 w-full object-cover sm:h-80 lg:h-[26rem]" src="<?php echo $GLOBALS['baseUrl'] . $_GET['home'] . '/' . $settings[0]->pic_name_1 ?>" alt="<?php echo htmlspecialchars($baseInfo->bas->namn, ENT_QUOTES, 'UTF-8') ?>">
        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/90 via-slate-950/50 to-transparent px-5 pb-5 pt-16 text-white sm:px-8 sm:pb-8">
          <h1 class="mb-3 text-3xl font-extrabold leading-tight tracking-tight sm:text-5xl"><?php echo htmlspecialchars($baseInfo->bas->namn, ENT_QUOTES, 'UTF-8') ?></h1>
          <?php echo $settings[0]->memo1 ?>
        </div>
      </div>
      <?php echo empty($settings[0]->pic_name_1) ? "-->" : "" ?>

      <div class="mt-7 grid gap-5 md:grid-cols-[minmax(0,1.2fr)_minmax(0,1fr)]">
        <div class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-sm">
          <label for="searchField" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500"><?php echo S_SOKLAG ?></label>
          <div class="tp-search-control">
            <input id="searchField" type="text" class="tp-search-input" placeholder="<?php echo S_SOKLAG ?>" title="<?php echo S_BORJASKRIVA ?>">
            <button class="tp-search-button" id="go" type="button" aria-label="Search teams">
              <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="6"></circle><path d="m16 16 4 4"></path></svg>
            </button>
          </div>
          <div id="no-result" class="mt-2 hidden text-sm text-rose-600"><?php echo S_HITTASEJ ?></div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-sm">
          <div class="mb-2 text-xs font-semibold uppercase tracking-[0.2em] text-slate-500"><?php echo S_LANGD ?></div>
          <div class="flex flex-wrap items-center gap-2">
            <a href="?layout=1&home=<?php echo $_GET['home']; ?>&lang=swe" class="rounded-full border border-slate-200 bg-white p-2 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md"><img src="assets/images/flags_iso/24/se.png" alt="Swedish" class="h-5 w-5"></a>
            <a href="?layout=1&home=<?php echo $_GET['home']; ?>&lang=eng" class="rounded-full border border-slate-200 bg-white p-2 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md"><img src="assets/images/flags_iso/24/gb.png" alt="English" class="h-5 w-5"></a>
            <a href="?layout=1&home=<?php echo $_GET['home']; ?>&lang=fin" class="rounded-full border border-slate-200 bg-white p-2 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md"><img src="assets/images/flags_iso/24/fi.png" alt="Finnish" class="h-5 w-5"></a>
            <a href="?layout=1&home=<?php echo $_GET['home']; ?>&lang=nor" class="rounded-full border border-slate-200 bg-white p-2 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md"><img src="assets/images/flags_iso/24/no.png" alt="Norwegian" class="h-5 w-5"></a>
            <a href="?layout=1&home=<?php echo $_GET['home']; ?>&lang=cze" class="rounded-full border border-slate-200 bg-white p-2 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md"><img src="assets/images/flags_iso/24/cz.png" alt="Czech" class="h-5 w-5"></a>
            <a href="?layout=1&home=<?php echo $_GET['home']; ?>&lang=pol" class="rounded-full border border-slate-200 bg-white p-2 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md"><img src="assets/images/flags_iso/24/pl.png" alt="Polish" class="h-5 w-5"></a>
          </div>
        </div>
      </div>

      <script>
        $(document).on("click", '#go', function() { btnGoClick(); });
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
                echo 'value: "' . $x->klubb . ' (' . $x->klass . ')","teamName": "' . $x->klubb . '","teamClass": "' . $x->klass . '"}, {';
              }
            }
            ?> "value": "","teamClass": ""
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
                $("#no-result").removeClass('hidden');
                currentUrl = defaultNoMatchUrl;
              } else {
                $("#no-result").addClass('hidden');
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

      <div class="mt-8 grid gap-6 lg:grid-cols-[minmax(0,1.4fr)_minmax(260px,0.9fr)]">
        <div class="space-y-5">
          <?php echo $baseInfo->bas->info == "" ? "<!--" : "" ?>
          <div class="rounded-2xl border border-emerald-100 bg-emerald-50/80 p-5 text-sm leading-7 text-slate-700">
            <?php echo $baseInfo->bas->info ?>
            <div class="mt-4 flex flex-wrap gap-3">
              <a class="tp-btn inline-flex items-center rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700" href="?info&home=<?php echo $_GET['home']; ?>"><?php echo S_MERAINFORMATION ?></a>
              <?php echo $settings[0]->value27 == "1" ? '<a class="tp-btn inline-flex items-center rounded-full border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50" href="?home=' . $_GET['home'] . '&layout=1&registration">' . S_ANMALAN . '</a>' : ""; ?>
            </div>
          </div>
          <?php echo $baseInfo->bas->info == "" ? "-->" : "" ?>

          <?php echo $baseInfo->bas->info == "" ? "" : "<!--" ?>
          <div class="rounded-2xl border border-sky-100 bg-sky-50/80 p-4 text-sm text-slate-700">
            <?php echo S_CUPSIDAINFO ?> <a href="<?php echo $baseInfo->bas->url ?>" target="_blank" class="font-semibold text-sky-700 underline underline-offset-2"><?php echo S_OFFCUPSIDA ?></a>.
          </div>
          <?php echo $baseInfo->bas->info == "" ? "" : "-->" ?>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white/80 p-5 shadow-sm">
          <?php echo ($baseInfo->bas->info == "" or $settings[0]->value24 == 0) ? "<!--" : "" ?>
          <div class="mb-4 flex items-center justify-between gap-3">
            <h3 class="m-0 text-lg font-bold text-slate-800"><?php echo S_NYHETER ?></h3>
          </div>
          <?php
          $i = 0;
          if (is_array($news)) {
            foreach ($news as $x) {
              if ($i >= $settings[0]->value24) {
                continue;
              }
              $i++;
              echo '<article class="border-t border-slate-200 py-4 first:border-t-0 first:pt-0">';
              echo '<p class="mb-2 text-xs font-medium uppercase tracking-[0.2em] text-slate-500">' . str_replace('T', ' ', $x->datumtid) . '</p>';
              echo '<h4 class="mb-2 text-base font-bold text-slate-800">' . $x->rubrik . '</h4>';
              echo '<div class="space-y-3 text-sm leading-6 text-slate-600">' . $x->sammanf . '</div>';
              echo empty($x->mer_info) ? '' : '<div class="mt-3"><a class="text-sm font-semibold text-sky-700 hover:text-sky-800" href="?news&home=' . $_GET['home'] . '#' . $x->datumtid . '"> ' . S_LASMER . '</a></div>';
              echo '</article>';
            }
            if (count($news) > $i) {
              echo '<div class="mt-4"><a class="tp-btn inline-flex items-center rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700" href="?news&home=' . $_GET['home'] . '">' . S_ALLANYHETER . '</a></div>';
            }
          }
          ?>
          <?php echo ($baseInfo->bas->info == "" or $settings[0]->value24 == 0) ? "-->" : "" ?>

          <?php echo empty($settings[0]->string23) ? "<!--" : "" ?>
          <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">
            <div class="fb-page" data-href="<?php echo $settings[0]->string23 ?>" data-tabs="timeline" data-height="<?php echo $settings[0]->value23 ?>" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
          </div>
          <?php echo empty($settings[0]->string23) ? "-->" : "" ?>
        </div>
      </div>

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
            echo '<div id="pic-group" class="mt-10 rounded-2xl border border-slate-200 bg-white/80 p-5 shadow-sm">';
            $noPics = false;
            $firstPic = false;
          }
          echo '<a href="' . $settings[0]->{$adUrlPointer} . '" target="_blank" class="tp-picture-tile rounded-xl border border-slate-200 bg-white p-2 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md"><img src="' . $GLOBALS['baseUrl'] . $_GET['home'] . '/' . $settings[0]->{$adNamePointer} . '" border="0" class="tp-picture rounded-lg object-contain"></a>';
        }
      }
      if (!$noPics) {
        echo '</div>';
      }
      ?>
    </section>

    <aside class="tp-shell rounded-[28px] p-4 sm:p-6" id="sidebar">
      <div class="mb-4 flex items-center justify-between gap-3">
        <h2 class="m-0 text-lg font-bold text-slate-800"><?php echo S_KLASSER ?></h2>
        <a href="?overview&home=<?php echo $_GET['home']; ?>" class="text-xs font-semibold uppercase tracking-[0.2em] text-sky-700 hover:text-sky-800"><?php echo S_ALLA ?></a>
      </div>
      <div class="space-y-2">
        <?php
        if (is_array($classes)) {
          foreach ($classes as $x) {
            echo '<a href="?overviewclass&home=' . $_GET['home'] . '&scope=' . $x->grp_nr . '" class="block rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-sky-200 hover:bg-sky-50 hover:text-sky-800">' . $x->grp_nr . ' - ' . $x->grp_namn . '</a>';
          }
        }
        ?>
      </div>

      <div class="mt-8 rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm leading-6 text-slate-600">
        <?php echo $baseInfo->bas->sidokol ?>
      </div>

      <div class="mt-8 text-center">
        <div class="inline-flex items-center justify-center rounded-full bg-rose-50 px-4 py-2 text-sm font-semibold text-rose-700">
          <?php echo (date("Y-m-d") <= $baseInfo->bas->start_dat) ? '<span class="mr-2">' . howManyDays(date("Y-m-d"), $baseInfo->bas->start_dat) . '</span>' . S_DAGARKVAR : "" ?>
        </div>
      </div>
    </aside>
  </div>
</main>

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>
