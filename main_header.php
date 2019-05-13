<header class="main-header">
	<!-- Logo -->
	<a href="../inicio/index.php" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><img src="../img/dgire_mini.png" alt="Intranet"></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><img src="../img/dgire_mini.png" alt="Intranet"><b> Gestor</b></span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->

	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
        
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="../style/dist/img/avatar5_oki.png" class="user-image" alt="User Image">
					<span class="hidden-xs"><?php echo $_SESSION['userInfo']->staff_nombre; ?></span>
                    <span id="liveclock" style="position:absolute;left:50px;top:10px; font-size:12px;"></span>
				</a>
				<ul class="dropdown-menu">
					<!-- User image -->
					<li class="user-header">
						<img src="../style/dist/img/avatar5_oki.png" class="img-circle" alt="User Image">
						<p><?php echo utf8_decode($_SESSION['userInfo']->nomRol); ?><small><?php echo $_SESSION['userInfo']->staff_sda;?></small></p>
					</li>
					<!-- Menu Footer-->
					<li class="user-footer">
						<div class="pull-right">
							<a href="../logout.php" class="btn btn-block btn-warning">Cerrar sesi&oacute;n</a>
						</div>
					</li>
				</ul>
				</li>
			</ul>
		</div>
	</nav>
<script>
function show5(){
        if (!document.layers&&!document.all&&!document.getElementById)
        return

         var Digital=new Date()
         var hours=Digital.getHours()
         var minutes=Digital.getMinutes()
         var seconds=Digital.getSeconds()

        var dn="PM"
        if (hours<12)
        dn="AM"
        if (hours>12)
        hours=hours-12
        if (hours==0)
        hours=12

         if (minutes<=9)
         minutes="0"+minutes
         if (seconds<=9)
         seconds="0"+seconds
        //change font size here to your desire
        myclock="<b></br>"+hours+":"+minutes+":"+seconds+" "+dn+"</b>"
        if (document.layers){
        document.layers.liveclock.document.write(myclock)
        document.layers.liveclock.document.close()
        }
        else if (document.all)
        liveclock.innerHTML=myclock
        else if (document.getElementById)
        document.getElementById("liveclock").innerHTML=myclock
        setTimeout("show5()",1000)
         }


        window.onload=show5
</script>
</header>