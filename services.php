


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
    <title>CFM Worship | Services</title>
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
<div id="myModal" style='width:85%;left:25%;height:80%' class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Rota information</h3>
  </div>
  <div class="modal-body" style='height:80%;'>
   
<iframe src='' id='planner_iframe' style='width:100%;height:100%; border:none;' scrolling='yes'></iframe>
   
   
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
 
  </div>
</div>
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
        <div class="span5">
          <div class="widget" >


     <?php
    


    #this one line of code is how you implement the class
    ########################################################
    ##

    $tblDemo = new ajaxCRUD("Service", "service", "idservice", "");

    ##
    ########################################################

        #add style
    
    $tblDemo->setCSSFile('bluedream.css');
  
    $tblDemo->defineRelationship("band_bandid", "band", "idband", "band_name");
   
    $tblDemo->displayAs("date", "Date");
    $tblDemo->displayAs("am_pm", "Time");
        $tblDemo->displayAs("band_bandid", "Team");
		$tblDemo->displayAs("idservice", " ");

    $tblDemo->setTextareaHeight('fldLongField', 200);
    
   # $tblDemo->addButtonToRow("Planner", "setlist.php", "idservice");

        //access control
    
    
    if ($permissions<'4'){

$tblDemo->disallowAdd();

$tblDemo->disallowDelete();



$tblDemo->disallowEdit('am_pm');
$tblDemo->disallowEdit('band_bandid');

 
        #only show future services to standard users.
    $tblDemo->addWhereClause("WHERE date  between (DATE_SUB(CURDATE(), INTERVAL 30 day)) and (DATE_ADD(CURDATE(), INTERVAL 30 day))");
}
if ($permissions=='5'){ $tblDemo->addWhereClause("WHERE date  > (DATE_SUB(CURDATE(), INTERVAL 30 day))");}

   
   $tblDemo->disallowEdit('date');

    $tblDemo->addOrderBy("ORDER BY date ASC");

    $tblDemo->turnOffAjaxADD();



    $tblDemo->formatFieldWithFunction('date', 'ukdate');
	$tblDemo->formatFieldWithFunction('idservice', 'people');
$tblDemo->omitField("Notes");

    $tblDemo->showTable();
    
    #my self-defined functions used for formatFieldWithFunction
    function ukdate($data){
        $date_s = strtotime($data);
		$new_date = date("d, F", $date_s);
        return "$new_date ";
    }
	
	function people($people){
	
	return "<a href='#' class='planner' data-toggle='modal' data-id='$people' ><img width='25' height='25' src=/images/icon-people.png /></a> <a href='setlist.php?idservice=$people' ><img width='25' height='25' src=/images/list.png /></a> ";
	}
    
#
?>
</div>




</div>

<div class='span7'>
	
	<div style='border:1px solid #dddddd; margin-bottom:20px;'>
		
		<h3>Rota information for ###</h3>
	</div>
	
	
		<div style='border:1px solid #dddddd'>
		
		<h3>Songs for ###</h3>
	</div>
	
	
	</div>



       </div>

      </div>

     

     

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
								   <script>
								   
	$(document).ready(function(){
   $(".planner").click(function(){ // Click to only happen on announce links
    var service_id = ($(this).data('id'));
	var url = "planner.php?idservice=";
	complete_url = url.concat(service_id);
	document.getElementById("planner_iframe").src = complete_url;
     $("#myModal").modal("show");
   });
});
								   
								   
								   </script>
  </body>
</html>

