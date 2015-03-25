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
    <title>CFM Worship | Planner 2</title>
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
    


    #this one line of code is how you implement the class
    ########################################################
    ##

     $tblDemo = new ajaxCRUD("rota entry", "rota", "idrota", "");

    ##
    ########################################################

        #add style
    
    $tblDemo->setCSSFile('bluedream.css');
    
    
    ## all that follows is setup configuration for your fields....
    ## full API reference material for all functions can be found here - http://ajaxcrud.com/api/
    ## note: many functions below are commented out (with //). note which ones are and which are not

    #i can define a relationship to another table
    #the 1st field is the fk in the table, the 2nd is the second table, the 3rd is the pk in the second table, the 4th is field i want to retrieve as the dropdown value
      #define relationship
     $tblDemo->defineRelationship("role_idrole", "role", "idrole", "role_name");
    $tblDemo->defineRelationship("users_id", "users", "id", "username");
       

    #i don't want to visually show the primary key in the table
    #$tblDemo->omitPrimaryKey();

    #the table fields have prefixes; i want to give the heading titles something more meaningful
   
    $tblDemo->displayAs("role_idrole", "Role");
    $tblDemo->displayAs("users_id", "Person");
    


    #set the number of rows to display (per page)
    $tblDemo->setLimit(20);
    //turn off ajax add.
    $tblDemo->turnOffAjaxADD();
    
 $tblDemo->omitAddField("service_idservice");
        
          ##use session variables to get service id because ajax strips out get variables.      
session_start();
if(isset($_GET['idservice'])) {
$_SESSION['wproject_serviceID']=$_GET['idservice'];
$service = $_SESSION['wproject_serviceID'];
}
        echo $_SESSION['wproject_serviceID'];
        $service = $_SESSION['wproject_serviceID'];
		$tblDemo->addWhereClause("WHERE service_idservice = $service");
        

        
        

        $tblDemo->addValueOnInsert("service_idservice", $_SESSION['wproject_serviceID']); 
        
    
    #actually show the table
    $tblDemo->showTable();
    

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

