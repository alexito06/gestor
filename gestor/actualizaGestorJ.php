<?php
$aditionalHeader = <<<ADHEAD
	<!-- iCheck -->
	<link rel="stylesheet" href="../plugins/iCheck/skins/all.css">
<!-- date-picker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- date picker -->
<link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
<!-- Español -->
<script src="../plugins/datepicker/locales/bootstrap-datepicker.es.js"></script>
<!--validator-->
<script src="../plugins/bvalidator/jquery.validate.min.js"></script>
<!--Data Table-->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>
<style>
td.details-control {
    background: url("../img/details_open.png") no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url("../img/details_close.png") no-repeat center center;
}
</style>
ADHEAD;
?>
<?php 
require_once("../header.php"); 
session_start();
?>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
<?php 
//print_r($_SESSION);
//if($_SESSION['userInfo']->rol!=0){
if(1!=0){ 

require_once("../main_header.php"); 
require_once("../menu.php"); 
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


	<section class="content" id="tabla">
		<div class="box box-primary">
			<div class="box-header">
				<h2> Gestor de Avisos</h2>
			</div>

			<div class="box-body">
				<div class="row">
					<div class="col-md-12">

						<div class="box-body no-padding">
								<table class="table table-bordered table-striped table-hover table-sorter filterable" id="getSolicitudes" cellpadding="0" cellspacing="0"></table>
						</div>

					</div>
                    <!-- /.col-md -->
				</div><!-- /.row -->
			</div><!-- /.box-body -->
		</div><!-- /.box-primary -->

	</section>
	<section class="content" id="form2" style="display:none">
		<form method="post" id="profileForm2">
		<div class="box box-primary col-md-12">
			<div class="box-header"><h3> Edita registro</h3></div>
			<div class="box-body">
				<div>
				<div class="form-group col-md-9">
					<input type="hidden" class="form-control" id="id" name="id">
					<label>Area o Departamento:</label>
					<input type="text" class="form-control" placeholder="" id="area" name="area" readonly>
				</div>
				<div class="form-group col-md-9">
					<label class="control-label" for="inputname">Nombre: </label>
					<input type="text" class="form-control" placeholder="" id="usuario" name="usuario" readonly>
				</div>
				<div class="form-group col-md-9">
						<label>Selecciona tipo de Documento &oacute; Modificaci&oacute;n</label>
						<select class="form-control" id="documento" name="documento">
							<option value="">Seleccione ...</option>
									<option value="Aviso">Aviso</option>
									<option value="Cambio de Información">Cambio de Información</option>
									<option value="Cambio en Servicios en Linea">Cambio en Servicios en Linea</option>
									<option value="Circular">Circular</option>
									<option value="Convocatoria">Convocatoria</option>
						</select>
				</div>

					<div class="form-group col-md-9">
						<label>&iquest;Se publicar&aacute; en el carrousel central?</label>
						<br>
						<td>
						<input type="radio" value="1" name="mipublicacion" id="mipublicacion1">
						S&iacute;
						</td>
						<td>
						<input type="radio" value="0" name="mipublicacion" id="mipublicacion1">
						No
						</td>
					</div>


					<div class="form-group fecha">
						<div class="col-md-4">
							<label>Inicio de la Publicaci&oacute;n</label>
							<div class="input-group">
							<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
							</span>
							<input type="text" class="form-control" id="fc_ini" name="fc_ini">
							</div>
						</div>

						<div class="col-md-4">
							<label>Fin de la Publicaci&oacute;n</label>
							<div class="input-group">
							<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
							</span>
							<input type="text" class="form-control" id="fc_fin" name="fc_fin">
							</div>
						</div>
					</div>

					<div class="form-group col-md-9">
						<label>Observaciones :</label>
						<textarea class="form-control" rows="3" placeholder="Escribe ..." id="observaciones" name="observaciones"></textarea>
					</div>

					<div class="col-md-9" id="info">
					</div>

					</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-success update" id=""><span class="glyphicon glyphicon-send"></span> Actualizar</button>
				<button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Limpiar</button>
				<a class="btn btn-warning back" role="button"><span class="fa fa-reply"></span> Regresar</a>

			</div>
		</div>

		</form>



</div><!-- /.content-wrapper -->
<script>
$(function () {


		var timeout = 100000;
		var dataSend = new FormData();

		dataSend.append('task','getSolicitudes');
		dataSend.task='getSolicitudes';
		processData(dataSend);

/*		$(".no").click(function(){
		$(".fecha").hide();
		});
		$(".si").click(function(){
		$(".fecha").show();
		});*/

		$('#fc_ini').datepicker({
			format: "yyyy/mm/dd",
			startDate: "0+",
			startView: 1,
			maxViewMode: 1,
			clearBtn: true,
			language: "es",
			daysOfWeekDisabled: "",
			todayHighlight: true,
			toggleActive: true
		});
		$('#fc_fin').datepicker({
			format: "yyyy/mm/dd",
			startDate: "0+",
			startView: 1,
			maxViewMode: 1,
			clearBtn: true,
			language: "es",
			daysOfWeekDisabled: "",
			todayHighlight: true,
			toggleActive: true
		});

	$('#profileForm2').on('init.field.fv', function(e, data) {

		var $icon = data.element.data('fv.icon'),options = data.fv.getOptions(),validators = data.fv.getOptions(data.field).validators;

		if (validators.notEmpty && options.icon && options.icon.required) {$icon.addClass(options.icon.required).show(); }

		}).
	formValidation({

		framework: 'bootstrap',
		excluded: [':disabled, :not(:visible)'],
		icon: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			departamentos:{
				// The title field is placed inside .col-xs-8 element
				validators: {
					notEmpty: {
						message: 'Campo obligatorio'
					}
				}
			},
			/*fc_ini1: {
				validators: {
					notEmpty: {
						message: 'Campo obligatorio'
					}
				}
			},
			fc_fin1: {
				validators: {
					notEmpty: {
						message: 'Campo obligatorio'
					}
				}
			},*/
			/*miArchivo:{
				// The title field is placed inside .col-xs-8 element
				validators: {
					notEmpty: {
						message: 'Campo obligatorio'
					}
				}
			},*/
		}

	}).on('success.field.fv', function(e, data) {

		data.fv.disableSubmitButtons(false);

	}).on('success.form.fv', function(e) {
		
		// Prevent default form submission
		e.preventDefault();

		var $form = $(e.target),
			$button = $form.data('formValidation').getSubmitButton(),dataSend = new FormData();

		$('input[type="file"]').each(function($i){
//alert('entra'+$(this).prop("id"))
			dataSend.append($(this).prop("id"), $(this)[0].files[0]);
		});

		var other_data = $('#profileForm2').serializeArray();

			$.each(other_data,function(key,input){
				dataSend.append(input.name,input.value);
			});
		console.log(dataSend);
		dialog.confirm('Si deseas actualizar el registro da click en <b>Enviar</b> en caso contrario <b>Cerrar</b> para Cancelar.', 
			function(dialogWin){ 
			dialogWin.close();
			dialog.close();
				dataSend.append('task','getActualizaform');
				dataSend.task='getActualizaform';
				processData(dataSend);
			}, 'Actualizar registro');

		

	});

	function processData(dataSend) {	

		$.ajax({
			type: "POST",
			url: 'procesaInformacion.php',
			data: dataSend,
			dataType: "json",
			timeout: timeout,
			processData: false,
			contentType: false,
			beforeSend: function() { dialog.show(); },
			complete: function(){ dialog.close(); },
			success: function(json) {
			//console.log(dataSend.task);
				switch(dataSend.task){
				case "getSolicitudes":
					if(json.success){
					dialog.close();
						$("#getSolicitudes").html(json.getSolicitudes);

						/************Filtrar Tabla************/

						$('#getSolicitudes').DataTable({
							"responsive": true,
							"destroy": true,
							"scrollX": true,
							//"retrieve": true,
							//"stateSave": true,
							"lengthMenu": [[ 5, 10, 20, -1], [5, 10, 20, "Todo"]],
							"info" : false,
							"language":{
								"lengthMenu": "Mostrar _MENU_ registros por p&aacute;gina.",
								"zeroRecords": "Lo sentimos. No se encontraron registros.",
								"info": "Mostrando p&aacute;gina _PAGE_ de _PAGES_",
								"infoEmpty": "No hay registros a&uacute;n.",
								"infoFiltered": "(filtrados de un total de _MAX_ registros)",
								"search" : "B&uacute;scar",
								"LoadingRecords": "Cargando ...",
								"Processing": "Procesando...",
								"SearchPlaceholder": "Comience a teclear...",
							"paginate": {
								"previous": "Anterior",
								"next": "Siguiente", 
							},
							"columns": [
								{
									"className":	'details-control'
								},
							]
							}
						});

// Add event listener for opening and closing details
    $('#getSolicitudes tbody').on('click', 'td.details-control', function () {
    	console.log('entra');
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

						/*************Actualiza Estado***********/
						$('.status').on( 'click', function() {
							var st=$(this).val();
							console.log(st);

								dataSend.append('id',st);
								dataSend.append('task','getActEstado');
								dataSend.task = "getActEstado";

							if( $('#'+st).is(':checked') == false){
								dataSend.append('accion','noAtendido');
							} else{
								dataSend.append('accion','Atendido');
							}
								processData(dataSend);
								dialog.close();

						});
						/***********Editar Registro************/
						$('.edit').on( 'click', function() {
							var st=$(this).val();
							console.log(st);

								dataSend.append('id',st);
								dataSend.append('task','getEditaform');
								dataSend.task = "getEditaform";
								processData(dataSend);

						});
						/************Borrar Registro**********/
						$('.delete').click(function() {
							var eliminar=$(this).val();
							dialog.erase('Si deseas eliminar el registro da click en <b>Eliminar</b> en caso contrario <b>Cancelar</b>.', 
								function(dialogWin){ 
								dialogWin.close();
									dataSend.append('task','getEliminaform');
									dataSend.append('accion','elimina');
									dataSend.append('id',eliminar);
								dataSend.task = "getEliminaform";
								processData(dataSend);
								dialog.close();
							}, 'Eliminar registro');
						
						});

						/**********Oculta Formulario***********/
						$(".back").click(function(){
							$("#form2").hide();
							$("#tabla").show();

						dataSend.append('task','getSolicitudes');
						dataSend.task='getSolicitudes';
						processData(dataSend);
						});
					} else {
						
					}
				break;

				case "getActEstado":

					if(json.success){

						dataSend.append('task','getSolicitudes');
						dataSend.task='getSolicitudes';
						processData(dataSend);

					}if(json.error) {
						dialog.alert(json.message)
					}

				break;
				case "getEditaform":

					if(json.success){
					$("#id").val(json.id);
					$("#area").val(json.area);
					$("#usuario").val(json.usuario);
					$("#documento").val(json.modificacion);
					$("#mipublicacion").val(json.publicacion);

						if($("#mipublicacion1").val() ==1){  
							$('input:radio[name=mipublicacion]')[0].checked = true;
							}else {
							$('input:radio[name=mipublicacion]')[1].checked = true;
						}

					$("#fc_ini").val(json.fc_ini);
					$("#fc_fin").val(json.fc_fin);
					$("#observaciones").val(json.observaciones);
					//$("#files").html(json.files);
					$("#info").html(json.info);
					$("#miArchivo").val(json.id_archivo);

						/**************Eliminar Archivo************/
					$('.delFile').click(function() {
						var ba=$(this).val();
						//console.log(ba);

							dataSend.append('id',ba);
							dataSend.append('task','eliminaArchivo');
							dataSend.task = "eliminaArchivo";
							processData(dataSend);


					});

					/************************Muestra Formulario********************/
					$("#tabla").hide();
					$("#form2").show();

					}if(json.error) {
						dialog.alert(json.message)
					}

				break;
				case "getEliminaform":

					if(json.success){

						dataSend.append('task','getSolicitudes');
						dataSend.task='getSolicitudes';
						processData(dataSend);

					}if(json.error) {
						dialog.alert(json.message)
					}

				break;
				case "getActualizaform":

					if(json.success){

					}if(json.error) {
						dialog.alert(json.message)
					}

				break;

				default:
				break;
			}
			return false;
			},
			error: function(jqXHR, textStatus, errorThrown) {
				dialog.close();
				msg = "";
				if (textStatus == "timeout") {
					msg = "tiempo agotado";
				} else {
					//msg = messageCommon.errorSend;
					msg = "Error en la conexi&oacute;n";
				}
				dialog.alert(msg)
				return false;
			}
		});
	
	}	



	});	

</script>


<?php }else{ 
require_once("../main_header_access.php"); 
?>

	<div class="content-wrapper">
		<div class="container">
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<div class="callout callout-danger">
				<center><h1>Acceso denegado para el sistema</h1></center>
				<?php echo "<meta http-equiv=\"refresh\" content=\"1; url=../acceso/index.php\"/>"; ?>
			</div>
		</div><!-- /.container -->
	</div><!-- /.content-wrapper -->
<?php } require_once("../copyright.php"); require_once("../footer.php"); ?>