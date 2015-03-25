<?php include"auth_check_header.php"; 

    require_once('preheader.php');

    #the code for the class
    include ('ajaxCRUD.class.php');
        
    ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CFM Worship | Song list</title>
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


<?php

//add or delete a record
if ($permissions>='2'){
if (isset($_GET["idsongs"])) {
    //check to see if notes have been entered. If not, remove the default note.
    if (strpos($_GET[notes], 'Enter') === 0) $_GET[notes] = "";
    
     
    //escape special characters from the notes.    
    $notes_escape = mysql_real_escape_string($_GET[notes]);
    
        
    mysql_query("INSERT INTO `cfmworship`.`setlist` (`idSet`, `songs_idsongs`, `service_idservice`, `p`, `c`, `r`, `iduser`, `notes`, `key`) VALUES ('', '$_GET[idsongs]', '$_GET[idservice]', '$_GET[p]', '$_GET[c]', '$_GET[r]', '$_GET[iduser]', '$notes_escape', '$_GET[key]')") or die(mysql_error());
    echo "Song Added";
    
    
}
//send mail if sendmail variable exists
if (isset($_POST["sendmail"])) {
    $service = ($_GET['idservice']);
    

    $result = mysql_query("SELECT users.email FROM users, band, service 
where users.band_idband = band.idband and band.idband = service.band_bandid and service.idservice = '$service' 
group by users.email");

    while($row = mysql_fetch_array($result))
    
    {
    $message = "The setlist is now available. <a href='http://wproject.zzl.org'>Click Here</a> To access it. Don't forget you will need your username and password.";
    $to = $row['email'];
    $subject = "Wproject setlist now available";
    $sender = "From: setlist@Wproject.com\nMIME-Version: 1.0\nContent-type: text/html; charset=iso-8859-1";
    mail($to,$subject,$message,$sender);
    
    echo "Mail sent";
    }
    

    
    
}






if (isset($_GET["delete"])) {
    
    mysql_query("Delete from setlist where idSet = '$_GET[delete]'") or die(mysql_error());
    echo "Song Deleted";
    
    
}




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
         $service = ($_GET['idservice']);
         $result = mysql_query("select * from setlist, service, songs 
         where songs.idsongs = setlist.songs_idsongs 
         and setlist.service_idservice = service.idservice 
         and service.idservice = '$service' order by setlist.idset");
//create table to display results
 echo "<table class='table table-striped table-bordered table-condensed table-hover'>

 <tr><td><b>Songs</b></td><td><b>Notes</b></td><td><b>Key</b></td><td colspan='3'></td>";
 
 
 
 if(permissions>=2){echo "<td><b>Delete</b></td>";}
 
 if(permissions>=2){echo "<td>Remove</td></tr>";}
 else {echo "</tr>";}
 
 
 //loop through results and enter them into table.
 while ($row = mysql_fetch_array($result))
 {
 echo "<tr>";

 echo "<td>" . $row['song_name'] . "</td>";
 echo "<td style='max-width:300px;'>" . $row['notes'] . "</td>";
 echo "<td>" . $row['key'] . "</td>";
 
  echo "<td><a href='resources.php?idsongs=" . $row['idsongs'] . "' class='lightwindow page-options' title='Chords' params='lightwindow_width=800,lightwindow_height=350'><img src='images/download.gif' alt='Download PDF'/></a></td>";
    echo "<td><a href='" . $row['listen'] . "' class='lightwindow page-options' params='lightwindow_width=425,lightwindow_height=340,lightwindow_loading_animation=false'><img src='images/speaker.gif' alt='Listen Online'/></a></td>";
    
    if($permissions>=2){
  echo "<td><a href='?delete=" . $row['idSet'] . "&idservice=" . $service . "'><img src='images/delete.gif' alt='Delete Song' /></a></td>";
}
 echo "</tr>"; 
  }
  echo "</table> <br><br>";


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


  &nbsp &nbsp  Key: <select name='key' id='key'>
<option value=''></option>
<option value='C'>C</option>
<option value='C#'>C#</option>
<option value='D'>D</option>
<option value='Eb'>Eb</option>
<option value='E'>E</option>
<option value='F'>F</option>
<option value='F#'>F#</option>
<option value='G'>G</option>
<option value='Ab'>Ab</option>
<option value='A'>A</option>
<option value='Bb'>Bb</option>
<option value='B'>B</option>
</select>


  
  </br>
  
  <textarea onfocus='clearContents(this);' id='editor1' style='width:90%;' name='notes' rows='10' cols='60'>
Enter notes here. eg. intro, solo, who's starting...
</textarea> 

</br>


  </br>
  <input type='hidden' id='idservice' name='idservice' value='" . $service . "' />
  <input type='hidden' id='iduser' name='iduser' value='" . $_COOKIE["CFMW"] . "' />
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
    
     <script>
 CKEDITOR.replace("editor1");
 function clearContents(element) {
  element.value = '';
}
 </script>
    
    <script src="/ckeditor/ckeditor.js"></script>
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

