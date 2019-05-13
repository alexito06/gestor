<?php
$aditionalHeader = <<<ADHEAD
<script src="../plugins/numeric/jquery.numeric.js"></script>
<script type="text/javascript" src="../plugins/bvalidator/jquery.validate.min.js"></script>
<script type="text/javascript" src="../plugins/download/download.jquery.js" ></script>
<link rel="stylesheet" href="../style/assets/css/timeline.css">
<link rel="stylesheet" href="../style/assets/css/mdb.css">

ADHEAD;
?>
<?php require_once("../header.php"); require_once("../common/clsMiCNXAcceso.php"); require_once("../common/config.php");

$datosAcceso= new acceso();
global $CONFIG;

//if ($datosAcceso->apertura_cierre_general(118)==1){
if (1==1){
?>
<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">

            <div class="navbar-header">
                <table height="150"><tr>
                <td><img src="../img/logo_unam.png"></td>
                <td><p id="titulo2">Universidad Nacional</p>
                <p id="subtitulo2">Aut&oacute;noma de M&eacute;xico</p></td>
                </tr></table>
            </div>

            
            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu hidden-xs">
                <ul class="nav navbar-nav">
                  <li class="dropdown tasks-menu">
                  </li>
                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <table align="right" height="150"><tr>
                    <td><p id="titulo">Direcci&oacute;n General de Incorporaci&oacute;n </p><p id="titulo">y Revalidaci&oacute;n de Estudios</p></td>
                    <td><img src="../img/dgire.png"></td>
                    </tr></table>
                  </li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
              
          </div><!-- /.container-fluid -->
        </nav>
      </header>
      
      <!-- Full Width Column -->
	<div class="content-wrapper">
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
        <br>
        <br>
        <!-- /Sección: Principal -->
	    </main>

	</div><!-- /.content-wrapper -->

    </div><!-- ./wrapper -->
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
<?php } else { header("Location: http://www.dgire.unam.mx"); 
}require_once("../copyright2.php"); require_once("../footer.php"); ?>