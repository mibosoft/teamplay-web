<?php render('_header', array('title' => $title)) ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.8/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<style>
	#cupdir_wrapper {
		overflow: auto;
	}

	#cupdir_wrapper #cupdir thead th {
		background-image: none !important;
		cursor: pointer;
		text-align: left;
	}

	#cupdir_wrapper #cupdir thead th::after {
		color: #64748b;
		content: "\2195";
		display: inline-block;
		line-height: 1;
		margin-left: 8px;
		vertical-align: middle;
	}

	#cupdir_wrapper #cupdir thead th[data-sort-direction="asc"]::after {
		color: #0f766e;
		content: "\2191";
	}

	#cupdir_wrapper #cupdir thead th[data-sort-direction="desc"]::after {
		color: #0f766e;
		content: "\2193";
	}

	#cupdir_wrapper .dataTables_length {
		align-items: center;
		display: flex;
		float: left;
		margin-bottom: 12px;
		min-height: 34px;
	}

	#cupdir_wrapper .dataTables_length label {
		color: #1e293b;
		font-weight: 600;
	}

	#cupdir_wrapper .dataTables_length select {
		background: #ffffff;
		border: 1px solid #94a3b8;
		border-radius: 4px;
		box-shadow: 0 1px 2px rgba(15, 23, 42, 0.12);
		box-sizing: border-box;
		color: #0f172a;
		font-size: 16px;
		height: 38px;
		margin: 0 4px;
		padding: 6px 28px 6px 10px;
	}

	#cupdir_wrapper .dataTables_length select:focus {
		border-color: #0f766e;
		box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.2);
		outline: none;
	}

	#cupdir_wrapper .dataTables_filter {
		align-items: center;
		display: flex;
		float: right;
		justify-content: flex-end;
		margin-bottom: 12px;
		min-height: 34px;
	}

	#cupdir_wrapper .dataTables_filter label {
		align-items: center;
		color: #1e293b;
		display: flex;
		gap: 8px;
		font-weight: 600;
		margin: 0;
	}

	#cupdir_wrapper .dataTables_filter input[type="search"] {
		background: #ffffff;
		border: 1px solid #94a3b8;
		border-radius: 4px;
		box-shadow: 0 1px 2px rgba(15, 23, 42, 0.12);
		box-sizing: border-box;
		color: #0f172a;
		font-size: 16px;
		height: 38px;
		margin-left: 0;
		padding: 6px 10px;
		width: 220px;
	}

	#cupdir_wrapper .dataTables_filter input[type="search"]:focus {
		border-color: #0f766e;
		box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.2);
		outline: none;
	}

	#cupdir_wrapper .dataTables_paginate {
		align-items: center;
		clear: both;
		display: flex;
		float: none;
		flex-wrap: wrap;
		gap: 6px;
		justify-content: flex-end;
		padding-top: 12px;
	}

	#cupdir_wrapper .dataTables_paginate .paginate_button {
		align-items: center;
		background: #0f172a !important;
		border: 1px solid #0f172a !important;
		border-radius: 4px;
		box-sizing: border-box;
		color: #ffffff !important;
		display: inline-flex;
		font-weight: 600;
		line-height: 1.25;
		min-height: 36px;
		padding: 8px 12px;
		text-decoration: none !important;
	}

	#cupdir_wrapper .dataTables_paginate .paginate_button:hover {
		background: #0f172a !important;
		border-color: #0f172a !important;
		color: #ffffff !important;
		filter: brightness(0.9);
	}

	#cupdir_wrapper .dataTables_paginate .paginate_button.current {
		background: #0f172a !important;
		border-color: #0f172a !important;
		box-shadow: inset 0 0 0 2px #ffffff;
		color: #ffffff !important;
	}

	#cupdir_wrapper .dataTables_paginate .paginate_button.disabled,
	#cupdir_wrapper .dataTables_paginate .paginate_button.disabled:hover {
		background: #f8fafc !important;
		border-color: #e2e8f0 !important;
		color: #94a3b8 !important;
		cursor: default;
	}

	@media (max-width: 767px) {
		#cupdir_wrapper {
			overflow-x: hidden;
		}

		#cupdir_wrapper #cupdir {
			display: table;
			min-width: 0;
			table-layout: fixed;
		}

		#cupdir_wrapper #cupdir thead {
			display: none;
		}

		#cupdir_wrapper #cupdir tbody {
			display: table-row-group;
		}

		#cupdir_wrapper #cupdir tbody tr {
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 12px;
			padding: 10px 0;
			border: 0;
			border-bottom: 1px solid rgba(148, 163, 184, 0.3);
			border-radius: 0;
			background: transparent;
			box-shadow: none;
		}

		#cupdir_wrapper #cupdir tbody td {
			display: block;
			padding: 0;
			border: 0;
			text-align: left;
			word-break: break-word;
		}

		#cupdir_wrapper #cupdir tbody td::before {
			display: none;
		}

		#cupdir_wrapper #cupdir tbody td:first-child {
			flex: 1 1 auto;
			font-weight: 700;
		}

		#cupdir_wrapper #cupdir tbody td:nth-child(2) {
			flex: 0 0 auto;
			font-weight: 400;
			text-align: right;
			white-space: nowrap;
		}

		#cupdir_wrapper #cupdir tbody td:nth-child(n + 3) {
			display: none;
		}

		#cupdir_wrapper .dataTables_paginate {
			justify-content: flex-start;
		}
	}
</style>

<div class="container">
	<div class="row">
		<div class="col-md-10">
			<h2 class="text-2xl font-bold text-slate-800"><?php echo $title ?></h2>
		</div>
		<div class="col-md-2 right">
			<div class="tp-language-row" aria-label="Language selection">
				<a href="?lang=swe" class="menu_link"><img src="assets/images/swe.png" alt="Swedish"></a>
				<a href="?lang=eng" class="menu_link"><img src="assets/images/eng.png" alt="English"></a>
				<a href="?lang=fin" class="menu_link"><img src="assets/images/fin.png" alt="Finnish"></a>
				<a href="?lang=nor" class="menu_link"><img src="assets/images/nor.png" alt="Norwegian"></a>
			</div>
		</div>
	</div>

	<div class="content">

		<table id="cupdir" class="table table-striped">
			<thead>
				<tr>
					<th><?php echo S_NAMN ?></th>
					<th><?php echo S_STARTDATUM ?></th>
					<th><?php echo S_SLUTDATUM ?></th>
					<th><?php echo S_ARRANGOR ?></th>
				</tr>
			</thead>
			<tbody>
				<?php render($cups, array('view' => '_cupdir')) ?>
			</tbody>
		</table>
	</div>
	</body>

	<script>
		$(document).ready(function() {
			var cupdirTable = $('#cupdir').DataTable({
				lengthMenu: [
					[15, 25, 50, -1],
					[15, 25, 50, "All"]
				],
				pageLength: 15,
				ordering: true,
				order: [
					[1, "<?php echo isset($_GET['completedcups']) ? 'desc' : 'asc'; ?>"]
				],
				language: {
					"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Swedish.json"
				}
			});

			function updateSortIndicators() {
				var currentOrder = cupdirTable.order();
				$('#cupdir thead th').removeAttr('data-sort-direction');
				$.each(currentOrder, function(index, sort) {
					$('#cupdir thead th').eq(sort[0]).attr('data-sort-direction', sort[1]);
				});
			}

			cupdirTable.on('order.dt', updateSortIndicators);
			updateSortIndicators();
		});
	</script>
</div>

<?php render('_footer') ?>