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
//print_r ($_SESSION['userInfo']);
if($_SESSION['userInfo']->rol!=0){

require_once("../main_header.php"); 
require_once("../menu.php"); 
?>      
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
</div><!-- /.content-wrapper -->

<?php }else{ 
//require_once("../main_header_access.php"); 
?>

      <div class="content-wrapper">
        <div class="container">
        	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<div class="callout callout-danger">
				<center><h1>Acceso denegado para el sistema</h1></center>
                <?php //echo "<meta http-equiv=\"refresh\" content=\"1; url=../acceso/index.php\"/>"; ?>
			</div>
		</div><!-- /.container -->
      </div><!-- /.content-wrapper -->
<?php } require_once("../copyright.php"); require_once("../footer.php"); ?>