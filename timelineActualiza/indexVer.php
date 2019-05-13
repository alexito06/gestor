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
                    <td><img src="../img/logo_dgire.png"></td>
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
                        <article>
                            <div class="inner">
                                <span class="date">
	                                <span class="month">Ene</span>
    	                            <span class="year">2017</span>
                                </span>
                                
								<div class="timeline-item">
									<h2 class="timeline-header"><a href="#">Support Team</a> sent you an email</h2>
									<div class="timeline-body">
                                    	<p class="fechas">22 de enero</p>
										<p>Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                      weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                      jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                      quora plaxo ideeli hulu weebly balihoo...</p>
                                       <ul>
	<li>El alumno, en línea, llena el expediente digital</li>
	<li>El profesor, en línea, llena el expediente digital</li>
</ul>
                                    </div>
                
                                    <div class="timeline-footer">
                                       <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                    
                                    <a class="btn btn-default waves-effect waves-light"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-primary waves-effect waves-light" ><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-success waves-effect waves-light"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-info waves-effect waves-light"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-warning waves-effect waves-light"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-danger waves-effect waves-light"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-link waves-effect waves-light"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            
            <a class="btn btn-border-default btn-rounded waves-effect"><span class="fa fa-external-link iconito"></span>&nbsp; ******</a>
            <a class="btn btn-border-primary btn-rounded waves-effect"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-border-success btn-rounded waves-effect"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-border-info btn-rounded waves-effect"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-border-warning btn-rounded waves-effect"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-border-danger btn-rounded waves-effect"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-link btn-rounded waves-effect"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                    </div>
                
                                  </div>
                                
                                
                                
                               <!-- <h2>Publicación de Convocatoria</h2>
                                <p tabindex="0"><span class="fechas">22 de enero</span>
                                
                                <ul>
	<li>El alumno, en línea, llena el expediente digital</li>
	<li>El profesor, en línea, llena el expediente digital</li>
