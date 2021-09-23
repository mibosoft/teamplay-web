    <tr>
      <td><?php echo $k->spe_nr ?></td>
      <td><?php echo $k->spelare ?> <?php echo $k->mom == '1' ? '<img style="vertical-align: middle;" src="assets/images/star.gif" title="' . S_MATCHENSLIRARE . '" alt="*">' : '' ?></td>
      <td><?php echo $k->malvakt == 'true' ? S_MV : '' ?> <?php echo $k->kapten == 'true' ? S_K : '' ?></td>
      <td><?php echo $baseInfo->bas->st_mip == 'true' ? $k->mip : '' ?></td>
      <td><?php echo $k->mal ?></td>
      <td><?php echo $baseInfo->bas->st_ass == 'true' ? $k->ass : '' ?></td>
      <td><?php echo $baseInfo->bas->st_ass == 'true' ? $k->mal + $k->ass : '' ?></td>
      <td><?php echo $baseInfo->bas->st_utv == 'true' ? $k->utv : '' ?></td>
      <td><?php echo $baseInfo->bas->st_mal == 'true' ? $k->plusmal : '' ?></td>
      <td><?php echo ($baseInfo->bas->st_mal == 'true' or $baseInfo->bas->st_mip == 'true') ? $k->minusmal : '' ?></td>
      <td><?php echo $baseInfo->bas->st_skott_t == 'true' ? $k->skott_tot : '' ?></td>
      <td><?php echo $baseInfo->bas->st_skott_m == 'true' ? $k->skott_pmal : '' ?></td>
      <td><?php echo $baseInfo->bas->st_tekn == 'true' ? $k->plustekn : '' ?></td>
      <td><?php echo $baseInfo->bas->st_tekn == 'true' ? $k->minustekn : '' ?></td>
      <td><?php echo $baseInfo->bas->st_brytn == 'true' ? $k->brytn : '' ?></td>
      <td><?php echo $baseInfo->bas->st_gulkort == 'true' ? $k->gultkort : '' ?></td>
      <td><?php echo $baseInfo->bas->st_rodkort == 'true' ? $k->rottkort : '' ?></td>
      <td><?php echo $baseInfo->bas->st_straffs == 'true' ? $k->straffslag : '' ?></td>
      <td><?php echo $baseInfo->bas->st_straffm == 'true' ? $k->straffmal : '' ?></td>
    </tr>