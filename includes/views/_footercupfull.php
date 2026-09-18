<footer class="tp-footer mt-10 py-6">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="mb-4 flex flex-wrap items-center justify-center gap-3">
      <a href="?layout=<?php echo $GLOBALS['layout'] ?? 1; ?>&home=<?php echo htmlspecialchars($_GET['home'] ?? '', ENT_QUOTES, 'UTF-8'); ?>&lang=swe" class="inline-flex items-center justify-center rounded-full bg-white/10 p-1.5 transition hover:bg-white/20" title="Svenska"><img src="assets/images/flags_iso/24/se.png" alt="Swedish" class="block h-5 w-5"></a>
      <a href="?layout=<?php echo $GLOBALS['layout'] ?? 1; ?>&home=<?php echo htmlspecialchars($_GET['home'] ?? '', ENT_QUOTES, 'UTF-8'); ?>&lang=eng" class="inline-flex items-center justify-center rounded-full bg-white/10 p-1.5 transition hover:bg-white/20" title="English"><img src="assets/images/flags_iso/24/gb.png" alt="English" class="block h-5 w-5"></a>
      <a href="?layout=<?php echo $GLOBALS['layout'] ?? 1; ?>&home=<?php echo htmlspecialchars($_GET['home'] ?? '', ENT_QUOTES, 'UTF-8'); ?>&lang=fin" class="inline-flex items-center justify-center rounded-full bg-white/10 p-1.5 transition hover:bg-white/20" title="Suomi"><img src="assets/images/flags_iso/24/fi.png" alt="Finnish" class="block h-5 w-5"></a>
      <a href="?layout=<?php echo $GLOBALS['layout'] ?? 1; ?>&home=<?php echo htmlspecialchars($_GET['home'] ?? '', ENT_QUOTES, 'UTF-8'); ?>&lang=nor" class="inline-flex items-center justify-center rounded-full bg-white/10 p-1.5 transition hover:bg-white/20" title="Norsk"><img src="assets/images/flags_iso/24/no.png" alt="Norwegian" class="block h-5 w-5"></a>
      <a href="?layout=<?php echo $GLOBALS['layout'] ?? 1; ?>&home=<?php echo htmlspecialchars($_GET['home'] ?? '', ENT_QUOTES, 'UTF-8'); ?>&lang=cze" class="inline-flex items-center justify-center rounded-full bg-white/10 p-1.5 transition hover:bg-white/20" title="Česky"><img src="assets/images/flags_iso/24/cz.png" alt="Czech" class="block h-5 w-5"></a>
      <a href="?layout=<?php echo $GLOBALS['layout'] ?? 1; ?>&home=<?php echo htmlspecialchars($_GET['home'] ?? '', ENT_QUOTES, 'UTF-8'); ?>&lang=pol" class="inline-flex items-center justify-center rounded-full bg-white/10 p-1.5 transition hover:bg-white/20" title="Polski"><img src="assets/images/flags_iso/24/pl.png" alt="Polish" class="block h-5 w-5"></a>
    </div>

    <div class="mb-4 text-center text-sm leading-6 text-slate-100/90">
      <?php echo $baseInfo->bas->sidfot ?>
    </div>

    <div class="flex flex-row items-end justify-between gap-4">
      <div class="flex min-w-0 flex-1 flex-wrap items-center gap-4 text-sm leading-6 text-slate-100/90">
        <a class="text-xs font-medium uppercase tracking-[0.2em] text-white/80 hover:text-white" href="../index.html">Teamplay</a>
      </div>

      <div class="flex shrink-0 items-center gap-4 text-sm text-slate-100/90">
        <?php echo $settings[0]->value15 == "1" ? "" : "<!--"; ?>
        <a class="rounded-full border border-white/20 px-3 py-1.5 text-xs font-medium text-white hover:bg-white/10" href="<?php echo $settings[0]->string21 . '/' . $settings[0]->value21; ?>" target="_blank">Teamplay <?php echo S_ADMIN ?></a>
        <?php echo $settings[0]->value15 == "1" ? "" : "-->"; ?>
      </div>
    </div>
  </div>
</footer>


</body>

</html>