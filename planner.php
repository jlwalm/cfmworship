<?php include"auth_check_header.php";

    require_once('preheader.php');

    #the code for the class
    include ('ajaxCRUD.class.php');
    
    
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CFM Worship | Planner</title>
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

    <div class="navbar navbar-inverse navbar-fixed-top" style='display:none;'>
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
    
    
    #define relationship
     $tblDemo->defineRelationship("role_idrole", "role", "idrole", "role_name");
    $tblDemo->defineRelationship("users_id", "users", "id", "username");
    
       

    #i don't want to visually show the primary key in the table
    $tblDemo->omitPrimaryKey();

    #the table fields have prefixes; i want to give the heading titles something more meaningful
    $tblDemo->displayAs("role_idrole", "Role");
    $tblDemo->displayAs("users_id", "Person");
$tblDemo->displayAddFormTop();    

        $tblDemo->omitField("service_idservice");

    
        //access control
    
    
    if ($permissions<'2'){

$tblDemo->disallowAdd();
$tblDemo->disallowEdit('role_idrole');
$tblDemo->disallowEdit('users_id');
$tblDemo->disallowEdit('service_idservice');

$tblDemo->disallowDelete();

    
}


   
        $tblDemo->omitAddField("service_idservice");
        
          ##use session variables to get service id because ajax strips out get variables.      
session_start();
if(isset($_GET['idservice'])) {
$_SESSION['wproject_serviceID']=$_GET['idservice'];

}
        $service = $_SESSION['wproject_serviceID'];
		#echo $_SESSION['wproject_serviceID'];
		#echo $service;
        $tblDemo->addWhereClause("WHERE service_idservice = '$service'");
        

        
        

        $tblDemo->addValueOnInsert("service_idservice", $service); 
        
        
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

  </body>
</html>

