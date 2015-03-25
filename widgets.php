<html>
<head>

</head>


<?php
function make_lightbox($id,$link,$text,$header){
echo	"<a data-target='#"  . $id ."' data-toggle='modal' style='cursor:pointer;cursor:hand;'>" . $text . "</a></a>

<div class='modal fade hide' id='" . $id . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' data-remote='/mmfansler/aQ3Ge/show/'>
  <div class='modal-header'>
    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
    <h3 id='myModalLabel'>" . $header . "</h3>
  </div>
  <div class='modal-body'>
    <iframe src='" . $link . "' seamless style='width:100%;height:250px;' width='100%' height='250px' scrolling='yes'></iframe>
  </div>
  <div class='modal-footer'>
    <button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button>
    
  </div>
</div>";
	
	
	
	
	}

//songs done last week
function widget_lastweek() {
$result_am = mysql_query("select songs.listen,songs.filename,songs.song_name, songs.idsongs, service.am_pm from songs, service, setlist where setlist.songs_idsongs = 
songs.idsongs and setlist.service_idservice = service.idservice and service.date >
SUBDATE(NOW(),
 Interval 7 Day) and DAYOFWEEK(service.date) >= 1 and service.date <= NOW() /*and service.date != CURDATE()*/ and service.am_pm = 'am' order by setlist.idSet asc");

$result_pm = mysql_query("select songs.listen,songs.filename,songs.song_name, songs.idsongs, service.am_pm from songs, service, setlist where setlist.songs_idsongs = 
songs.idsongs and setlist.service_idservice = service.idservice and service.date >
SUBDATE(NOW(),
 Interval 7 Day) and DAYOFWEEK(service.date) >= 1 and service.date <= NOW() /*and service.date != CURDATE()*/ and service.am_pm = 'pm' order by setlist.idSet asc");


 echo "<table class='table table-striped table-bordered table-condensed table-hover' width='100%'>";


#echo "<tr><td colspan='4'>Song</td></tr>";
    
    
    //loop through the morning results
    
    echo "<tr style='background-color:#eeeeee;font-weight:bold;'><td colspan='4'>Morning Service</td></tr>";
     if (mysql_num_rows($result_am) == '0')echo "<tr><td colspan='3'>Someone hasn't added the songs yet...</td></tr>"; 
 while ($row = mysql_fetch_array($result_am))
 {


     
     
 echo "<tr>";
     echo "<td>";
     make_lightbox("b1c1$row[idsongs]","song_stats.php?songname=$row[idsongs]", $row['song_name'], "History for $row[song_name]");
     
     echo "</td>"; //add song name column
    # echo "<td>" . $row['am_pm'] . "</td>"; //add time column
  
    //do the chords exist
$songcheck = $row['idsongs'];
$chord_test = mysql_query("select * from Resources where S_Id = $songcheck");
$count = mysql_num_rows($chord_test);

     if ($count == 0) {
        echo "<td><img src='images/notavailable.gif' alt='No resouces available'/></td>"; //No Chords available.
     }
     else {
        echo "<td>";
        make_lightbox("b1c3$row[idsongs]", "resources.php?view=r&idsongs=$row[idsongs]", "<img src='images/download.gif' alt='Download PDF'/>", "Chords for $row[song_name]");
        echo "</td>"; //add the chord link.
     }
  
     
         
     
     
     
     if (empty($row['listen'])) { //if no youtube link echo <img src='images/notavailable.gif' alt='No resouces available'/> else add youtube link.
         echo "<td><img src='images/notavailable.gif' alt='No resouces available'/></td>";
     }
     else {
     
         echo "<td>";
         echo "<a target='_blank' href='" . $row['listen'] . "' class='lightwindow page-options' params='lightwindow_width=425,lightwindow_height=340,lightwindow_loading_animation=false'><img src='images/speaker.gif' alt='Listen'/></a>";
         echo "</td>"; } //add the youtube link
     echo "</tr>"; //close the table row   $row['listen']   
  }
  
  
      echo "<tr style='background-color:#eeeeee;font-weight:bold;'><td colspan='4'>Evening Service</td></tr>";
   if (mysql_num_rows($result_pm) == '0')echo "<tr><td colspan='3'>Someone hasn't added the songs yet...</td></tr>"; 
   while ($row = mysql_fetch_array($result_pm))
 {


     
     
 echo "<tr>";
     echo "<td>";
     make_lightbox("b1c1$row[idsongs]","song_stats.php?songname=$row[idsongs]", $row['song_name'], "History for $row[song_name]");
     
     echo "</td>"; //add song name column
    # echo "<td>" . $row['am_pm'] . "</td>"; //add time column
  
    //do the chords exist
$songcheck = $row['idsongs'];
$chord_test = mysql_query("select * from Resources where S_Id = $songcheck");
$count = mysql_num_rows($chord_test);

     if ($count == 0) {
        echo "<td><img src='images/notavailable.gif' alt='No resouces available'/></td>"; //No Chords available.
     }
     else {
        echo "<td>";
        make_lightbox("b1c3$row[idsongs]", "resources.php?view=r&idsongs=$row[idsongs]", "<img src='images/download.gif' alt='Download PDF'/>", "Chords for $row[song_name]");
        echo "</td>"; //add the chord link.
     }
  
     
         
     
     
     
     if (empty($row['listen'])) { //if no youtube link echo <img src='images/notavailable.gif' alt='No resouces available'/> else add youtube link.
         echo "<td><img src='images/notavailable.gif' alt='No resouces available'/></td>";
     }
     else {
     
         echo "<td>";
         echo "<a target='_blank' href='" . $row['listen'] . "' class='lightwindow page-options' params='lightwindow_width=425,lightwindow_height=340,lightwindow_loading_animation=false'><img src='images/speaker.gif' alt='Listen'/></a>";
         echo "</td>"; } //add the youtube link
     echo "</tr>"; //close the table row   $row['listen']   
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
    echo "</table> <br><br>"; //close the html table.
  }
//end of function



//songs for next week
function widget_nextweek() {
$result_am = mysql_query("select songs.listen,songs.filename,songs.song_name,songs.idsongs, service.am_pm from songs, service, setlist where setlist.songs_idsongs = 
songs.idsongs and setlist.service_idservice = service.idservice and service.date <
ADDDATE(NOW(),
 Interval 8 Day) and DAYOFWEEK(service.date) >= 1 and service.date > NOW() and service.am_pm = 'am' order by setlist.IDset");
 
 $result_pm = mysql_query("select songs.listen,songs.filename,songs.song_name,songs.idsongs, service.am_pm from songs, service, setlist where setlist.songs_idsongs = 
songs.idsongs and setlist.service_idservice = service.idservice and service.date <
ADDDATE(NOW(),
 Interval 8 Day) and DAYOFWEEK(service.date) >= 1 and service.date > NOW() and service.am_pm = 'pm' order by setlist.idset");

 echo "<table class='table table-striped table-bordered table-condensed table-hover' width='100%'>";

#results for morning 
 echo "<tr style='background-color:#eeeeee;font-weight:bold;'><td colspan='4'>Morning Service</td></tr>";
 if (mysql_num_rows($result_am) == '0')echo "<tr><td colspan='3'>Someone hasn't added the songs yet...</td></tr>"; 
 while ($row = mysql_fetch_array($result_am))
 {
 echo "<tr>";
 echo "<td>";
 
make_lightbox("b2c1$row[idsongs]","song_stats.php?songname=$row[idsongs]", $row['song_name'], "History for $row[song_name]"); 
 echo "</td>"; //add song name column


     
            //do the chords exist
$songcheck = $row['idsongs'];
$chord_test = mysql_query("select * from Resources where S_Id = $songcheck");
$count = mysql_num_rows($chord_test);

     if ($count == 0) {
        echo "<td><img src='images/notavailable.gif' alt='No resouces available'/></td>"; //No Chords available.
     }
     else {
        echo "<td>";
        
         make_lightbox("b2c3$row[idsongs]", "resources.php?view=r&idsongs=$row[idsongs]", "<img src='images/download.gif' alt='Download PDF'/>", "Chords for $row[song_name]");
        
        echo "</td>"; //add the chord link.
     }
     
     
     
     if (empty($row['listen'])) { //if no youtube link echo <img src='images/notavailable.gif' alt='No resouces available'/> else add youtube link.
         echo "<td><img src='images/notavailable.gif' alt='No resouces available'/></td>";
     }
     else {
     
         echo "<td><a target='_blank' href='" . $row['listen'] . "' class='lightwindow page-options' params='lightwindow_width=425,lightwindow_height=340,lightwindow_loading_animation=false'><img src='images/speaker.gif' alt='Listen'/></a></td>"; } //add the youtube link
     echo "</tr>"; //close the table row
  }
  
  
  
  
  
  
  
  echo "<tr style='background-color:#eeeeee;font-weight:bold;'><td colspan='4'>Evening Service</td></tr>";
  if (mysql_num_rows($result_pm) == '0')echo "<tr><td colspan='3'>Someone hasn't added the songs yet...</td></tr>"; 
 while ($row = mysql_fetch_array($result_pm))
 {
 echo "<tr>";
 echo "<td>";
 
make_lightbox("b2c1$row[idsongs]","song_stats.php?songname=$row[idsongs]", $row['song_name'], "History for $row[song_name]"); 
 echo "</td>"; //add song name column


     
            //do the chords exist
$songcheck = $row['idsongs'];
$chord_test = mysql_query("select * from Resources where S_Id = $songcheck");
$count = mysql_num_rows($chord_test);

     if ($count == 0) {
        echo "<td><img src='images/notavailable.gif' alt='No resouces available'/></td>"; //No Chords available.
     }
     else {
        echo "<td>";
        
         make_lightbox("b2c3$row[idsongs]", "resources.php?view=r&idsongs=$row[idsongs]", "<img src='images/download.gif' alt='Download PDF'/>", "Chords for $row[song_name]");
        
        echo "</td>"; //add the chord link.
     }
     
     
     
     if (empty($row['listen'])) { //if no youtube link echo <img src='images/notavailable.gif' alt='No resouces available'/> else add youtube link.
         echo "<td><img src='images/notavailable.gif' alt='No resouces available'/></td>";
     }
     else {
     
         echo "<td><a target='_blank' href='" . $row['listen'] . "' class='lightwindow page-options' params='lightwindow_width=425,lightwindow_height=340,lightwindow_loading_animation=false'><img src='images/speaker.gif' alt='Listen'/></a></td>"; } //add the youtube link
     echo "</tr>"; //close the table row
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
    echo "</table> "; //close the html table.
  }
//end of function






//most popular songs over last 6 months
function widget_popular() {
$result = mysql_query("select songs.song_name,songs.idsongs, count(*) as total from songs, setlist, service where 

songs.idsongs=setlist.songs_idsongs and setlist.service_idservice = service.idservice and 

DATE_SUB(CURDATE(),INTERVAL 6 MONTH) <= service.date group by songs.song_name order by total desc, songs.song_name asc limit 0,15
");

 echo "<table class='table table-striped table-bordered table-condensed table-hover' width='100%'>

 <tr><td>Song</td><td>Total</td></tr>";
 
 while ($row = mysql_fetch_array($result))
 {
 echo "<tr>";

 echo "<td>";
make_lightbox("b3c1$row[idsongs]","song_stats.php?songname=$row[idsongs]", $row['song_name'], "History for $row[song_name]"); 
 echo "</td>"; //add song name column
 echo "<td>" . $row['total'] . "</td>";
 echo "</tr>"; 
  }
  echo "</table><br> <br>";
  }
//end of function  


//most unpopular songs over last 6 months
function widget_unpopular() {
$result = mysql_query("select songs.song_name,songs.idsongs, count(*) as total from songs, setlist, service where 

songs.idsongs=setlist.songs_idsongs and setlist.service_idservice = service.idservice and 

DATE_SUB(CURDATE(),INTERVAL 6 MONTH) <= service.date group by songs.song_name order by total asc, service.date asc limit 0,5
");

 echo "<table class='table table-striped table-bordered table-condensed table-hover' width='100%'>
 <tr><th colspan='2'><b>Most unplayed songs in last 6 months</b></th></tr>
 <tr><td>Song</td><td>Total</td></tr>";
 
 while ($row = mysql_fetch_array($result))
 {
 echo "<tr>";

 echo "<td><a href='song_stats.php?songname="  . $row['idsongs'] . "' class='lightwindow page-options' title='Statistics' >" . $row['song_name'] . "</a> </td>"; //add song name column
 echo "<td>" . $row['total'] . "</td>";
 echo "</tr>"; 
  }
  echo "</table><br> <br>";
  }
//end of function  




//New Songs
function widget_new() {
$result = mysql_query("
select songs.song_name, songs.listen, songs.filename,songs.idsongs from songs order by songs.idsongs desc limit 

0,6


");

 echo "<table class='table table-striped table-bordered table-condensed table-hover' width='100%'>";

# echo "<tr><td>Song</td><td>Chords</td><td>Listen</td></tr>";
 
 while ($row = mysql_fetch_array($result))
 {
 echo "<tr>";

  echo "<td>";
  make_lightbox("b4c1$row[idsongs]","song_stats.php?songname=$row[idsongs]", $row['song_name'], "History for $row[song_name]"); 
  echo "</td>"; //add song name column

     
            //do the chords exist
$songcheck = $row['idsongs'];
$chord_test = mysql_query("select * from Resources where S_Id = $songcheck");
$count = mysql_num_rows($chord_test);

     if ($count == 0) {
        echo "<td><img src='images/notavailable.gif' alt='No resouces available'/></td>"; //No Chords available.
     }
     else {
        echo "<td>";
        make_lightbox("b4c3$row[idsongs]", "resources.php?view=r&idsongs=$row[idsongs]", "<img src='images/download.gif' alt='Download PDF'/>", "Chords for $row[song_name]");
        echo "</td>"; //add the chord link.
     }
     
     
     
     if (empty($row['listen'])) { //if no youtube link echo <img src='images/notavailable.gif' alt='No resouces available'/> else add youtube link.
         echo "<td><img src='images/notavailable.gif' alt='No resouces available'/></td>";
     }
     else {
     
         echo "<td><a target='_blank' href='" . $row['listen'] . "' class='lightwindow page-options' params='lightwindow_width=425,lightwindow_height=340,lightwindow_loading_animation=false'><img src='images/speaker.gif' alt='Listen'/></a></td>"; } //add the youtube link
     echo "</tr>"; //close the table row
  }
    echo "</table> "; //close the html table.
  }
//end of function

  
  
  //most popular songs over last 12 months per user.
function widget_user_popular() {
	$user = $_COOKIE["CFMW"];
	
$result = mysql_query("select songs.song_name,songs.idsongs,setlist.iduser, count(*) as total from songs, setlist, service where 

setlist.iduser = '$user' and songs.idsongs=setlist.songs_idsongs and setlist.service_idservice = service.idservice and 

DATE_SUB(CURDATE(),INTERVAL 12 MONTH) <= service.date group by songs.song_name order by total desc, songs.song_name asc limit 0,3
");

 echo "<table class='table table-striped table-bordered table-condensed table-hover' width='100%'>

 <tr><td><b>Song</b></td><td><b>Total</b></td></tr>";
 
 while ($row = mysql_fetch_array($result))
 {
 echo "<tr>";

 echo "<td>";
make_lightbox("b3c1$row[idsongs]","song_stats.php?songname=$row[idsongs]", $row['song_name'], "History for $row[song_name]"); 
 echo "</td>"; //add song name column
 echo "<td>" . $row['total'] . "</td>";
 echo "</tr>"; 
  }
  echo "</table><br> <br>";
  }








  
  
  
  
  ###who is who
  
  
  function widget_nextweek_who() {
$result_am = mysql_query("  select users.firstname, users.lastname, role.role_name, service.am_pm from users,role,rota,service where (role.role_name = 'Service Leader' or role.role_name = 'Worship Leader' or role.role_name = 'Speaker') and role.idrole = rota.role_idrole and users.id = rota.users_id and  service.idservice = rota.service_idservice
 and service.date < ADDDATE(NOW(), Interval 7 Day) and DAYOFWEEK(service.date) >= 1 and service.date > NOW() and service.am_pm = 'am' order by service.am_pm asc ");
 
 $result_pm = mysql_query("  select users.firstname, users.lastname, role.role_name, service.am_pm from users,role,rota,service where (role.role_name = 'Service Leader' or role.role_name = 'Worship Leader' or role.role_name = 'Speaker') and role.idrole = rota.role_idrole and users.id = rota.users_id and  service.idservice = rota.service_idservice
 and service.date < ADDDATE(NOW(), Interval 7 Day) and DAYOFWEEK(service.date) >= 1 and service.date > NOW() and service.am_pm = 'pm' order by service.am_pm asc ");





 echo "<table class='table table-striped table-bordered table-condensed table-hover' width='100%'>";
 
 echo "<tr style='background-color:#eeeeee;font-weight:bold;'><td colspan='4'>Morning Service</td></tr>";
 
 while ($row = mysql_fetch_array($result_am))
 {
 echo "<tr>";
 
 echo "<td colspan='2'>";
echo $row['role_name']; 

 echo "</td>"; //add song name column
 echo "<td colspan='3'>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
    
 
     echo "</tr>"; //close the table row
  }
   
    echo "<tr style='background-color:#eeeeee;font-weight:bold;'><td colspan='4'>Evening Service</td></tr>";
 
 while ($row = mysql_fetch_array($result_pm))
 {
 echo "<tr>";
 
 echo "<td colspan='2'>";
echo $row['role_name']; 

 echo "</td>"; //add song name column
 echo "<td colspan='3'>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
    
 
     echo "</tr>"; //close the table row
  } 
    
    
    
    
    
    
echo "</table>"; ##end table
  }
  













  function widget_lastweek_who() {
$result_last = mysql_query("select users.firstname, users.lastname, role.role_name, service.am_pm from users,role,rota,service where role.idrole = rota.role_idrole and users.id = rota.users_id and  service.idservice = rota.service_idservice
 and service.date >
SUBDATE(NOW(),
 Interval 7 Day) and DAYOFWEEK(service.date) >= 1 and service.date <= NOW() order by service.am_pm asc");





 echo "<table class='table table-striped table-bordered table-condensed table-hover' width='100%'>";
 
 
 
 while ($row = mysql_fetch_array($result_last))
 {
 echo "<tr>";
 echo "<td>";
 echo $row['firstname'] . " " . $row['lastname'];
 echo "</td>"; 
 echo "<td colspan='2'>";
echo $row['role_name']; 

 echo "</td>"; //add song name column
 echo "<td colspan='3'>" . $row['am_pm'] . "</td>";
    
 
     echo "</tr>"; //close the table row
  }
    
echo "</table>"; #finish the table
  }




  
  
  
  
  
  
  
  
  //Songs to introduce
function widget_introduce() {
$result = mysql_query("
select songs.song_name, songs.listen, songs.filename,songs.idsongs, songs.flag from songs where flag = '1' order by songs.idsongs desc limit 

0,6


");

 echo "<table class='table table-striped table-bordered table-condensed table-hover' width='100%' style=''>";

# echo "<tr><td>Song</td><td>Chords</td><td>Listen</td></tr>";
 
 while ($row = mysql_fetch_array($result))
 {
 echo "<tr>";

  echo "<td>";
  make_lightbox("b4c1$row[idsongs]","song_stats.php?songname=$row[idsongs]", $row['song_name'], "History for $row[song_name]"); 
  echo "</td>"; //add song name column

     
            //do the chords exist
$songcheck = $row['idsongs'];
$chord_test = mysql_query("select * from Resources where S_Id = $songcheck");
$count = mysql_num_rows($chord_test);

     if ($count == 0) {
        echo "<td><img src='images/notavailable.gif' alt='No resouces available'/></td>"; //No Chords available.
     }
     else {
        echo "<td>";
        make_lightbox("b4c3$row[idsongs]", "resources.php?view=r&idsongs=$row[idsongs]", "<img src='images/download.gif' alt='Download PDF'/>", "Chords for $row[song_name]");
        echo "</td>"; //add the chord link.
     }
     
     
     
     if (empty($row['listen'])) { //if no youtube link echo <img src='images/notavailable.gif' alt='No resouces available'/> else add youtube link.
         echo "<td><img src='images/notavailable.gif' alt='No resouces available'/></td>";
     }
     else {
     
         echo "<td><a target='_blank' href='" . $row['listen'] . "' class='lightwindow page-options' params='lightwindow_width=425,lightwindow_height=340,lightwindow_loading_animation=false'><img src='images/speaker.gif' alt='Listen'/></a></td>"; } //add the youtube link
     echo "</tr>"; //close the table row
  }
    echo "</table> "; //close the html table.
  }
//end of function






  
  
  ?>
 
 </html>
