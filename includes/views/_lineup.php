    <tr>
      <td><?php echo $k->spe_nr ?></td>
      <td><?php echo $k->spelare ?> <?php echo $k->mom == '1' ? '<img style="vertical-align: middle;" src="assets/images/star.gif" title="' . S_MATCHENSLIRARE . '" alt="*">' : '' ?></td>
      <td><?php echo $k->malvakt == 'true' ? S_MV : '' ?> <?php echo $k->kapten == 'true' ? S_K : '' ?></td>
      <?php if ($baseInfo->bas->st_mip == 'true') : ?><td><?php echo $k->mip ?></td><?php endif; ?>
      <td><?php echo $k->mal ?></td>
      <?php if ($baseInfo->bas->st_ass == 'true') : ?><td><?php echo $k->ass ?></td><td><?php echo $k->mal + $k->ass ?></td><?php endif; ?>
      <?php if ($baseInfo->bas->st_utv == 'true') : ?><td><?php echo $k->utv ?></td><?php endif; ?>
      <?php if ($baseInfo->bas->st_mal == 'true') : ?><td><?php echo $k->plusmal ?></td><?php endif; ?>
      <?php if ($baseInfo->bas->st_mal == 'true' or $baseInfo->bas->st_mip == 'true') : ?><td><?php echo $k->minusmal ?></td><?php endif; ?>
      <?php if ($baseInfo->bas->st_skott_t == 'true') : ?><td><?php echo $k->skott_tot ?></td><?php endif; ?>
      <?php if ($baseInfo->bas->st_skott_m == 'true') : ?><td><?php echo $k->skott_pmal ?></td><?php endif; ?>
      <?php if ($baseInfo->bas->st_tekn == 'true') : ?><td><?php echo $k->plustekn ?></td><td><?php echo $k->minustekn ?></td><?php endif; ?>
      <?php if ($baseInfo->bas->st_brytn == 'true') : ?><td><?php echo $k->brytn ?></td><?php endif; ?>
      <?php if ($baseInfo->bas->st_gulkort == 'true') : ?><td><?php echo $k->gultkort ?></td><?php endif; ?>
      <?php if ($baseInfo->bas->st_rodkort == 'true') : ?><td><?php echo $k->rottkort ?></td><?php endif; ?>
      <?php if ($baseInfo->bas->st_straffs == 'true') : ?><td><?php echo $k->straffslag ?></td><?php endif; ?>
      <?php if ($baseInfo->bas->st_straffm == 'true') : ?><td><?php echo $k->straffmal ?></td><?php endif; ?>
    </tr>