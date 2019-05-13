<?php
$aditionalHeader = <<<ADHEAD
<script src="../plugins/numeric/jquery.numeric.js"></script>
<script type="text/javascript" src="../plugins/bvalidator/jquery.validate.min.js"></script>
<!-- date-picker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- date picker -->
<link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
<!-- Español -->
<script src="../plugins/datepicker/locales/bootstrap-datepicker.es.js"></script>
<!--validator-->
<script src="../plugins/bvalidator/jquery.validate.min.js"></script>
ADHEAD;
?>

<?php
require_once("../header.php");
?>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

<?php 
session_start();

//if($_SESSION['userInfo']->rol!=0){
if(1!=0){

require_once("../main_header.php"); 
require_once("../menu.php"); 
?>
   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
		<form method="post" id="profileForm">
					<div class="box box-primary">

					<div class="box-header">
					<h2> Gestor de Avisos</h2>
					</div>

					<div class="box-body">


					<div class="form-group col-md-9">
						<label>Area o Departamento:</label>
						<select class="form-control" id="departamentos" name="departamentos"></select>
					</div>

					<div class="form-group col-md-9">
						<label class="control-label" for="inputname">Nombre </label>
						<select class="form-control" id="personas" name="personas"></select>
					</div>

					<div class="form-group col-md-9">
						<label>Selecciona tipo de Documento &oacute; Modificaci&oacute;n</label>
						<select class="form-control" id="documento" name="documento">
									<option value="">Seleccione ...</option>
									<option value="Aviso">Aviso</option>
									<option value="Cambio de Información">Cambio de Informaci&oacute;n</option>
									<option value="Cambio en Servicios en Linea">Cambio en Servicios en Linea</option>
									<option value="Circular">Circular</option>
									<option value="Convocatoria">Convocatoria</option>
						</select>
					</div>

					<div class="form-group col-md-9">
						<label>&iquest;Se publicar&aacute; en el carrousel central?</label>
						<br>
						<td>
						<input type="radio" value="1" name="mipublicacion" id="mipublicacion" class="si">
						S&iacute;
						</td>
						<td>
						<input type="radio" value="0" name="mipublicacion" id="mipublicacion" class="no">
						No
						</td>
					</div>

					<div class="form-group fecha" style="display:none">
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

					<div class="col-md-12">
						<div class="col-md-6">
							<div class="col-md-9">
								<label for="exampleInputFile">Buscar Archivo</label>
								<input type="file" id="miArchivo" name="miArchivo">
							</div>

							<div class="col-md-9">
								<label for="exampleInputFile">Buscar Archivo 2</label>
								<input type="file" id="archivo2" name="archivo2">
							</div>

							<div class="col-md-9">
								<label for="exampleInputFile">Buscar Archivo 3</label>
								<input type="file" id="archivo3" name="archivo3">
							</div>

							<div class="col-md-9">
								<label for="exampleInputFile">Buscar Archivo 4</label>
								<input type="file" id="archivo4" name="archivo4">
							</div>
						</div>
						<div class="col-md-6">
							
						</div>
					</div>

					</div>

					<div class="box-footer">
						<button type="submit" class="btn btn-success" id="enviardatos"><span class="glyphicon glyphicon-send"></span> Enviar</button>
						<button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Limpiar</button>
					</div>
					</div>
					</form><!-- /.box-primary -->
	</section>
</div><!-- /.content-wrapper -->

<script>
$(function () {

		var timeout = 100000;
		var dataSend = new FormData();
		
		dataSend.append('task','getCatalogo');
		dataSend.task='getCatalogo';
		processData(dataSend);
		
		
		$("#departamentos").change(function(){
		
				dataSend.append('task','getPersonas');
				dataSend.append('gpo',$("#departamentos").val());

				dataSend.task = "getPersonas";
				processData(dataSend);
	
		});
		
		$(".no").click(function(){
		$(".fecha").hide();
		});
		$(".si").click(function(){
		$(".fecha").show();
		});
		
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

	$('#profileForm').on('init.field.fv', function(e, data) {

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
			personas: {
				validators: {
					notEmpty: {
						message: 'Campo obligatorio'
					}
				}
			},
			documento: {
				validators: {
					notEmpty: {
						message: 'Campo obligatorio'
					}
				}
			},
			fc_ini: {
				validators: {
					notEmpty: {
						message: 'Campo obligatorio'
					}
				}
			},
			fc_fin: {
				validators: {
					notEmpty: {
						message: 'Campo obligatorio'
					}
				}
			},
			miArchivo:{
				// The title field is placed inside .col-xs-8 element
				validators: {
					notEmpty: {
						message: 'Campo obligatorio'
					}
				}
			},
		}

	}).on('success.field.fv', function(e, data) {

		data.fv.disableSubmitButtons(false);

	}).on('success.form.fv', function(e) {
		
		// Prevent default form submission
		e.preventDefault();

		var $form = $(e.target),
			$button = $form.data('formValidation').getSubmitButton(),dataSend = new FormData();

		$('input[type="file"]').each(function($i){
			dataSend.append($(this).prop("id"), $(this)[0].files[0]);
		});

		var other_data = $('#profileForm').serializeArray();

		$.each(other_data,function(key,input){
			dataSend.append(input.name,input.value);
		});

		dialog.succes('El registro ha sido enviado con exito.',
			function(dialogWin){ 
			dialogWin.close();
			dialog.close();
				dataSend.append('task','getEnviardatos');
				dataSend.task='getEnviardatos';
				processData(dataSend);
			},'Aviso');

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

				switch(dataSend.task){

					case "getCatalogo":

					if(json.success){

						$("#departamentos").html(json.getInfo);

					} if(json.error) {

						

					}
					break;

					case "getPersonas":

					if(json.success){

						$("#personas").html(json.getPersona);

					}if(json.error) {
						dialog.alert(json.message)
					}

					break;
					case "privacidad":
						dialog.help(json.descripcion_aviso,function(dialogWin){ dialogWin.close(); },'Aviso')
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