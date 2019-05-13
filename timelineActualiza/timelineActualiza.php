<?php
$aditionalHeader = <<<ADHEAD
	<script type="text/javascript" src="../plugins/bvalidator/jquery.validate.min.js"></script>
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <link rel="stylesheet" href="../style/assets/css/timeline.css">
	<link rel="stylesheet" href="../style/assets/css/mdb.css">
   	<!-- date-picker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- date picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Español -->
	<script src="../plugins/datepicker/locales/bootstrap-datepicker.es.js"></script>


ADHEAD;
?>
<?php 
require_once("../header.php"); ?>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
<?php 
session_start();

if($_SESSION['userInfo']->rol!=0){

require_once("../main_header.php"); 
require_once("../menu.php"); 


?>      
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<?php
/*$cadena = "<p>Calificaci&oacute;n, <strong>autorizaci&oacute;n</strong>, impresi&oacute;n y en caso de ser necesarios validaci&oacute;n de actas de ex&aacute;menes extraordinarios</p>";
echo $cadena;
$resultado = str_replace("<p>", "", $cadena);

$resultado = str_replace("</p>", "", str_replace("<p>", "", $cadena));

echo "La cadena resultante es: " . $resultado;
*/
?>
	<main id="maincontent" role="main" class="clearfix">

        <!-- Sección: Principal -->
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<br><br><br>
                    
					<section id="timeline">
                    
					</section>
				</div>
			</div>
		</div>
        <br><br>
        <!-- /Sección: Principal -->

	</main>
    
    <section class="content" id="tabla"  style="display:none;">
		<div class="box box-primary">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="box-header with-border">

							<h3 class="box-title"><a href="#" data-toggle="tooltip" title="" id="base"><i class="fa fa-database"></i></a></h3> &nbsp;<span class="box-title"><strong id="actividadTitulo"></strong></span></b>

                        	<div class="box-tools pull-right">
                				<button class="btn btn-block btn-success btn-sm" id="generaExcel" style="display:none;"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar a excel</button>
							</div>

                        </div>
                    
                        <!--////////////////////////////////////////// -->
                        <div class="box-body table-responsive no-padding">
                        	<table class="table table-bordered table-striped" id="seccionDatos" border="0" cellpadding="0" cellspacing="0"></table>
                        </div>
                        <!--////////////////////////////////////////// -->
					</div><!-- /.col-md -->
				</div><!-- /.row -->
                
                <div class="box-footer">
                    <button class="btn btn-danger" id="btnReset"><span class="fa fa-fw fa-mail-reply-all"></span>&nbsp;&nbsp;Seleccionar otra actividad</button>
                </div>
                
			</div><!-- /.box-body -->
        </div><!-- /.box-primary -->
	</section>
    
   	<section class="content" id="formulario"  style="display:none;">
		<div class="box box-primary">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="box-header with-border">
							<span class="box-title"><strong id="tareaTitulo"></strong></span></b>
                        </div>
						<div class="col-md-6">
                            <!--////////////////////////////////////////// -->
                            <div class="form-group">
								<label>Titulo</label>
								<input type="text" maxlength="300" class="form-control" placeholder="Titulo" name="tituloAct" id="tituloAct">
                            </div>
                            <div class="form-group">
                            	<label>Descripci&oacute;n</label>                           
								<textarea id="descripcion" name="descripcion" rows="10" cols="80">
								</textarea>
							</div>
                            <!--////////////////////////////////////////// -->
                        </div>
					</div><!-- /.col-md -->
				</div><!-- /.row -->
                
                <div class="box-footer">
                    <button class="btn btn-success" id="btnEnviar"><span class="fa fa-play-circle"></span>&nbsp;&nbsp;Enviar</button>
                    
                    <button class="btn btn-danger" id="btnTarea"><span class="fa fa-fw fa-mail-reply-all"></span>&nbsp;&nbsp;Seleccionar otra acci&oacute;n</button>
                </div>
                
			</div><!-- /.box-body -->
        </div><!-- /.box-primary -->
	</section>
    
    <section class="content" id="formularioF"  style="display:none;">
		<div class="box box-primary">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="box-header with-border">
							<span class="box-title"><strong id="tareaTitulo"></strong></span></b>
                        </div>
						<div class="col-md-6">
                            <!--////////////////////////////////////////// -->
                            <label>Rango de fechas</label>
                        	<div class="input-group input-daterange">
                                <input type="text" class="form-control ui-corner-all ui-widget-content" id="fechaIni" placeholder="DD/MM/YYYY">
                                <div class="input-group-addon">-</div>
                                <input type="text" class="form-control ui-corner-all ui-widget-content" id="fechaFin" placeholder="DD/MM/YYYY">
                            </div>
                            <!--////////////////////////////////////////// -->
                        </div>
					</div><!-- /.col-md -->
				</div><!-- /.row -->
                
                <div class="box-footer">
                    <button class="btn btn-success" id="btnEnviarF"><span class="fa fa-play-circle"></span>&nbsp;&nbsp;Enviar</button>
                    
                    <button class="btn btn-danger" id="btnTareaF"><span class="fa fa-fw fa-mail-reply-all"></span>&nbsp;&nbsp;Seleccionar otra acci&oacute;n</button>
                </div>
                
			</div><!-- /.box-body -->
        </div><!-- /.box-primary -->
	</section>
    
   

</div><!-- /.content-wrapper -->


<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script>
$(function () {

		CKEDITOR.replace('descripcion');
		$(".textarea").wysihtml5();

		var dataSend = {};
		var timeout = 10000000;
		
		$('.input-daterange input').each(function() {

			$(this).datepicker({
				pickTime: false,
				autoclose: true,
				orientation: 'top auto',
				startView: 1,
				format: "dd-mm-yyyy",
				language: 'es'
			});
	
		});

		$("input:text").addClass("ui-corner-all ui-widget-content");

		dataSend.task = "getCalendarioAdmin";

		processData();

		$("#btnReset").click(function(){
			$('#maincontent').show();
			$('#tabla').hide();
			dataSend.task = "getCalendarioAdmin";
			processData();
		});
		
		

		function processData() {

			$.ajax({
				type: "POST",
				url: 'procesaInformacion.php',
				data: dataSend,
				dataType: "json",
				timeout: timeout,
				beforeSend: function() {
					dialog.show();
				},
				success: function(json) {

					dialog.close();

					switch(dataSend.task){

						case "getCalendarioAdmin":

							$("#timeline").html(json.enviaArticle);

							$(".edita").click(function(){

								console.log($(this).val())

								$('#maincontent').hide();

								dataSend.task = "editActividad";
								dataSend.idActividad = $(this).val();
								processData();

							});

							$(".elimina").click(function(){
								console.log(json.actividad.id_actividad)
								dataSend.task = "clearActividad";
								dataSend.idActividad = json.actividad.id_actividad;
								processData();
							});

						break;
						case "editActividad":

							$('#tabla').show();
							$('#seccionDatos').html(json.info);
							$('#actividadTitulo').html(json.actividad.titulo);
							$('#base').attr('title', json.base);

							/////////////////////////////////////////
							$(".editaTD").click(function(){

								$('#tabla').hide();
								$('#formulario').show();

								$('#tituloAct').val(json.actividad.titulo);
								CKEDITOR.instances['descripcion'].setData(json.actividad.descripcion);
								$('#tareaTitulo').html('Actualiza la actividad');

								$("#btnTarea").click(function(){
									$('#formulario').hide();
									$('#tabla').show();
									
									dataSend.task = "editActividad";
									dataSend.idActividad = json.actividad.id_actividad;
									processData();

								});
								
								$("#btnEnviar").click(function(){

									$('#formulario').hide();
									$('#tabla').show();

									dataSend.task = "editActividadForm";
									dataSend.idActividad = json.actividad.id_actividad;
									dataSend.tituloAct = $('#tituloAct').val();
									dataSend.descripcion = CKEDITOR.instances.descripcion.getData();
									processData();

								});

							});
							/////////////////////////////////////////
							
							$(".eliminaTD").click(function(){

								console.log($(this).val())

							});
							
							$(".agregaF").click(function(){

								console.log($(this).val())
								
								var t=$(this).val();
								
								$('#tabla').hide();
								$('#formularioF').show();
								
								$("#btnTareaF").click(function(){
									$('#formularioF').hide();
									$('#tabla').show();
									
									dataSend.task = "editActividad";
									dataSend.idActividad = json.actividad.id_actividad;
									processData();

								});
								
								$("#btnEnviarF").click(function(){

									$('#formulario').hide();
									$('#tabla').show();

									dataSend.task = "agregaFechaActividadNivelForm";
									dataSend.idActividad_idNivel = t;
									dataSend.fechaIni = $("#fechaIni").val();
									dataSend.fechaFin = $("#fechaFin").val();
									processData();

								});

							});
							
							$(".editaF").click(function(){

								console.log($(this).val())
								
								$('#tabla').hide();
								$('#formularioF').show();

							});
							

							
							

						break;
						
						case "editActividadForm":
							dialog.close();

							$('#formulario').hide();
							$('#tabla').show();
									
							dataSend.task = "editActividad";
							dataSend.idActividad = json.actividad.id_actividad;
							processData();
						
						break;
						
						case "agregaFechaActividadNivelForm":
							dialog.close();

							$('#formulario').hide();
							$('#tabla').show();
									
							dataSend.task = "editActividad";
							dataSend.idActividad = json.actividad.id_actividad;
							processData();
						
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
	/*********************************************************************************/
	
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