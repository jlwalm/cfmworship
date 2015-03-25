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
    <title>CFM Worship | Sendmail</title>
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
								   
								   <!--LINK to CKEditor -->
								   <script src="/ckeditor/ckeditor.js"></script>
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
    //url check
    
    
    
	//check to see if the form has been submitted. If so, sendmail, if not, print form.
	
	        if (isset($_POST["setlist"])) {
    echo "The song list is being sent...";
    $setlist = $_POST["setlist"];
    $text = $_POST["text"];
    $to = $_POST["to"];
    $cc = $_POST['cc'];
    $other = $_POST['other'];
    $subject = "CFM Worship Song list.";
    $complete_message = $text . "<br>" . $setlist;
    $headers = "From: {CFM Worship <info@cfmworship.org.uk>}\r\n"; 
$headers .= "Reply-To: {CFM Worship <". $_COOKIE["CFMW"] .">}\r\n"; 
$headers .= "Return-Path: {CFM Worship <". $_COOKIE["CFMW"] .">}\r\n"; 
$headers .= "X-Mailer: PHP5\r\n"; 
$headers .= "Content-Transfer-encoding: 8bit\r\n"; 
$headers .= "MIME-Version: 1.0\r\n"; 
$headers .= "X-MSMail-Priority: Normal\r\n"; 
$headers .= "Importance: 0\r\n"; 
$headers .= "Content-Type: text/html; charset=UTF-8\r\n\r\n"; 
#get worship members
foreach ($to as $people)
{
        $addresses .= $people;
        $addresses .= ",";
}
#get pastors
foreach ($cc as $pastors)
{
        $addresses .= $pastors;
        $addresses .= ",";
}
#get other email addresses
$addresses .= $other;
  //send the email
 
 mail($addresses,$subject,$complete_message,$headers);
 echo "Your songlist has been emailed to <b>$addresses</b><br><i>$ccd</i> were copied in too!<br>";
 echo "<a href='setlist.php?idservice=" . $_GET['idservice'] ."'>Click here</a> to return to your song list.";
 
 #echo "$complete_message";
# echo "<br>And these are the headers...<br>$headers";
}
else
{





         //query database for setlist where service = idservice variable.
         $service = ($_GET['idservice']);
         $result = mysql_query("select * from setlist, service, songs 
         where songs.idsongs = setlist.songs_idsongs 
         and setlist.service_idservice = service.idservice 
         and service.idservice = '$service' order by setlist.idset");
//create table to display results
 $message = '<html><body>';
 
 $message .= "<table width='100%' class='table table-striped table-bordered table-condensed table-hover'>
 <tr><th colspan='3'><b>Song List</b></th>"; 
 
 
 if(permissions>=2){
  $message .= " <th></th><th><th></th></th><th></th><th></th>";} 
  
  $message .= "</tr>
 <tr><td><b>Song Name</b></td><td><b>Notes</b></td><td><b>Key</b></td><td><b>Chords</b></td><td><b>Listen</b></td></tr>";
 
 
 


 
 //loop through results and enter them into table.
 while ($row = mysql_fetch_array($result))
 {
 $message .= "<tr>";

 $message .= "<td>" . $row['song_name'] . "</td>";
 
 
 //#####NEED to escape special characters from notes#################
 
 $notes_escape = str_replace('"',"'",$row['notes']);
 $message .= "<td>" . $notes_escape . "</td>";
 $message .= "<td>" . $row['key'] . "</td>";

  $message .= "<td><a href='http://www.cfmworship.org.uk/resources.php?idsongs=" . $row['idsongs'] . "' class='lightwindow page-options' title='Chords' params='lightwindow_width=800,lightwindow_height=350'><img src='http://www.cfmworship.org.uk/images/download.gif' alt='Download PDF'/></a></td>";
    $message .= "<td><a href='" . $row['listen'] . "' class='lightwindow page-options' params='lightwindow_width=425,lightwindow_height=340,lightwindow_loading_animation=false'><img src='http://www.cfmworship.org.uk/images/speaker.gif' alt='Listen Online'/></a></td>";
    

 $message .= "</tr>"; 
  }
  $message .= "</table> <br><br></body></html>";
 
  echo $message;
  
 //Create form for submitting.
 echo '<form action="" method="post"><table> <tr><td>To:</td><td>';
 
 
		##Find those in the worship team due to play for this service
         $emailsql = mysql_query("select users.firstname, users.lastname, users.username, users.band_idband, 
service.band_bandid, service.idservice from users, service 
         where service.idservice = $service 
         and users.band_idband = service.band_bandid;");
 		##find the pastors
 		
 		 $pastorssql = mysql_query("select users.firstname, users.lastname, users.username, users.band_idband, 
service.band_bandid, service.idservice from users, service 
         where service.idservice = $service 
         and users.band_idband = '19';");
 
 echo "<select size='7' name='to[]' multiple>";

 

  while ($row = mysql_fetch_array($emailsql))
 {

##NEW METHOD


##OLD METHOD
echo "<option value='" .$row['username'] ."'>" .$row['firstname'] . " " .$row['lastname'] ."</option>";

# echo "<a class='email' style='background-color:#dddddd;border-radius:5px;color:#000000;padding:3px;' href='#' title='" . $row['username'] . "'>";
# echo $row['firstname'] . " " . $row['lastname'];echo "<a/> ";
# $email_addresses .= $row['username'];
# $email_addresses .= ",";

  }
 
echo "</select>"; 
# echo "<input type='hidden' name='to' value='" . $email_addresses . "'>";
 
 
 
 
 echo '<i> Use ctrl or shift to select multiple items</i></td><td></td>';
 

 
 
 
 
 echo '</tr>
 <tr><td>CC:</td><td>';
  echo "<select name='cc[]' multiple>";
 
 
 while ($row = mysql_fetch_array($pastorssql))
 {


echo "<option value='" .$row['username'] ."'>" .$row['firstname'] . " " .$row['lastname'] ."</option>";



  }
 
echo "</selct>"; 
 
 echo '</td></tr><tr><td>Other:</td><td><input type="text" name="other" placeholder="Email address"><i> Seperate multiple email addresses with a comma.</i></td><td></td></tr>
 <tr><td>Message:</td><td><textarea id="editor1" style="width:100%;" name="text" rows="10" cols="60">
Enter a message here.
</textarea></td></tr>
<input type="hidden" name="setlist" value="';
echo $message; 
echo '">

 <tr><td><input type="submit" name"submit" value="Send Email"></td><td></td></tr>
 </table>
 <script>
 CKEDITOR.replace("editor1");
 
 </script>
 
 
 </form>';              
               
	
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

