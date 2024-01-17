<footer class="footer">
                <div class="container-fluid">
                    <div class="copyright ml-auto">
                        2024, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://www.teknisiimei.online/lokasi">FinalProject</a>
                    </div>				
                </div>
            </footer>
		</div>
	</div>
	<!--   Core JS Files   -->
	<script src="<?= base_url('assets/js/core/jquery.3.2.1.min.js')?>"></script>
	<script src="<?= base_url('assets/js/core/popper.min.js')?>"></script>
	<script src="<?= base_url('assets/js/core/bootstrap.min.js')?>"></script>

	<!-- jQuery UI -->
	<script src="<?= base_url('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')?>"></script>
	<script src="<?= base_url('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')?>"></script>

	<!-- jQuery Scrollbar -->
	<script src="<?= base_url('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')?>"></script>

	<!-- Moment JS -->
	<script src="<?= base_url('assets/js/plugin/moment/moment.min.js')?>"></script>

	<!-- Chart JS -->
	<script src="<?= base_url('assets/js/plugin/chart.js/chart.min.js')?>"></script>

	<!-- jQuery Sparkline -->
	<script src="<?= base_url('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')?>"></script>

	<!-- Chart Circle -->
	<script src="<?= base_url('assets/js/plugin/chart-circle/circles.min.js')?>"></script>

	<!-- Datatables -->
	<script src="<?= base_url('assets/js/plugin/datatables/datatables.min.js')?>"></script>

	<!-- Bootstrap Notify -->
	<script src="<?= base_url('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')?>"></script>

	<!-- Bootstrap Toggle -->
	<script src="<?= base_url('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js')?>"></script>

	<!-- jQuery Vector Maps -->
	<script src="<?= base_url('assets/js/plugin/jqvmap/jquery.vmap.min.js')?>"></script>
	<script src="<?= base_url('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')?>"></script>

	<!-- Google Maps Plugin -->
	<script src="<?= base_url('assets/js/plugin/gmaps/gmaps.js')?>"></script>

	<!-- Dropzone -->
	<script src="<?= base_url('assets/js/plugin/dropzone/dropzone.min.js')?>"></script>

	<!-- Fullcalendar -->
	<script src="<?= base_url('assets/js/plugin/fullcalendar/fullcalendar.min.js')?>"></script>

	<!-- DateTimePicker -->
	<script src="<?= base_url('assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js')?>"></script>

	<!-- Bootstrap Tagsinput -->
	<script src="<?= base_url('assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js')?>"></script>

	<!-- Bootstrap Wizard -->
	<script src="<?= base_url('assets/js/plugin/bootstrap-wizard/bootstrapwizard.js')?>"></script>

	<!-- jQuery Validation -->
	<script src="<?= base_url('assets/js/plugin/jquery.validate/jquery.validate.min.js')?>"></script>

	<!-- Summernote -->
	<script src="<?= base_url('assets/js/plugin/summernote/summernote-bs4.min.js')?>"></script>

	<!-- Select2 -->
	<script src="<?= base_url('assets/js/plugin/select2/select2.full.min.js')?>"></script>

	<!-- Sweet Alert -->
	<script src="<?= base_url('assets/js/plugin/sweetalert/sweetalert.min.js')?>"></script>

	<!-- Owl Carousel -->
	<script src="<?= base_url('assets/js/plugin/owl-carousel/owl.carousel.min.js')?>"></script>

	<!-- Magnific Popup -->
	<script src="<?= base_url('assets/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js')?>"></script>

	<!-- Atlantis JS -->
	<script src="<?= base_url('assets/js/atlantis.min.js')?>"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<!-- <script src="../assets/js/setting-demo.js"></script> -->
	<?php
	$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if (strpos($actual_link, 'nasabah/index.php') !== false ) { ?>
		<script src="<?= base_url('assets/js/demo.js')?>"></script>
	<?php } ?>

	<script>
		$('#lineChart').sparkline([102,109,120,99,110,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#177dff',
			fillColor: 'rgba(23, 125, 255, 0.14)'
		});

		$('#lineChart2').sparkline([99,125,122,105,110,124,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#f3545d',
			fillColor: 'rgba(243, 84, 93, .14)'
		});

		$('#lineChart3').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
		
		$(document).ready(function(){
			$('#tabel-data').DataTable();
		});
		
		$( '#single-select-field' ).select2( {
			theme: "bootstrap-5",
			width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
			placeholder: $( this ).data( 'placeholder' ),
		} );

		
	</script>
	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
	<script>
	function showFields() {
		var kategoriSelect = document.getElementById("kategoriSelect");
		var nominalKeteranganFields = document.getElementById("nominalKeteranganFields");
		var keteranganFields = document.getElementById("keterangan");
		var tenorFields = document.getElementById("tenorFields");

		if (kategoriSelect.value === "tabungan") {
			nominalKeteranganFields.style.display = "block";
			keteranganFields.style.display = "block";
			pinjamanNominal.style.display = "none";
			nominalFooter.style.display = "block"
			tenorFields.style.display = "none";
			pinjamanFooter.style.display = "none";
		} else if (kategoriSelect.value === "pinjaman") {
			pinjamanNominal.style.display = "block";
			tenorFields.style.display = "block";
			nominalFooter.style.display = "none"
			nominalKeteranganFields.style.display = "none";
			keteranganFields.style.display = "none";
			pinjamanFooter.style.display = "block";
		} else {
			pinjamanNominal.style.display = "none";
			nominalKeteranganFields.style.display = "none";
			keteranganFields.style.display = "none";
			nominalFooter.style.display = "none"
			tenorFields.style.display = "none";
			pinjamanFooter.style.display = "none";
		}

	}

	function validateNominal() {
		var saldoNasabah = <?= countSaldo($_SESSION['nasabah']->id_user)->SALDO ?>;
		var inputNominal = document.getElementById("nominal").value;
		saldoNasabah = parseFloat(saldoNasabah);
		inputNominal = parseFloat(inputNominal);
		var batasMaksimal = <?= countSaldo($_SESSION['nasabah']->id_user)->SALDO ?>;

		if (inputNominal > batasMaksimal) {
		var errorAlert = document.getElementById("errorAlert");
		errorAlert.innerHTML = "Nominal Melebihi Batas Saldo!";
		errorAlert.style.display = "block";
		keterangan.style.display = "none";
	} else {
		var errorAlert = document.getElementById("errorAlert");
		keterangan.style.display = "block";
		errorAlert.style.display = "none";
		}
	}

	
	function validateNominal2() {
		var saldoNasabah = <?= nasabahTenor()->SALDO * 10 / 100 ?>;
		var inputNominal = document.getElementById("pinjaman").value;
		saldoNasabah = parseFloat(saldoNasabah);
		inputNominal = parseFloat(inputNominal);
		var batasMaksimal = <?= nasabahTenor()->SALDO * 10 / 100 ?>;

		if (inputNominal > batasMaksimal) {
		var errorAlert = document.getElementById("errorAlert");
		errorAlert.innerHTML = "Nominal Melebihi Batas Limit!";
		errorAlert.style.display = "block";
		tenorFields.style.display = "none";
	} else {
		var errorAlert = document.getElementById("errorAlert");
		errorAlert.style.display = "none";
		tenorFields.style.display = "block";
		}
	}

</script>
</body>
</html>