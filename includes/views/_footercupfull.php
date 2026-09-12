<footer class="tp-footer mt-12 py-8">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
      <div class="max-w-3xl text-sm leading-6 text-slate-100/90">
        <?php echo $baseInfo->bas->sidfot ?>
      </div>

      <div class="flex items-center gap-4 text-sm text-slate-100/90">
        <?php echo $settings[0]->value15 == "1" ? "" : "<!--"; ?>
        <a class="rounded-full border border-white/20 px-3 py-1.5 text-xs font-medium text-white hover:bg-white/10" href="<?php echo $settings[0]->string21 . '/' . $settings[0]->value21; ?>" target="_blank">Teamplay <?php echo S_ADMIN ?></a>
        <?php echo $settings[0]->value15 == "1" ? "" : "-->"; ?>
        <a class="text-xs font-medium uppercase tracking-[0.2em] text-white/80 hover:text-white" href="../index.html">Teamplay</a>
      </div>
    </div>
  </div>
</footer>


</body>

</html>