</ul>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                    
                                    <a class="btn btn-default waves-effect waves-light"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-primary waves-effect waves-light" ><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-success waves-effect waves-light"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-info waves-effect waves-light"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-warning waves-effect waves-light"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-danger waves-effect waves-light"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-link waves-effect waves-light"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-border-default btn-rounded waves-effect"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-border-primary btn-rounded waves-effect"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-border-success btn-rounded waves-effect"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-border-info btn-rounded waves-effect"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-border-warning btn-rounded waves-effect"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-border-danger btn-rounded waves-effect"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
            <a class="btn btn-link btn-rounded waves-effect"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                    
                                </p>
                                <br>
                                <h2>Pre-registro de aspirantes</h2>
                                <p tabindex="0"><span class="fechas">23 de enero al 17 de febrero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                    <br>
                                    <br>
                                    <span style="display:block; text-align:center;">
                                    
                                    </span>
                                </p> -->
                            </div>
                        </article>
                        
                        <article>
                            <div class="inner">
                                <span class="date">
                                <!-- <span class="day">12</span> -->
                                <span class="month">Feb</span>
                                <span class="year">2017</span>
                                </span>
                                <h2>Registro de aspirantes</h2>
                                <p tabindex="0"><span class="fechas">24 de febrero al 9 de marzo</span>
                                    <br>
                                    <br>En las sedes establecidas por la COMIPEMS</p>
                            </div>
                        </article>
                        
                        <article>
                            <div class="inner">
                                <span class="date">
	                                <span class="month">Mar</span>
    	                            <span class="year">2017</span>
                                </span>
                                <h2>Publicación de Convocatoria</h2>
                                <p tabindex="0"><span class="fechas">22 de enero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                </p>
                                <br>
                                <h2>Pre-registro de aspirantes</h2>
                                <p tabindex="0"><span class="fechas">23 de enero al 17 de febrero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                    <br>
                                    <br>
                                    <span style="display:block; text-align:center;"><a href="https://notireslatoalla.com" target="_blank"></a></span>
                                </p>
                            </div>
                        </article>
                        
                        <article>
                            <div class="inner">
                                <span class="date">
	                                <span class="month">Abr</span>
    	                            <span class="year">2017</span>
                                </span>
                                <h2>Publicación de Convocatoria</h2>
                                <p tabindex="0"><span class="fechas">22 de enero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                </p>
                                <br>
                                <h2>Pre-registro de aspirantes</h2>
                                <p tabindex="0"><span class="fechas">23 de enero al 17 de febrero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                    <br>
                                    <br>
                                    <span style="display:block; text-align:center;"><a href="https://notireslatoalla.com" target="_blank"></a></span>
                                </p>
                            </div>
                        </article>
                        
                        <article>
                            <div class="inner">
                                <span class="date">
	                                <span class="month">May</span>
    	                            <span class="year">2017</span>
                                </span>
                                <h2>Publicación de Convocatoria</h2>
                                <p tabindex="0"><span class="fechas">22 de enero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                </p>
                                <br>
                                <h2>Pre-registro de aspirantes</h2>
                                <p tabindex="0"><span class="fechas">23 de enero al 17 de febrero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                    <br>
                                    <br>
                                    <span style="display:block; text-align:center;"><a href="https://notireslatoalla.com" target="_blank"></a></span>
                                </p>
                            </div>
                        </article>
                        
                        <article>
                            <div class="inner">
                                <span class="date">
                                <!-- <span class="day">5</span> -->
                                <span class="month">Jun</span>
                                <span class="year">2017</span>
                                </span>
                                <h2>Aplicación del Examen</h2>
                                <p tabindex="0"><span class="fechas">24 y 25 de junio</span>
                                </p>
                            </div>
                        </article>
                        
                        <article>
                            <div class="inner">
                                <span class="date">
	                                <span class="month">Jul</span>
    	                            <span class="year">2017</span>
                                </span>
                                <h2>Publicación de Convocatoria</h2>
                                <p tabindex="0"><span class="fechas">22 de enero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                </p>
                                <br>
                                <h2>Pre-registro de aspirantes</h2>
                                <p tabindex="0"><span class="fechas">23 de enero al 17 de febrero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                    <br>
                                    <br>
                                    <span style="display:block; text-align:center;"><a href="https://notireslatoalla.com" target="_blank"></a></span>
                                </p>
                            </div>
                        </article>
                        
                        <article>
                            <div class="inner">
                                <span class="date">
                                <!-- <span class="day">6</span> -->
                                <span class="month">Ago</span>
                                <span class="year">2017</span>
                                </span>
                                <h2>Publicación de resultados</h2>
                                <p tabindex="0"><span class="fechas">5 de agosto</span>
                                    <br>
                                    <br>En la <strong>Gaceta Electrónica:</strong>
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                </p>
                            </div>
                        </article>
                        
                        <article>
                            <div class="inner">
                                <span class="date">
	                                <span class="month">Sep</span>
    	                            <span class="year">2017</span>
                                </span>
                                <h2>Publicación de Convocatoria</h2>
                                <p tabindex="0"><span class="fechas">22 de enero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                </p>
                                <br>
                                <h2>Pre-registro de aspirantes</h2>
                                <p tabindex="0"><span class="fechas">23 de enero al 17 de febrero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                    <br>
                                    <br>
                                    <span style="display:block; text-align:center;"><a href="https://notireslatoalla.com" target="_blank"></a></span>
                                </p>
                            </div>
                        </article>
                        
                        <article>
                            <div class="inner">
                                <span class="date">
	                                <span class="month">Oct</span>
    	                            <span class="year">2017</span>
                                </span>
                                <h2>Publicación de Convocatoria</h2>
                                <p tabindex="0"><span class="fechas">22 de enero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                </p>
                                <br>
                                <h2>Pre-registro de aspirantes</h2>
                                <p tabindex="0"><span class="fechas">23 de enero al 17 de febrero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                    <br>
                                    <br>
                                    <span style="display:block; text-align:center;"><a href="https://notireslatoalla.com" target="_blank"></a></span>
                                </p>
                            </div>
                        </article>
                        
                        <article>
                            <div class="inner">
                                <span class="date">
	                                <span class="month">Nov</span>
    	                            <span class="year">2017</span>
                                </span>
                                <h2>Publicación de Convocatoria</h2>
                                <p tabindex="0"><span class="fechas">22 de enero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                </p>
                                <br>
                                <h2>Pre-registro de aspirantes</h2>
                                <p tabindex="0"><span class="fechas">23 de enero al 17 de febrero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                    <br>
                                    <br>
                                    <span style="display:block; text-align:center;"><a href="https://notireslatoalla.com" target="_blank"></a></span>
                                </p>
                            </div>
                        </article>
                        
                        <article>
                            <div class="inner">
                                <span class="date">
	                                <span class="month">Dic</span>
    	                            <span class="year">2017</span>
                                </span>
                                <h2>Publicación de Convocatoria</h2>
                                <p tabindex="0"><span class="fechas">22 de enero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                </p>
                                <br>
                                <h2>Pre-registro de aspirantes</h2>
                                <p tabindex="0"><span class="fechas">23 de enero al 17 de febrero</span>
                                    <br>
                                    <br>En la página de Internet de la COMIPEMS:
                                    <br>
                                    <a href="https://www.comipems.org.mx" class="btn btn-link boton waves-effect waves-light" tabindex="0" target="_blank"><span class="fa fa-external-link iconito"></span>&nbsp; www.comipems.org.mx</a>
                                    <br>
                                    <br>
                                    <span style="display:block; text-align:center;"><a href="https://notireslatoalla.com" target="_blank"></a></span>
                                </p>
                            </div>
                        </article>
                        
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

<?php } else { header("Location: http://www.dgire.unam.mx"); 
}require_once("../copyright2.php"); require_once("../footer.php"); ?>