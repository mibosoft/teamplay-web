    <tr>
        <td><i><?php echo $k->matchnr?></i></td>  
        <td><a href="<?php echo strpos($k->grp_nr,"-") ? '?overviewgroup' : '?overviewplayoff'; ?>&home=<?php echo $_GET['home'];?>&scope=<?php echo $k->grp_nr?>&layout=<?php echo $GLOBALS['layout'];?>&lang=<?php echo $GLOBALS['lang'];?>"><?php echo $k->grp_nr?></a> </td>
        <td><?php echo ($k->datum != "" and $GLOBALS['layout'] == 3) ? dow(date("N", strtotime( $k->datum ))) : "" ;?> <?php echo $k->tid?></td> 
        <td>
        <a href="?team&home=<?php echo $_GET['home'];?>&scope=<?php echo $k->grp_nr?>&name=<?php echo urlencode($k->hemma)?>&layout=<?php echo $GLOBALS['layout'];?>&lang=<?php echo $GLOBALS['lang'];?>"><?php echo $k->hemma?></a> - 
        <a href="?team&home=<?php echo $_GET['home'];?>&scope=<?php echo $k->grp_nr?>&name=<?php echo urlencode($k->borta)?>&layout=<?php echo $GLOBALS['layout'];?>&lang=<?php echo $GLOBALS['lang'];?>"><?php echo $k->borta?></a> 
        </td>
        <td><big><span class="<?php echo getGameStatus($k->status)?>"><?php echo $k->dolj == 'true' ? S_DOLT : 
        '<a href="?game&home=' . $_GET['home'] . '&gameno=' . $k->matchnr . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . $k->m_hem ."-" . $k->m_bor . '</a>'?></span></big>
        <?php echo empty($k->m_per) ? '' : '(' . $k->m_per . ')' ?> 
        <?php echo $k->wo=="true" ? "(WO)" : "";?><?php echo $k->straffl=="true" ? "(STR)" : "";?><?php echo $k->forlangn=="true" ? "(FL)" : "";?></td> 
        <td><a href="?games&home=<?php echo $_GET['home'];?>&scope=all&arena=<?php echo $k->spelplats?>&field=<?php echo $k->plan?>&layout=<?php echo $GLOBALS['layout'];?>&lang=<?php echo $GLOBALS['lang'];?>"><?php echo $k->spelplats . ' ' . $k->plan?></a></td>
        <td><?php echo $k->anm?></td>
        <td><?php echo ($k->mediaurl != "" ? '<a href="' . $k->mediaurl . '" target="_blank"><span class="glyphicon glyphicon-facetime-video" title="' . S_VIDEO . '/' . S_FOTO . '"></span></a>' : "" ) ?></td>
    </tr>
 