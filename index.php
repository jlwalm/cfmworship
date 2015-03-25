<? include"auth_check_header.php"; 
include ('widgets.php');

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


      <!-- Right hand colum-->
      <div class="row">
        <div class="span4"> 
          

   
   
   <div class="widget" >

<div class="widget_header" >Songs for next week</div>
    
 <?php  widget_nextweek(); ?>

</div>
   
                                <div class="widget" >

<div class="widget_header" >Songs from last week</div>
     <?php
         widget_lastweek();
        		 
         ?>
 

</div>
          
              
          

          
</div><!-- end of left column -->






<div class='span4'>

<!-- end of left column 
<div class="widget" >
<div class="widget_header" >Songs you like to do...</div>
 <?php  //widget_user_popular(); ?>
</div>
-->




   
          
          <div class='widget'>
      <div class="widget_header">Recently added songs</div>
                    <?php
          widget_new();
		 
         
         ?>
      </div> 






<div class='widget'>
      <div class="widget_header">Top 15 songs over last 6 months</div>
                    <?php
         widget_popular();
		 
         
         ?>
      </div> 



 </div><!-- end of middle column -->

       <div class='span4'>

<!-- end of left column 
<div class="widget" >
<div class="widget_header" >Songs you like to do...</div>
 <?php  //widget_user_popular(); ?>
</div>
-->


<div class="widget" >
<div class="widget_header" >Next week</div>
 <?php  widget_nextweek_who(); ?>
</div>

<div class="widget" >
<div class="widget_header" style='background-color:darkorange; ' >The New Songs...</div>
 <?php  widget_introduce(); ?>
</div>



   
                                     <div class="widget" >

<div class="widget_header" >Songs you like to do...</div>
     <?php
         widget_user_popular();
        		 
         ?>
 

</div>     



 </div><!-- end of right column -->

	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
      </div><!-- end of row -->



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

