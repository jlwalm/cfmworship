<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
</div>


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
    <title>CFM Worship | Services</title>
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
    


    #this one line of code is how you implement the class
    ########################################################
    ##

    $tblDemo = new ajaxCRUD("Service", "service", "idservice", "");

    ##
    ########################################################

        #add style
    
    $tblDemo->setCSSFile('bluedream.css');
    
    
    ## all that follows is setup configuration for your fields....
    ## full API reference material for all functions can be found here - http://ajaxcrud.com/api/
    ## note: many functions below are commented out (with //). note which ones are and which are not

    #i can define a relationship to another table
    #the 1st field is the fk in the table, the 2nd is the second table, the 3rd is the pk in the second table, the 4th is field i want to retrieve as the dropdown value
    #http://ajaxcrud.com/api/index.php?id=defineRelationship
    $tblDemo->defineRelationship("band_bandid", "band", "idband", "band_name");
       

    #i don't want to visually show the primary key in the table
    $tblDemo->omitPrimaryKey();

    #the table fields have prefixes; i want to give the heading titles something more meaningful
    $tblDemo->displayAs("idservice", "Service ID");
    $tblDemo->displayAs("date", "Service Date");
    $tblDemo->displayAs("am_pm", "Morning/Evening");
        $tblDemo->displayAs("band_bandid", "Team");



    #set the textarea height of the longer field (for editing/adding)
    #http://ajaxcrud.com/api/index.php?id=setTextareaHeight
    $tblDemo->setTextareaHeight('fldLongField', 200);

    
    
    #add 'add set' button'
    
    $tblDemo->addButtonToRow("Song Planner", "setlist.php", "idservice");
    
    
    #i could omit a field if I wanted
    #http://ajaxcrud.com/api/index.php?id=omitField
   # $tblDemo->omitField("leader_id");
      #  $tblDemo->omitField("speaker_id");

    
        //access control
    
    
    if ($permissions<'4'){

$tblDemo->disallowAdd();

$tblDemo->disallowDelete();

$tblDemo->disallowEdit('date');

$tblDemo->disallowEdit('am_pm');
$tblDemo->disallowEdit('band_bandid');

 
        #only show future services to standard users.
    $tblDemo->addWhereClause("WHERE date  between (DATE_SUB(CURDATE(), INTERVAL 30 day)) and (DATE_ADD(CURDATE(), INTERVAL 30 day))");
}

if ($permissions>'4'){$tblDemo->addButtonToRow("Rota Entry", "#myModal", "idservice");}
   
   
   
    

    
    
    
    #i could omit a field from being on the add form if I wanted
    //$tblDemo->omitAddField("leader_id");
      //  $tblDemo->omitAddField("speaker_id");

    #i could disallow editing for certain, individual fields
    //$tblDemo->disallowEdit('fldField2');

    #i could set a field to accept file uploads (the filename is stored) if wanted
    //$tblDemo->setFileUpload("fldField2", "uploads/");

    #i can have a field automatically populate with a certain value (eg the current timestamp)
    //$tblDemo->addValueOnInsert("fldField1", "NOW()");

    #i can use a where field to better- my table
    //$tblDemo->addWhereClause("WHERE (fldField1 = 'test'");

    #i can order my table by whatever i want
    $tblDemo->addOrderBy("ORDER BY date ASC");

    #i can set certain fields to only allow certain values
    #http://ajaxcrud.com/api/index.php?id=defineAllowableValues
    //$allowableValues = array("Allowable Value 1", "Allowable Value2", "Dropdown Value", "CRUD");
    //$tblDemo->defineAllowableValues("fldCertainFields", $allowableValues);

    #i can disallow deleting of rows from the table
    #http://ajaxcrud.com/api/index.php?id=disallowDelete
    //$tblDemo->disallowDelete();

    #i can disallow adding rows to the table
    #http://ajaxcrud.com/api/index.php?id=disallowAdd
    //$tblDemo->disallowAdd();

    #i can add a button that performs some action deleting of rows for the entire table
    #http://ajaxcrud.com/api/index.php?id=addButtonToRow
    //$tblDemo->addButtonToRow("Add", "add_item.php", "all");

    #set the number of rows to display (per page)
    $tblDemo->setLimit(20);
    //turn off ajax add.
    $tblDemo->turnOffAjaxADD();
    
    

    #set a filter box at the top of the table
   # $tblDemo->addAjaxFilterBox('song_name');

    #if really desired, a filter box can be used for all fields
    //$tblDemo->addAjaxFilterBoxAllFields();

    #i can set the size of the filter box
    //$tblDemo->setAjaxFilterBoxSize('fldField1', 3);

    #i can format the data in cells however I want with formatFieldWithFunction
    #this is arguably one of the most important (visual) functions


    $tblDemo->formatFieldWithFunctionAdvanced('date', 'ukdate');

    
    
    

    
    
    #actually show the table
    $tblDemo->showTable();
    
    #my self-defined functions used for formatFieldWithFunction
    function ukdate($data, $id){
        $date_s = strtotime($data);
		$new_date = date("d-M-Y", $date_s);
        return $new_date;
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

