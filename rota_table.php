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


$db=mysqli_connect("localhost","root","John2031!","cfmworship");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$query = mysqli_query($db,"select users.firstname, service.date,service.idservice, role.role_name, role.idrole from rota, users, service, role where users.id = rota.users_id
and role.idrole = rota.role_idrole and service.am_pm = 'am' and service.idservice = rota.service_idservice and service.date >= now()-interval 5 month order by service.date, role.role_name");



// i prefer to used named subscripts to make the code easier to read.
define('THE_DATE', 'date');
define('ROLE',     'role_name');
define('MEMBER',   'firstname');
define('ROLE_ID',   'idrole');
define('SERVICE_ID',   'idservice');

$allRoles = array('Service Leader','Speaker','Worship Leader', 'Keys', 'Guitar', 'Bass', 'Drums', 'Solo Instruments', 'Vox1', 'Vox2');



$outputDates = array();



$currentRoleRow = mysqli_fetch_array($query);

while (isset($currentRoleRow[THE_DATE])) { //For each day return, perform the following..


  $currentDay = $currentRoleRow[THE_DATE];	//set the current day.


  $theDayRoles = array(); //initialise array to hold roles for current day

  
  foreach ($allRoles as $role) {	//give a default value of '--' for each role on the day.
    $theDayRoles[$role] = '--';
  }

  // now we need to fill theDay roles with what we have for the current day...
  while ($currentRoleRow[THE_DATE] == $currentDay) {

    // set the appropiate DayRole to the current MEMBER
    $theDayRoles[$currentRoleRow[ROLE]] = $currentRoleRow[MEMBER];

    // read the next input row - may be new day or no more
    $currentRoleRow = mysqli_fetch_array($query);
  }

  /* we now have:
   *   Current Date
   *
   *   an array of members for ALL the roles on that day.
   *
   *   We need to outout it to another array where we can print it out
   *   by scanning the array line by line.
   *
   *   Or we can build the output array so that we scan the whole length of it multiple times
   *   to get the output by rows.
   *
   *   I will 'pivot' the array and produce an output array we can scan sequentially.
   *
   */

   // to ensure that we are updating the currect row i will use a subscript
   $currentOutputRow = 0;

   // first add the current date to the output...
   $outputDates[$currentOutputRow][] = $currentDay;
   $currentOutputRow++; // next output row

   // we need to drive off the '$allRoles' array to add the rows in the correct order
   foreach ($allRoles as $outRole) {
     $outputDates[$currentOutputRow][] = $theDayRoles[$outRole];
     $currentOutputRow++; // next output row
   }

} // end of all the input data

/*
 * Now we just need to print the outputDate array one row at a time...
 */

// need the roles as the first column...
// so we need an index for it
$currentRoleIdx = -1; // increment each time but allow for the first row being the title

echo "<table class='table table-striped table-bordered table-condensed table-hover' width='100%'>";
foreach ($outputDates as $oneOutputRow) {

  echo '<tr>';

  // this is the first column...
  if ($currentRoleIdx < 0) {
    echo '<td>'. 'Roles' .'</td>';
  }
  else {
    echo '<td>'. $allRoles[$currentRoleIdx] .'</td>';
  }

  // now output the day info
  foreach($oneOutputRow as $column) {
    echo '<td>'. $column .'</td>';
    
    
  }
  echo '</tr>';
  $currentRoleIdx++; // next output Role to show...

}
echo '</table>';
    
    
    
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

