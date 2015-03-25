
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
    <title>CFM Worship</title>
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


<?php

	
	session_start();

if(isset($_GET['idsongs'])) {
$_SESSION['song-chords']=$_GET['idsongs'];
}
	
	
	
	
	

    #this one line of code is how you implement the class
    ########################################################
    ##

    $tblDemo = new ajaxCRUD("Chords", "Resources", "R_Id", "");

    ##
    ########################################################
    #$tblDemo->setCSSFile('bluedream.css');

    $tblDemo->displayAs("R_Id", "Resource ID");
    $tblDemo->displayAs("S_Id", "Song Name");
	    $tblDemo->displayAs("description", "Description");
		    $tblDemo->displayAs("music_key", "Key");
			    $tblDemo->displayAs("Resource", "Link");
				    $tblDemo->omitPrimaryKey();
					$tblDemo->omitAddField("S_Id");	
					    $tblDemo->omitField("S_Id");

    $tblDemo->setTextareaHeight('fldLongField', 200);
    #i can define a relationship to another table
    #the 1st field is the fk in the table, the 2nd is the second table, the 3rd is the pk in the second table, the 4th is field i want to retrieve as the dropdown value
    #http://ajaxcrud.com/api/index.php?id=defineRelationship
    $tblDemo->defineRelationship("S_Id", "songs", "idsongs", "song_name");
    
            //access control
    
    
  

$tblDemo->disallowAdd();

$tblDemo->disallowDelete();

$tblDemo->disallowEdit('S_Id');

$tblDemo->disallowEdit('description');
$tblDemo->disallowEdit('music_key');
$tblDemo->disallowEdit('Resource');
ECHO "<style>
a.hide{
display:none;}

</style>";

    
	


    
    
    $newID = $_SESSION['song-chords'];
	
	//echo $newID;
	


    #i can order my table by whatever i want
    $tblDemo->addOrderBy("ORDER BY R_Id ASC");

$tblDemo->addWhereClause("WHERE S_Id = '$newID'");

    #set the number of rows to display (per page)
    $tblDemo->setLimit(20);
    
    
    #upload chords
    
    $tblDemo->setFileUpload("Resource", "chords/", "chords/");
    $tblDemo->appendUploadFilename("R_Id");

	
	$tblDemo->addValueOnInsert("S_Id", "$newID");

	$allowableValues = array("C", "C#", "D", "Eb", "E", "F", "F#", "G", "Ab", "A", "Bb", "B");
    $tblDemo->defineAllowableValues("music_key", $allowableValues);
	
	
    #set a filter box at the top of the table
   $tblDemo->addAjaxFilterBox('description');

   
   

    $tblDemo->formatFieldWithFunction('listen', 'makeurl');
    

    
    function makeurl($val){
    
    return "<a href='$val' target='_blank' class='lightwindow page-options' params='lightwindow_width=425,lightwindow_height=340,lightwindow_loading_animation=false'>Listen</a>";
    
    }
    
      #  $tblDemo->formatFieldWithFunction('idsongs', 'song_stats');
    

    
    function song_stats($val){
    
    return "<a href='song_stats.php?songname=$val' target='_blank')'>Stats </a>";
    
    }
    
    
    
            $tblDemo->formatFieldWithFunction('Resource', 'chordlink');
    

    
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

