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
    
    
    
    
    
    <?php


    #this one line of code is how you implement the class
    ########################################################
    ##

    $tblDemo = new ajaxCRUD("Report", "reports", "id", "");

    ##
    ########################################################
    $tblDemo->setCSSFile('bluedream.css');

    $tblDemo->displayAs("id", "Report ID");
    $tblDemo->displayAs("report_name", "Report Name");
	    $tblDemo->displayAs("report_description", "Description");

    $tblDemo->setTextareaHeight('fldLongField', 200);

    $tblDemo->addButtonToRow("Run", "run_report.php", "id");
            //access control
    
    
    if ($permissions<'5'){
$tblDemo->omitField("report_code");
$tblDemo->disallowAdd();

$tblDemo->disallowDelete();

$tblDemo->disallowEdit('report_name');

$tblDemo->disallowEdit('report_description');
  //      $tblDemo->disallowEdit('song_name');
    //            $tblDemo->disallowEdit('listen');
ECHO "<style>
a.hide{
display:none;}

</style>";

}
    

    
    
    


    #i can order my table by whatever i want
  //  $tblDemo->addOrderBy("ORDER BY song_name ASC");



    #set the number of rows to display (per page)
    $tblDemo->setLimit(20);
    
    
    #upload chords
    
  //  $tblDemo->setFileUpload("filename", "chords/", "chords/");
  //  $tblDemo->appendUploadFilename("idsongs");

    #set a filter box at the top of the table
   $tblDemo->addAjaxFilterBox('report_name');
  

    
function makeurl($val){
    
    return "<a href='$val' target='_blank' class='lightwindow page-options' params='lightwindow_width=425,lightwindow_height=340,lightwindow_loading_animation=false'>Listen</a>";
    
    }
    
$tblDemo->formatFieldWithFunction('idsongs', 'song_stats');
    

    
    function song_stats($val){
    
    return "<a href='song_stats.php?songname=$val' target='_blank')'>Stats </a>";
    
    }
    
    
    
$tblDemo->formatFieldWithFunction('filename', 'chordlink');
    

    
function chordlink($val){
    
    return "<a href='chords/$val'target='_blank'>Chords</a>";
    
    }
    
    
    #actually show the table
    $tblDemo->showTable();

    #my self-defined functions used for formatFieldWithFunction
    function makeBold($val){
        return "<b>$val</b>";
    }

    function makeBlue($val){
        return "$val";
    }    
    
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

