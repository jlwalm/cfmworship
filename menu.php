<html>

<body>

<ul class="nav">

<li><a href="index.php">Home</a></li>

<li><a href="services.php">Services</a></li> 

<li><a href="songs.php">Songs</a></li>

<li><a href="report.php">Reports</a></li>

<li><a href="help.pdf" target="_blank">Help</a></li>



</ul>

<div class="navbar-form pull-right">
             <ul class='nav'><li><a>
             
             
             <?php $display = explode("@", $_COOKIE["CFMW"]);echo $display[0]; ?></a></li> <li><a href='logout.php'>Logout</a></li></ul>
            </div>

</body>

</html>
