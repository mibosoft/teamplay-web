    <tr>
        <td><?php echo ($k->datum != "") ? dow(date("N", strtotime( $k->datum ))) . " " . $k->datum : "" ;?> <?php echo $k->tid?></td> 
        <td><a href="<?php echo strpos($k->grp_nr,"-") ? '?overviewgroup' : '?overviewplayoff'; ?>&home=<?php echo $_GET['home'];?>&scope=<?php echo $k->grp_nr?>"><?php echo $k->grp_nr?></a> </td>
        <td><i><?php echo $k->matchnr?></i></td>  
        <td>
        <a href="?team&home=<?php echo $_GET['home'];?>&scope=<?php echo $k->grp_nr?>&name=<?php echo urlencode($k->hemma)?>"><?php echo $k->hemma?></a> - 
        <a href="?team&home=<?php echo $_GET['home'];?>&scope=<?php echo $k->grp_nr?>&name=<?php echo urlencode($k->borta)?>"><?php echo $k->borta?></a> 
        </td>
        <td><a href="?games&home=<?php echo $_GET['home'];?>&scope=all&arena=<?php echo $k->spelplats?>&field=<?php echo $k->plan?>"><?php echo $k->spelplats . ' ' . $k->plan?></a></td>
        <td><?php echo $k->dom_1 . (empty($k->dom_2) ? '' : ', ' . $k->dom_2) ?><?php echo empty($k->dom_3) ? '' : ', ' . $k->dom_3 ?></td>
        <td><?php echo $k->anm?></td>
    </tr>
 