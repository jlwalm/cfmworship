<?php include"auth_check_header.php"; ?>
<?php

    require_once('preheader.php');

    #the code for the class
    include ('ajaxCRUD.class.php');
    
    
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CFM Worship | Reports</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
 

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="index.php">CFM Worship</a>
          <div class="nav-collapse collapse">
            <?php

if($permissions=='5')
{
include ('adminmenu.php');
}
else
{
include ('menu.php');
}  

?>
            
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->


      <!-- Example row of columns -->
      <div class="row">
        <div class="span12">
          <div class="widget" >



 
 
 
 
    
    
    
    </div>
    
    
    
 

 <a href='report.php'>Back to Reports</a><br>
<?php
    $report_id = $_GET["id"];
error_reporting (E_ALL ^ E_NOTICE);
//connect to the database
require ('connect.php');




//Get query from reports table.
$get_query = mysql_query("select id, report_code from reports where id = '$report_id'");

//$song_name = mysql_query("select report_code from songs where idsongs = '$songname'");


//loop through the results and get song ID.
while ($row1 = mysql_fetch_array($get_query))
{

$show_report = mysql_query($row1['report_code']);

	  echo "<table><tr>";

//get column headers
      $i = 0; 
    while($i<mysql_num_fields($show_report)) 
    { 
      $meta=mysql_fetch_field($show_report,$i);


	  
      echo "<th>" . $meta->name."</th>"; 

	  
      $i++; 
    } 
	echo "</tr>";

	//put the data in.
	while ($row2 = mysql_fetch_array($show_report))
{	  

	  //loop through column headers
	  $j = 0; 
    while($j<mysql_num_fields($show_report)) 
    { 
      $meta=mysql_fetch_field($show_report,$j);

		$data = $meta->name;
	  
      echo "<td>";
	  echo $row2[$data];
	  echo "</td>"; 

	  
      $j++; 
    } 
	  echo "</tr>";
	  }
}

 
//loop through results for song count

//while ($row_count = mysql_fetch_array($song_count))

//{
//echo "<td><b> No. of times used:<b /></td>";
//echo "<td>";
//echo $row_count['total'];echo "</td></tr>";

//}

echo "</table>";



mysql_close($con);
?>





</div>




</div>


       </div>

      </div>

      <hr>

     

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>

  </body>
</html>

