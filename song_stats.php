<? include"auth_check_header.php"; ?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bluedream.css" />
    <link href="css/bootstrap.css" rel="stylesheet">

    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>
<?php
	$songid = $_GET["songname"];

//connect to the database
require ('connect.php');




//perform mysql queries

$song_name = mysql_query("select songs.song_name, songs.idsongs, service.date, service.am_pm from songs, service, setlist 

where setlist.songs_idsongs = songs.idsongs and setlist.service_idservice = service.idservice and songs.idsongs = '$songid' order by service.date desc");

//create table to display results in (excluded from the loop.


echo "<table class='table table-striped table-bordered table-condensed table-hover' width='100%'>
<tr>
<th>Date</th><th>Service</th></tr><tr>";
//loop through the results for song name
while ($row = mysql_fetch_array($song_name))
{

//show song history

echo "<tr><td>" . $row['date'] . "</td><td>" . $row['am_pm'] . "</td></tr>";



}




echo "</table>";



mysql_close($con);
?>
</body>
</html>