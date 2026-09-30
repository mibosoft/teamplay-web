<?php include "_head.php"; ?>

<?php
  $showCompletedCups = isset($_GET['completedcups']);
?>

<body class="antialiased">
  <header class="tp-nav sticky top-0 z-50">
    <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" aria-label="Tournament navigation" x-data="{ open: false }">
      <div class="flex h-16 items-center justify-between gap-4">
        <a class="inline-flex items-center gap-2 rounded-full bg-white/80 px-4 py-2 text-sm font-bold tracking-wide text-slate-800 shadow-sm ring-1 ring-slate-200" href="../index.html">
          <span>Teamplay</span>
          <span aria-hidden="true" class="text-base">🏠</span>
        </a>

        <button type="button" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white/80 p-2 text-slate-700 shadow-sm lg:hidden" aria-label="Toggle navigation" @click="open = !open">
          <span class="sr-only">Menu</span>
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7h16M4 12h16M4 17h16" /></svg>
        </button>

        <div class="hidden items-center gap-2 lg:flex">
          <a class="cupdir-view-link <?php echo !$showCompletedCups ? 'is-active' : ''; ?>" href="index.php?layout=1"<?php echo !$showCompletedCups ? ' aria-current="page"' : ''; ?>><?php echo S_AKTUELLATURN; ?></a>
          <a class="cupdir-view-link <?php echo $showCompletedCups ? 'is-active' : ''; ?>" href="index.php?layout=1&amp;completedcups"<?php echo $showCompletedCups ? ' aria-current="page"' : ''; ?>><?php echo S_GEMOFORDATURN; ?></a>
        </div>
      </div>

      <div x-show="open" x-collapse class="border-t border-slate-200 py-3 lg:hidden">
        <div class="space-y-1">
          <a class="cupdir-view-link cupdir-view-link-mobile <?php echo !$showCompletedCups ? 'is-active' : ''; ?>" href="index.php?layout=1"<?php echo !$showCompletedCups ? ' aria-current="page"' : ''; ?>><?php echo S_AKTUELLATURN; ?></a>
          <a class="cupdir-view-link cupdir-view-link-mobile <?php echo $showCompletedCups ? 'is-active' : ''; ?>" href="index.php?layout=1&amp;completedcups"<?php echo $showCompletedCups ? ' aria-current="page"' : ''; ?>><?php echo S_GEMOFORDATURN; ?></a>
        </div>
      </div>
    </nav>
  </header>
  