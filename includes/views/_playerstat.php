  <tr>
    <td><?php echo $k->spelare?></td>  
    <td><a href="?team&home=<?php echo $_GET['home'];?>&scope=<?php echo $k->grp_nr?>&name=<?php echo urlencode($k->klubb)?>&layout=<?php echo $GLOBALS['layout'];?>&lang=<?php echo $GLOBALS['lang'];?>"><?php echo $k->klubb?></a></td>  
    <td><?php echo $k->grp_nr?></td>  
    <td><?php echo $k->ant_mtch?></td>  
    <td><?php echo (($baseInfo->bas->st_ass == 'true') ? $k->mal : "<b>" . $k->mal . "</b>")?></td>  
<?php echo ($baseInfo->bas->st_ass == 'true') ? "" : "<!--" ?>
    <td><?php echo $k->ass?></td>  
    <td><b><?php echo $k->mal + $k->ass?></b></td>  
<?php echo ($baseInfo->bas->st_ass == 'true') ? "" : "-->" ?>
    <td><i><?php echo number_format((intval($k->mal) + intval($k->ass))/intval($k->ant_mtch),2)?></i></td>  
<?php echo ($baseInfo->bas->st_utv == 'true') ? "" : "<!--" ?>
    <td><?php echo $k->utv?></td>  
    <td><i><?php echo number_format(intval($k->utv)/intval($k->ant_mtch),2)?></i></td>  
<?php echo ($baseInfo->bas->st_utv == 'true') ? "" : "-->" ?>
<?php echo ($baseInfo->bas->prot_typ == 1 and $baseInfo->bas->st_utv == 'true') ? "" : "<!--" ?>
    <td><?php echo $k->ppg?></td>  
    <td><?php echo $k->ppa?></td>  
    <td><?php echo $k->shg?></td>  
    <td><?php echo $k->sha?></td>  
<?php echo ($baseInfo->bas->prot_typ == 1 and $baseInfo->bas->st_utv == 'true') ? "" : "-->" ?>
<?php echo ($baseInfo->bas->prot_typ == 1) ? "" : "<!--" ?>
    <td><?php echo $k->gwg?></td>  
    <td><?php echo $k->gtg?></td>  
<?php echo ($baseInfo->bas->prot_typ == 1) ? "" : "-->" ?>
<?php echo ($baseInfo->bas->st_gulkort == 'true') ? "" : "<!--" ?>
    <td><?php echo $k->gultkort?></td>  
<?php echo ($baseInfo->bas->st_gulkort == 'true') ? "" : "-->" ?>
<?php echo ($baseInfo->bas->st_rodkort == 'true') ? "" : "<!--" ?>
    <td><?php echo $k->rottkort?></td>  
<?php echo ($baseInfo->bas->st_rodkort == 'true') ? "" : "-->" ?>
  </tr>
