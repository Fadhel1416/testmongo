<!DOCTYPE html>
<html lang="en">

<?php 
  session_start();

   ?>
   
<?php
       
       require 'vendor/autoload.php';  
       Use MongoDB\Client as MongoClient ;
       use MongoDB\BSON\ObjectId as MongoId;

       /*
     // Creating Connection  
     /*$con = new MongoDB\Client("mongodb://localhost:27017");  
     // Creating Database  
     $db = $con->javatpoint;  
     // Creating Document  
     $collection = $db->employee;  
     // Insering Record  
     $collection->insertOne( [ 'name' =>'ali', 'email' =>'alifadhel@abc.com' ] );  
     // Fetching Record  
     $record = $collection->find( [ 'name' =>'ali'] );  
     foreach ($record as $employe) {  
     echo $employe['name'], ': ', $employe['email']."<br>";  
     } */
     $m =new MongoClient("mongodb+srv://Fadhelali:Fadhel1416$@cluster0.cp4ra.mongodb.net/");

// select a database
$db = $m->test2;
$collection = $db->campagne;
$document=$collection->findOne(['_id'=> new MongoId($_REQUEST["id"])]);

$id=new MongoId($_REQUEST["id"]);// iterate cursor to display title of documents

if (isset($_POST["modifier"])) {

    if (!empty($_POST["firstname"]) && !empty($_POST["secondname"]) && !empty($_POST["rl"])) {
      
        $cursor=$collection->updateOne(
            array('_id'=>$id),
            array('$set'=>array("name"=>htmlspecialchars($_POST["firstname"]),
"secondname"=>htmlspecialchars($_POST["secondname"]),
"rl"=>htmlspecialchars($_POST["rl"]),
"userId"=>"2"
)));
        $message="compagne a ete modifier avec sucesss";
        $_SESSION["message"]=$message;
    } else {
        $message="vous douvez choisir tout le champs";
        $_SESSION["message"]=$message;
    }
    header("Location: index.php");

}
else {
    ?>
<head>
   <title>Modifier Compagane</title>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="Preview page of Metronic Admin Theme #1 for buttons extension demos" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.css" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="../assets/dist/sweetalert2.min.css">
<!-- END THEME LAYOUT STYLES -->
<link rel="shortcut icon" href="favicon.ico" />
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="">
                        <div class="menu-toggler sidebar-toggler">
                            <span style="top: 10px;    border-top: 10px;"> </span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                   
                    <div class="hor-menu   hidden-sm hidden-xs">
                        <ul class="nav navbar-nav">                 
                            <li class="classic-menu-dropdown " aria-haspopup="true">
                                <a href="#"> Menu Administrateur
                                    <span class="selected"> </span>
                                </a>
                            </li>
                            <li class="classic-menu-dropdown " aria-haspopup="true">
                                <a href="#"> Utilisateur
                                    <span class="selected"> </span>
                                </a>
                            </li>
                        
                       
                                
                             <li class="classic-menu-dropdown " aria-haspopup="true">
                                <a href="#"> statistique
                                    <span class="selected"> </span>
                                </a>
                            </li>
           
                                        
                        </ul>
                    </div> 
                 <div class="hor-menu   hidden-sm hidden-xs">
                 <ul class="nav navbar-nav">                 
                                 
                                     <li class="classic-menu-dropdown " aria-haspopup="true">

                             <form class="navbar-form navbar-right inline-form" action="https://www.bing.com/search?scope=web" method="get" target="_self" data-bing-action-uri="https://www.bing.com/search?scope=web" data-form-code="EDGSPH">
      <div class="form-group">
        <input type="search" name="q"  class="input-sm form-control"  size=50 placeholder="Recherche" data-m='{"i":3,"p":2,"n":"searchinput","y":9,"o":1}' data-id="3" autocomplete="off">
        <button type="submit" data-m='{"i":4,"p":2,"n":"search_websearch","y":9,"o":2}' data-id="4"  id="sb_form_go" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open"></span> Chercher</button>
      </div>
    </form>
                          </li>                                  
                                                   
                 </ul>                                  
                 </div>         
              
         
                                   
                                </ul>
                            </li> 
            
            
            
       
            
		  
                  
                    
                    
                    
                    
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu" id="mazou">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                            <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                             
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                
                               <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                  <i class="icon-bell"></i>
                                    <span class="badge badge-danger">
 </span>
                                </a>
                                
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>
                                            <span class="bold"> vous avez   0 notifications</span> 
                                            <br> <a href="#"> voir tous les  notifications </a>
                                        
                                        
                                        
                                    </li>
                                    <li>
                                        
                                       
                                    </li>
                                </ul>
                            </li>
                            <!-- END NOTIFICATION DROPDOWN -->
                            <!-- BEGIN INBOX DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-envelope-open"></i>
                                    <span class="badge badge-danger"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                       <span class="bold"></span> 
                                       <br>   <a href="#"> voir tous les message </a>
                                      
                                    </li>
                                    
                                    <li>
                                      
                                    </li>
                                </ul>
                            </li>
                            <!-- END INBOX DROPDOWN -->
                            <!-- BEGIN TODO DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                          
                            <!-- END TODO DROPDOWN -->
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="#"/>
                                    <span class="username username-hide-on-mobile"> </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="#">
                                            <i class="icon-user"></i>voir Profile </a>
                                    </li>


                                    <li class="divider"> </li>
                                  
                                    <li>
                                        <a href="#">
                                            <i class="icon-key"></i> Deconnexion </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                          
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                            <li class="sidebar-search-wrapper">
                                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                                <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                                    <a href="javascript:;" class="remove">
                                        <i class="icon-close"></i>
                                    </a>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                           
                                        </span>
                                    </div>
                                </form>
                                <!-- END RESPONSIVE QUICK SEARCH FORM -->
                            </li>
    
                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content" id="div-id-name">



         

               
   
                           

     <form action="modifier.php?id=<?php echo $id;?>" class="form" method="POST">
<div class="form-group">
<label for="name">Name</label>
    <input type="text" name="firstname" class="form-control" required value="<?php echo $document["name"];?>">
</div>
<div class="form-group">
    <label for="secondname">Family Name</label>
    <input type="text" name="secondname" class="form-control" required value="<?php echo $document["secondname"];?>">
        
    </div>
    <div class="form-group">
    <label for="url">Url</label>
    <input type="text" name="rl" class="form-control" required value="<?php echo $document["rl"];?>">
    </div>

    <br>
<input type="submit"  class="btn btn-warning" value="modifier" name="modifier">
     </form>



<?php
}   ?>









                        </div>    
                       
                      
                        
                        
    
        <script src="assets/dist/sweetalert2.js"></script>

        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
         <script src="https://cdn.jsdelivr.net/sweetalert2/6.1.0/sweetalert2.min.js"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })


        </script> 
      
  </body>
</html>
                   
                   


