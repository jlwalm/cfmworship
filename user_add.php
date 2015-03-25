<?php

$permission_level=5;

 include"auth_check_header.php";
    include"master_inc.php";
    ?>


<head>
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/menu_style.css" />
<link rel="stylesheet" type="text/css" href="lightwindow/css/default.css" />    
<link rel="stylesheet" type="text/css" href="lightwindow/css/lightwindow.css" />        <!-- JavaScript -->    
<script type="text/javascript" src="lightwindow/javascript/prototype.js"></script>    
<script type="text/javascript" src="lightwindow/javascript/effects.js"></script>    
<script type="text/javascript" src="lightwindow/javascript/lightwindow.js"></script>
</head>
<div id="header"><?php echo "<a href='index.php'><img src='images/logonote.png' /></a>";?></div>
    <div id="navigation">
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
    //connect to database to retreive band names.

   $sql="SELECT * from band"; 
$result=mysql_query($sql); 
    $options="";

  
    
    ?>    
    
    
    </div>


<div align="center">

  <form action="user_add_save.php" method="post" name="form" id="form">
    <p><strong><font size="4" face="Verdana, Arial, Helvetica, sans-serif">Add User </font></strong><br />
       </p>
    <table width="474" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="177"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Username</font></td>
      <td width="277"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input type = "text" value="<? echo$username; ?>" name="username" width="50" />
      </font></td>
    </tr>
    <tr>
      <td bgcolor=""><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Password</font></td>
      <td bgcolor=""><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input type = "password" value="<? echo$password; ?>" name="password" width="50" />
      </font></td>
    </tr>
    <tr>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Last Name </font></td>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input type = "text" value="<? echo$lastname; ?>" name="lastname" width="50" />
      </font></td>
    </tr>
    <tr>
      <td bgcolor=""><font size="2" face="Verdana, Arial, Helvetica, sans-serif">First name </font></td>
      <td bgcolor=""><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input type = "text" value="<? echo$firstname; ?>" name="firstname" width="50" />
      </font></td>
    </tr>
    <tr>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Email</font></td>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input type = "text" value="<? echo$email; ?>" name="email" width="50" autocomplete="OFF" />
      </font></td>
    </tr>
    <tr>
      <td bgcolor=""><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Phone</font></td>
      <td bgcolor=""><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input type = "text" value="<? echo$phone; ?>" name="phone" width="50" autocomplete="OFF" />
      </font></td>
    </tr>
    <tr>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Password Hint </font></td>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input type = "text" value="<? echo$password_hint; ?>" name="password_hint" width="50" />
      </font></td>
    </tr>
        
        
        
                <tr>
      <td bgcolor=""><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Band </font></td>
      <td bgcolor=""><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
          
          <?php
              
              // now you can display the results returned
while ($row= mysql_fetch_array($result)) {

$id=$row["idband"]; 
    $thing=$row["band_name"]; 
    $options.="<OPTION VALUE=\"$id\">".$thing;
} 
              
            ?>  
              
              
          <SELECT NAME='band'> 
<OPTION VALUE='0'>Choose 
<?php echo $options?> 
              </SELECT> <br />
      </font></td>
    </tr>
        <tr>
      <td bgcolor=""><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Role </font></td>
      <td bgcolor=""><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
          <select name="permissions" width="100" >
          <option value="1">User</option>
          <option value="2">Leader</option>
          <option value="3">Administrator</option>
          
          </select> <br />
      </font></td>
    </tr>
  </table>
  <p><font size="1" face="Arial, Helvetica, sans-serif">
    <input type="submit" value="Save and Continue" name="submit2" />
  </font></p>
  </form>
  <p>
    <?

?>
  </p>
  <p>&nbsp;</p>
</div>
