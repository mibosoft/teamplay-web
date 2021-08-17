<?php render('_header',array('title'=>$title))?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.8/css/dataTables.bootstrap.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.8/js/dataTables.bootstrap.min.js"></script>

	<div class="row">
	<div class="col-md-10">
	  <h2><?php echo $title?></h2>
	</div>
	<div class="col-md-2 right">
	<table>
	<tr>
	<td align="center">
  	  <a href="?lang=swe" class="menu_link"><img src="assets/images/swe.png" border="0" align="middle"></a>
      <a href="?lang=eng" class="menu_link"><img src="assets/images/eng.png" border="0" align="middle"></a>
      <a href="?lang=fin" class="menu_link"><img src="assets/images/fin.png" border="0" align="middle"></a>
      <a href="?lang=nor" class="menu_link"><img src="assets/images/nor.png" border="0" align="middle"></a>
    </td>
    </tr>
	</table>
    </div>
    </div>
	
	<div class="content">

	<table id="cupdir" class="table table-striped">
		<thead>
			<tr>
				<th><?php echo S_NAMN?></th>
				<th><?php echo S_STARTDATUM?></th>
				<th><?php echo S_SLUTDATUM?></th>
				<th><?php echo S_ARRANGOR?></th>
			</tr>
		</thead>
		<tbody>
         <?php render($cups,array ('view' => '_cupdir'))?>
        </tbody>
	</table>
</div>
</body>

<script>
$(document).ready(function(){
    $('#cupdir').dataTable( {
   	lengthMenu: [[15, 25, 50, -1], [15, 25, 50, "All"]],        
    pageLength: 15,
    order: [[ 2, "<?php echo isset($_GET['completedcups']) ? 'desc' : 'asc';?>" ]],    
    language: {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Swedish.json"
    }
  });
});
</script>

<?php render('_footer')?>