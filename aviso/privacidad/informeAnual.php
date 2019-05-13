<?php
$aditionalHeader = <<<ADHEAD
  <!-- iCheck -->
	<link rel="stylesheet" href="../plugins/iCheck/skins/all.css">
	<script type="text/javascript" src="../plugins/bvalidator/jquery.validate.min.js"></script>
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
	<!-- Content Header (Page header) -->
    <section class="content-header">
	<h1>Informe Anual<small id="impPeriodo"></small></h1>
		<ol class="breadcrumb">
        	<li><img src="../img/alumnos.png" width="16"> Informe Anual -> <span id="impPeriodo2"></span></li>
		</ol>
	</section>
    
	<section class="content" id="tabla" >
		<div class="box box-primary">
			<div class="box-body">

				<div class="row">
                	<div class="col-md-12">
                        <div class="box-header with-border">
                            <h3 class="box-title"><a href="#" data-toggle="tooltip" title="" id="base"><i class="fa fa-database"></i></a> Datos del informe</h3><BR><span id="cicloEscolar" style="font-weight:bold;"></span></b>
                        </div><!-- /.box-header with-border -->
                        <br>
							<!--////////////////////////////////////////// -->
							<!--<table class="table table-striped" id="seccionDatos" border="0"></table> -->
                            <div class="box-body table-responsive no-padding">
								<table class="table table-bordered table-striped table-hover" id="seccionDatos" cellpadding="0" cellspacing="0"></table>
                            </div>
                        <br>
						<div class="box-header with-border"> 	
                            <h3 class="box-title"><a href="#" data-toggle="tooltip" title="" id="base2"><i class="fa fa-database"></i></a> Datos del informe</h3><BR><span id="cicloEscolar2" style="font-weight:bold;"></span></div>
                        <br>
                            <div class="box-body table-responsive no-padding">
								<table class="table table-bordered table-striped table-hover" id="seccionDatos2" cellpadding="0" cellspacing="0"></table>
                            </div>
                         <br>
							<!--////////////////////////////////////////// -->
					</div><!-- /.col-md-12 -->
                    
				</div><!-- /.row -->
			</div><!-- /.box-body -->
        </div><!-- /.box-primary -->
	</section>
</div><!-- /.content-wrapper -->

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
<?php } ?>
<script>
$(function () {

		var dataSend = {};
		var timeout = 10000000;
		
		$("input:text").addClass("ui-corner-all ui-widget-content");
		
		dataSend.task = "tipoIngresoAlumPlantel3";
		
		processData();

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
					//alert(dataSend.task)
					switch(dataSend.task){
						case "tipoIngresoAlumPlantel3":
							$("#seccionDatos").html(json.info);

							$("#seccionDatos2").html(json.info2);
							$("#impPeriodo").html(json.periodo);
							$("#impPeriodo2").html(json.periodo);
							$('#base').attr('title', json.base);
							

							$("#generaExcelB1").click(function(){
								//window.location =  'excel/excelAnual.php';
								dialog.remote('Una vez generado el archivo los datos no cambiaran con respecto a la base de datos, este proceso se corre cada ciclo escolar.',function(dialogWin){ dialogWin.close();
				
									dataSend.task = "generaInforme";
									dataSend.accionXML = 1;
									processData();
									
									} , 'Generaci&oacute;n de informe en archivo Excel', 'Generar archivo','fa fa-file-excel-o')
								
							});
							
							$("#generaExcelB2").click(function(){
								window.location =  'excel/informeFinal_16-17.xlsx';
							});

							break;
						case "generaInforme":
						
							$("#generaExcelB1").hide();
							$("#generaExcelB2").show();

							dialog.remote(json,function(dialogWin){
									dialogWin.close(); 
									window.location =  'excel/informeFinal_16-17.xlsx';
								} , 'Informe generado', 'Descargue su archivo','glyphicon glyphicon-cloud-download')

							$("#generaExcelB2").click(function(){
								window.location =  'excel/informeFinal_16-17.xlsx';
							});

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
						msg = "Error en la conexion";
					}
					dialog.alert(msg)
					return false;
				}
			});
		}
		
	});		
	/*********************************************************************************/
	
</script>
<?php require_once("../copyright.php"); require_once("../footer.php"); ?>