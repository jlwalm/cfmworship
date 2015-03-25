<?php include"auth_check_header.php"; ?>
<?php

    require_once('preheader.php');

    #the code for the class
    include ('ajaxCRUD.class.php');
    include 'pivot.php';
    
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CFM Worship | Rota</title>
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

         //query database for setlist where service = idservice variable.
         
         $result = mysql_query("select * from rota, service, users 
         where service.idservice = rota.service_idservice 
         and rota.users_id = users.id ");
//create table to display results
 echo "<table width='100%' class='table table-striped table-bordered table-condensed table-hover'>
 <tr><th colspan='4'><b>Rota</b></th><th></th>"; 
 
 
 if(permissions>=2){
  echo " <th></th><th><th></th></th><th></th><th></th><th></th>";} 
  
  echo "</tr>
 <tr><td><b>P</b></td><td><b>C</b></td><td><b>R</b></td><td><b>Song</b></td>";
 
 
 
 if(permissions>=2){echo "<td><b>Delete</b></td>";}
 
 if(permissions>=2){echo "<td>Remove</td></tr>";}
 else {echo "</tr>";}
 
 
 //loop through results and enter them into table.
 while ($row = mysql_fetch_array($result))
 {
 echo "<tr>";
echo "<td>" . $row['idrota'] . "</td>";
echo "<td>" . $row['users_id'] . "</td>";
echo "<td>" . $row['service_idservice'] . "</td>";
 echo "<td>" . $row['role_idrole'] . "</td>";


 echo "</tr>"; 
  }
  echo "</table> <br><br>";


  //test gam pivot
  
  $data = Pivot::factory($result)
    ->pivotOn(array('date'))
    ->addColumn(array('role', 'role_idrole'), array('users', 'users_id',))
    ->fetch();
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  //create form for permission 2 or above

if($permissions>='2')
{

$result = mysql_query("select * from songs order by song_name asc");

//create form

echo "<table class='table table-striped table-bordered table-condensed table-hover' border='0'><tr><td><form method='GET' action='" . $php_self . "'>

Add Song: 
<select name='idsongs' id='idsongs'>";

//loop through results and populate dropdown box

 while ($row = mysql_fetch_array($result))
 {

  echo "<option value='" . $row['idsongs'] . "'>" . $row['song_name'] . "</option>";

  }
  
  echo "</select>
  
  <input type='hidden' id='idservice' name='idservice' value='" . $service . "' />
  <input type='hidden' id='iduser' name='iduser' value='" . $_COOKIE["Wproject"] . "' />
  Projected: <input type='checkbox' checked='checked' name='p' value='1'>


 Copied: <input type='checkbox' checked='checked' name='c' value='1'> 
 Recorded: <input type='checkbox' name='r'  value='1'> 
 </td></tr><tr><td>

<input type='submit' value='Add' /> Can't find song? <a href='songs.php'>Add it</a> | <a href='sendmail.php?idservice=" .$service . "'>Email Band</a>



</form> </td></tr>




</table> ";

//send mail
echo "<br /> <br /> ";
 }
else
{

}
  
 
//end form  
  
  
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

