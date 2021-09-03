<div class="content-header row">
	<div class="content-header-left col-md-6 col-12 mb-2">
		<h3 class="content-header-title ml-1">Menu</h3>
	</div>
</div>
<div class="content-body">
	<section id="description" class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-6">
					<h4 class="card-title">Tabel Menu</h4>
				</div>
				<div class="col-6">
					<button type="button" class="btn btn-primary float-right add_menu"><i class="fa fa-plus"></i> Tambah Menu</button>
				</div>
			</div>
		</div>
		<div class="card-content">
			<div class="card-body">
				<div class="row">
					<table class="table table-bordered table-sm table-hover" id="table_menu">
						<thead>
							<tr>
								<th style="width: 10%;">No</th>
								<th style="width: 80%;">Menu</th>
								<th style="width: 10%;"></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- Role -->
<div class="modal fade text-left" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="modalMenu" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<form method="post" id="form_add_menu">
				<div class="modal-header">
					<h4 class="modal-title titleModal" id="modalMenu"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="role">User Role</label>
						<select class="form-control" id="role" name="role">
							<option selected>Pilih Role...</option>
							<?php foreach ($role as $row) {
								echo '<option value="' . $row['role'] . '">' . $row['role'] . '</option>';
							}
							?>
						</select>
						<small><span class="text-danger" id="error_role"></span></small>
					</div>
					<div class="form-group">
						<label for="menu">Nama Menu</label>
						<input type="text" id="menu" name="menu" class="form-control">
						<small><span class="text-danger" id="error_menu"></span></small>
					</div>
					<div class="form-group">
						<label for="icon">Icon</label>
						<input type="text" id="icon" name="icon" class="form-control">
						<small><span class="text-danger" id="error_icon"></span></small>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="action" name="action">
					<input type="hidden" id="id" name="id">
					<button type="button" class="btn" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp; Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		// Button Add
		$('.add_menu').click(function() {
			$('#modalMenu').modal('show');
			$('.titleModal').text('Tambah Menu');
			$('#menu').val('');
			$('#error_menu').text('');
			$('#id').val('');
			$('#action').val('add');
		});

		// Datatables Menu
		dataTable = $('#table_menu').DataTable({
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo base_url(); ?>master/tableMenu",
				"type": "POST",
			},
			columnDefs: [{
				orderable: !1,
				targets: [0]
			}],
			autoWidth: !1
		});


		// Add Menu
		$(document).on('submit', '#form_add_menu', function(event) {
			event.preventDefault();
			var menu = $('#menu').val();
			var icon = $('#icon').val();
			var error_menu = $('#error_menu').val();
			var error_icon = $('#error_icon').val();

			if ($('#menu').val() == '') {
				error_menu = 'Menu tidak boleh kosong';
				$('#error_menu').text(error_menu);
				menu = '';
			} else {
				error_menu = '';
				$('#error_menu').text(error_menu);
				menu = $('#menu').val();
			}

			if ($('#icon').val() == '') {
				error_icon = 'Icon tidak boleh kosong';
				$('#error_icon').text(error_icon);
				icon = '';
			} else {
				error_icon = '';
				$('#error_icon').text(error_icon);
				icon = $('#icon').val();
			}

			if (error_menu != '' || error_icon != '') {
				alert("Data Belum Lengkap!");
			} else {
				$.ajax({
					url: '<?php echo base_url(); ?>master/addMenu',
					method: 'POST',
					data: new FormData(this),
					contentType: false,
					processData: false,
					success: function(data) {
						$('#form_add_menu')[0].reset();
						$('#modalMenu').modal('hide');
						dataTable.ajax.reload();
						alert(data);
					}
				});
			}
		});

		// Edit Menu
		$(document).on('click', '.edit', function() {
			var id = $(this).attr('id');

			$.ajax({
				url: '<?php echo base_url(); ?>master/fetchSingleMenu',
				method: 'POST',
				data: {
					id: id
				},
				dataType: 'JSON',
				success: function(data) {
					$('#modalMenu').modal('show');
					$('.titleModal').text('Edit Menu');
					$('#menu').val(data.menu);
					$('#icon').val(data.icon);
					$('#role').val(data.role);
					$('#id').val(id);
					$('#action').val('edit');
				}
			});
		});

		// Delete Menu
		$(document).on('click', '.delete', function() {
			var id = $(this).attr('id');

			if (confirm("Hapus data ini?")) {
				$.ajax({
					url: '<?php echo base_url(); ?>master/deleteMenu',
					method: 'POST',
					data: {
						id: id
					},
					success: function(data) {
						alert(data);
						dataTable.ajax.reload();
					}
				});
			}
		});
	});
	// End Document Ready
</script>