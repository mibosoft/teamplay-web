<?php include "_head.php"; ?>

<body class="<?php echo empty($isHome) ? 'cup-with-wallpaper' : '' ?> antialiased">
  <?php include_once("includes/analyticstracking.php") ?>

  <div id="fb-root"></div>

  <header class="tp-nav sticky top-0 z-50">
    <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" aria-label="Main navigation" x-data="{ open: false }">
      <div class="flex h-16 items-center justify-between gap-3">
        <div class="flex items-center gap-3">
          <button
            type="button"
            class="inline-flex items-center justify-center rounded-md border border-slate-200 bg-white/80 p-2 text-slate-700 shadow-sm lg:hidden"
            aria-label="Toggle navigation"
            @click="open = !open"
          >
            <span class="sr-only"><?php echo S_KLASSER ?></span>
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7h16M4 12h16M4 17h16" /></svg>
          </button>

          <a class="inline-flex items-center gap-2 rounded-full bg-white/80 px-3 py-2 text-sm font-bold tracking-wide text-slate-800 shadow-sm ring-1 ring-slate-200 transition hover:bg-white" href="?home=<?php echo $_GET['home']; ?>&layout=1">
            <span><?php echo empty($isHome) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') : 'Teamplay'; ?></span>
            <span class="text-base" aria-hidden="true">🏠</span>
          </a>
        </div>

        <div class="hidden items-center justify-center gap-1 lg:absolute lg:left-1/2 lg:flex lg:w-max lg:-translate-x-1/2 lg:flex-wrap">
          <div class="group relative">
            <button class="rounded-full px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 focus:outline-none" data-ui="dropdown" aria-expanded="false"><?php echo S_INFO ?> <span class="ml-1">▼</span></button>
            <ul hidden style="display: none" class="dropdown-menu absolute left-0 top-full mt-0 min-w-[220px] rounded-xl border border-slate-200 bg-white p-2 shadow-xl">
              <li><a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&info"><?php echo S_INFORMATIONTAVLING ?></a></li>
              <?php echo $settings[0]->bool6 == 'true' ? "" : "<!--"; ?>
              <li><a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&mapoverview"><?php echo S_OVERSIKTSKARTA ?></a></li>
              <?php echo $settings[0]->bool6 == 'true' ? "" : "-->"; ?>
              <li><a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&news"><?php echo S_NYHETER ?></a></li>
              <li><a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&rules"><?php echo S_REGLER ?></a></li>
              <?php echo $settings[0]->value8 == "1" ? "" : "<!--"; ?>
              <li><a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&arenas"><?php echo S_SPELPLATSER ?></a></li>
              <?php echo $settings[0]->value8 == "1" ? "" : "-->"; ?>
              <?php echo $settings[0]->value12 == "1" ? "" : "<!--"; ?>
              <li><a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&referees"><?php echo S_DOMARE ?></a></li>
              <?php echo $settings[0]->value12 == "1" ? "" : "-->"; ?>
              <?php if (is_array($menuItems)) { foreach ($menuItems as $menuItem) { if ($menuItem['type'][0] == "1") { echo '<li><a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=' . $_GET['home'] . '&layout=1&userpage&scope=' . $menuItem['id'][0] . '">' . $menuItem['menutitle'][0] . '</a></li>'; } } } ?>
            </ul>
          </div>

          <a class="rounded-full px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&teams&scope=all"><?php echo S_LAG_PLURAL ?></a>
          <a class="rounded-full px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&overview"><?php echo S_KLASSER ?></a>

          <?php echo $settings[0]->value5 == "1" ? "" : "<!--"; ?>
          <div class="group relative">
            <button class="rounded-full px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 focus:outline-none" data-ui="dropdown" aria-expanded="false"><?php echo S_MATCHER ?> <span class="ml-1">▼</span></button>
            <ul hidden style="display: none" class="dropdown-menu absolute left-0 top-full mt-0 min-w-[220px] rounded-xl border border-slate-200 bg-white p-2 shadow-xl">
              <li><a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&games&scope=all"><?php echo S_SAMTLIGAMATCHER ?></a></li>
              <li><a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&bookedgames&scope=all"><?php echo S_BOKADEMATCHER ?></a></li>
              <li><a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&unplayedgames&scope=all"><?php echo S_OSPELADEMATCHER ?></a></li>
              <li><a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&latestgames&scope=all"><?php echo S_SENASTERESULTAT ?></a></li>
            </ul>
          </div>
          <?php echo $settings[0]->value5 == "1" ? "" : "-->"; ?>

          <?php echo $settings[0]->value11 == "1" ? "" : "<!--"; ?>
          <a class="rounded-full px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&fairplay&scope=all"><?php echo S_FAIRPLAY ?></a>
          <?php echo $settings[0]->value11 == "1" ? "" : "-->"; ?>

          <div class="group relative">
            <button class="rounded-full px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 focus:outline-none" data-ui="dropdown" aria-expanded="false"><?php echo S_STATISTIK ?> <span class="ml-1">▼</span></button>
            <ul hidden style="display: none" class="dropdown-menu absolute left-0 top-full mt-0 min-w-[220px] rounded-xl border border-slate-200 bg-white p-2 shadow-xl">
              <li><a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&teamstat&scope=all"><?php echo S_LAGSTATISTIK ?></a></li>
              <?php echo $settings[0]->value6 == "1" ? "" : "<!--"; ?>
              <li><a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&playerstat&scope=all&sort=<?php echo ($settings[0]->bool25 == 'true') ? "goaldiff" : "points"; ?>"><?php echo S_SPELARSTATISTIK ?></a></li>
              <?php echo $settings[0]->value6 == "1" ? "" : "-->"; ?>
            </ul>
          </div>

          <?php echo $settings[0]->bool8 == 'true' ? "" : "<!--"; ?>
          <div class="group relative">
            <button class="rounded-full px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 focus:outline-none" data-ui="dropdown" aria-expanded="false"><?php echo S_HISTORIK_ ?> <span class="ml-1">▼</span></button>
            <ul hidden style="display: none" class="dropdown-menu absolute left-0 top-full mt-0 min-w-[220px] rounded-xl border border-slate-200 bg-white p-2 shadow-xl">
              <?php echo $settings[0]->memo5 ?>
            </ul>
          </div>
          <?php echo $settings[0]->bool8 == 'true' ? "" : "-->"; ?>

          <?php if (is_array($menuItems)) { foreach ($menuItems as $menuItem) { if ($menuItem['type'][0] == "2") { echo '<a class="rounded-full px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100" href="?home=' . $_GET['home'] . '&layout=1&userpage&scope=' . $menuItem['id'][0] . '">' . $menuItem['menutitle'][0] . '</a>'; } } } ?>

          <?php echo ($settings[0]->bool7 == 'true' and !isHttps()) ? "" : "<!--"; ?>
          <a class="rounded-full px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&refereeregistration"><?php echo S_INTRESSEANMALANDOMARE ?></a>
          <?php echo ($settings[0]->bool7 == 'true' and !isHttps()) ? "" : "-->"; ?>

          <?php echo ($settings[0]->bool7 == 'true' and isHttps()) ? "" : "<!--"; ?>
          <a class="rounded-full px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100" href="<?php echo $settings[0]->string21 . '/' . $settings[0]->value21 . '/?intresseanmalan!=' . $GLOBALS['lang']  . '&' ?>" target="_blank"><?php echo S_INTRESSEANMALANDOMARE ?></a>
          <?php echo ($settings[0]->bool7 == 'true' and isHttps()) ? "" : "-->"; ?>

          <?php echo $settings[0]->value27 == "1" ? "" : "<!--"; ?>
          <a class="tp-btn rounded-full bg-slate-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-700" href="?home=<?php echo $_GET['home']; ?>&layout=1&registration"><?php echo S_ANMALAN ?></a>
          <?php echo $settings[0]->value27 == "1" ? "" : "-->"; ?>
        </div>

      </div>

      <div x-show="open" x-collapse class="tp-mobile-nav border-t border-slate-200 py-3 lg:hidden">
        <div class="space-y-1">
          <div>
            <button class="block w-full rounded-lg px-3 py-2 text-left text-sm text-slate-700 hover:bg-slate-100" data-ui="dropdown" aria-expanded="false"><?php echo S_INFO ?></button>
            <ul hidden style="display: none" class="dropdown-menu">
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&info"><?php echo S_INFORMATIONTAVLING ?></a></li>
              <?php echo $settings[0]->bool6 == 'true' ? "" : "<!--"; ?><li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&mapoverview"><?php echo S_OVERSIKTSKARTA ?></a></li><?php echo $settings[0]->bool6 == 'true' ? "" : "-->"; ?>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&news"><?php echo S_NYHETER ?></a></li>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&rules"><?php echo S_REGLER ?></a></li>
              <?php echo $settings[0]->value8 == "1" ? "" : "<!--"; ?><li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&arenas"><?php echo S_SPELPLATSER ?></a></li><?php echo $settings[0]->value8 == "1" ? "" : "-->"; ?>
              <?php echo $settings[0]->value12 == "1" ? "" : "<!--"; ?><li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&referees"><?php echo S_DOMARE ?></a></li><?php echo $settings[0]->value12 == "1" ? "" : "-->"; ?>
            </ul>
          </div>
          <a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&teams&scope=all"><?php echo S_LAG_PLURAL ?></a>
          <a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&overview"><?php echo S_KLASSER ?></a>
          <?php echo $settings[0]->value5 == "1" ? "" : "<!--"; ?>
          <div>
            <button class="block w-full rounded-lg px-3 py-2 text-left text-sm text-slate-700 hover:bg-slate-100" data-ui="dropdown" aria-expanded="false"><?php echo S_MATCHER ?></button>
            <ul hidden style="display: none" class="dropdown-menu">
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&games&scope=all"><?php echo S_SAMTLIGAMATCHER ?></a></li>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&bookedgames&scope=all"><?php echo S_BOKADEMATCHER ?></a></li>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&unplayedgames&scope=all"><?php echo S_OSPELADEMATCHER ?></a></li>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&latestgames&scope=all"><?php echo S_SENASTERESULTAT ?></a></li>
            </ul>
          </div>
          <?php echo $settings[0]->value5 == "1" ? "" : "-->"; ?>
          <?php echo $settings[0]->value11 == "1" ? "" : "<!--"; ?>
          <a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&fairplay&scope=all"><?php echo S_FAIRPLAY ?></a>
          <?php echo $settings[0]->value11 == "1" ? "" : "-->"; ?>
          <div>
            <button class="block w-full rounded-lg px-3 py-2 text-left text-sm text-slate-700 hover:bg-slate-100" data-ui="dropdown" aria-expanded="false"><?php echo S_STATISTIK ?></button>
            <ul hidden style="display: none" class="dropdown-menu">
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&teamstat&scope=all"><?php echo S_LAGSTATISTIK ?></a></li>
              <?php echo $settings[0]->value6 == "1" ? "" : "<!--"; ?>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&playerstat&scope=all&sort=<?php echo ($settings[0]->bool25 == 'true') ? "goaldiff" : "points"; ?>"><?php echo S_SPELARSTATISTIK ?></a></li>
              <?php echo $settings[0]->value6 == "1" ? "" : "-->"; ?>
            </ul>
          </div>
          <?php echo $settings[0]->bool8 == 'true' ? "" : "<!--"; ?>
          <div>
            <button class="block w-full rounded-lg px-3 py-2 text-left text-sm text-slate-700 hover:bg-slate-100" data-ui="dropdown" aria-expanded="false"><?php echo S_HISTORIK_ ?></button>
            <ul hidden style="display: none" class="dropdown-menu">
              <?php echo $settings[0]->memo5 ?>
            </ul>
          </div>
          <?php echo $settings[0]->bool8 == 'true' ? "" : "-->"; ?>
          <?php if (is_array($menuItems)) { foreach ($menuItems as $menuItem) { if ($menuItem['type'][0] == "2") { echo '<a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=' . $_GET['home'] . '&layout=1&userpage&scope=' . $menuItem['id'][0] . '">' . $menuItem['menutitle'][0] . '</a>'; } } } ?>
          <?php echo ($settings[0]->bool7 == 'true' and !isHttps()) ? "" : "<!--"; ?>
          <a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&refereeregistration"><?php echo S_INTRESSEANMALANDOMARE ?></a>
          <?php echo ($settings[0]->bool7 == 'true' and !isHttps()) ? "" : "-->"; ?>
          <?php echo $settings[0]->value27 == "1" ? "" : "<!--"; ?>
          <a class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100" href="?home=<?php echo $_GET['home']; ?>&layout=1&registration"><?php echo S_ANMALAN ?></a>
          <?php echo $settings[0]->value27 == "1" ? "" : "-->"; ?>
        </div>
      </div>
    </nav>
  </header>