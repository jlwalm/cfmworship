<?php

$permission_level=5;

 include"auth_check_header.php"; ?>


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
    
    
    
    
    </div>
<div align="center">
  <p><A href="http://www.amsmerchant.com" target="_blank"></A>  <strong><font size="4" face="Verdana, Arial, Helvetica, sans-serif">Errors</font></strong><br />
    </p>
  <table width="500" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><?php
    $username_already_in_use = $_REQUEST['username_already_in_use'];
    $email_already_in_use = $_REQUEST['email_already_in_use'];
    $pw_insecure = $_REQUEST['pw_insecure'];
    $bad_email = $_REQUEST['bad_email'];
    $username_too_short = $_REQUEST['username_too_short'];
    
        if($username_too_short==104){echo"<font size='2' color='#ff0000' face='Verdana, Arial, Helvetica, sans-serif'>
That username is too short.  Please make it more than 4 characters.<br><br></font>";}
    
    if($username_already_in_use==104){echo"<font size='2' color='#ff0000' face='Verdana, Arial, Helvetica, sans-serif'>
That username is already in use.  Please try again or log in to your existing account.<br><br></font>";}

    if($email_already_in_use==104){echo"<font size='2' color='#ff0000' face='Verdana, Arial, Helvetica, sans-serif'>
That email is already in use.  That probably means you have an existing account. Log in or <a href='email_password.php'>reset your password</a><br><br></font>";}

    if($pw_insecure==104){echo"<font size='2' color='#ff0000' face='Verdana, Arial, Helvetica, sans-serif'>
Your Password is not formatted correctly.  Please choose a password that is between 4 and 20 characters and has at least 1 uppercase letter, one lower case letter and one number I.E. <i>Hello23</i>.<br><br></font>";}
    
    if($bad_email==104){echo"<font size='2' color='#ff0000' face='Verdana, Arial, Helvetica, sans-serif'>
Your email does not appear to be valid<br><br></font>";}


  ?></td>
    </tr>
  </table>
    
    
    
    <?php 
    //connect to database to retreive band names.

   $sql="SELECT * from band"; 
$result=mysql_query($sql); 
    $options="";

  
    
    ?> 
  <form action="user_add_save.php" method="post" name="form" id="form">
    <table width="474" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="177"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Username</font></td>
        <td width="277"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
          <input type = "text" value="<? echo$username; ?>" name="username" width="50" />
        </font></td>
      </tr>
      <tr>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Password</font></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
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
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">First name </font></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
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
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Phone</font></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
          <input type = "text" value="<? echo$phone; ?>" name="phone" width="50" autocomplete="OFF" />
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
              <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Role </font></td>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
          <select name="permissions" width="50" />
          <option value="1">User</option>
          <option value="2">Leader</option>
          <option value="3">Administrator</option>
          
          </select>
      </font></td>
        
        
        </tr>
        
        
        
        
      <tr>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Password Hint </font></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
          <input type = "text" value="<? echo$password_hint; ?>" name="password_hint" width="50" />
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
