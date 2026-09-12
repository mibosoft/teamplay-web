<footer class="tp-footer mt-12 py-8">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
      <div class="max-w-2xl text-sm leading-6 text-slate-100/90">
        <?php echo $baseInfo->bas->sidfot ?>
      </div>

      <?php echo $settings[0]->value15 == "1" ? "" : "<!--"; ?>
      <a class="inline-flex items-center justify-center rounded-full border border-white/20 px-3 py-1.5 text-xs font-medium text-white hover:bg-white/10" href="<?php echo $settings[0]->string21 . '/' . $settings[0]->value21; ?>" target="_blank">Teamplay <?php echo S_ADMIN ?></a>
      <?php echo $settings[0]->value15 == "1" ? "" : "-->"; ?>
    </div>
  </div>
</footer>

</body>

</html>