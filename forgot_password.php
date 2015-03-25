<?php  


include"login_config.php";

//Connection String Variables_________________________________________________

   // connect to the server
   mysql_connect( $db_host, $db_username, $db_password )
      or die( "Error! Could not connect to database: " . mysql_error() );
   
   // select the database
   mysql_select_db( $db )
      or die( "Error! Could not select the database: " . mysql_error() );
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CFM Worship | Password reset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
     body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
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

   


     <div class="container">


<?php
if (!empty($_POST)) {
        	//Generate a RANDOM MD5 Hash for a password
	$random_key=md5(uniqid(rand()));
 
	//Take the first 8 digits and use them as the password we intend to email the user
	$short_key=substr($random_password, 0, 8);
 
	//Encrypt $emailpassword in MD5 format for the database
	$key = md5($short_key);
        
        $username = $_POST['username'];
        $sql="UPDATE users set reset_key='$key' WHERE username='$username'";
        mysql_query($sql);
        
        
        
         $message = "Your password reset link send to your e-mail address.";
            $to=$username;
            $subject="CFM Worship Password Reset";
            $from = 'cfmworship@gmail.com';
            $body='Hi, <br/> <br/>You are receiving this email because you (or someone else...) has entered your email address on the cfm worship website to be reset. <br><br>Click here to reset your password http://www.cfmworship.org.uk/password_reset.php?key='.$key.'&action=reset   <br/> <br/>--<br>CFMworship.org.uk<br>';
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 
            mail($to,$subject,$body,$headers);
        
        
        
        
        
       echo "<form id='form' class='form-signin'> <p>Thank you, you will be emailed a link on how to reset your password.</p>
               
      
      
      </form>";    
    
}

else

{
echo "	
	  <form action='' method='post' name='form' id='form' class='form-signin'>
        <p>Please enter your email address below and you will be emailed a link to reset your password.</p>
        <input type='text' class='input-block-level' name='username'placeholder='Email address'>
        
      
        <p style='text-align:center;'><button class='btn btn-large btn-primary' type='submit'>Submit</button> </p>
      </form>";
	
}
?>

    





    </div>

    <!-- /container -->

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

